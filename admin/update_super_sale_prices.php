<?php
include 'includes/db.php';
session_start();
date_default_timezone_set('Asia/Kolkata');

$now = date('Y-m-d H:i:s');


$salesResult = $conn->query("SELECT * FROM super_sale WHERE status = 1");
$saleActive = false;
$activeOffer = 0;

if ($salesResult && $salesResult->num_rows > 0) {
    while ($sale = $salesResult->fetch_assoc()) {
        $start = $sale['start_date'] . ' ' . $sale['start_time'];
        $end = $sale['end_date'] . ' ' . $sale['end_time'];
        $offer = floatval($sale['offer']);

        if ($now >= $start && $now <= $end) {
            $saleActive = true;
            $activeOffer = $offer;
            break;
        }
    }
}

if ($saleActive) {
  
   

    $discountMultiplier = 1 - ($activeOffer / 100); 

   
    $productsToDiscount = $conn->query("
        SELECT product_id, product_mrp FROM products
        WHERE productTag = 'super_sale' AND is_discounted = 0 AND product_mrp > 0
    ");

    if ($productsToDiscount && $productsToDiscount->num_rows > 0) {
        while ($product = $productsToDiscount->fetch_assoc()) {
            $id = $product['product_id'];
            $currentMrp = floatval($product['product_mrp']);
            $originalMrpRounded = round($currentMrp); 

            $newMrp = round($currentMrp * $discountMultiplier);

          
            $updateSql = "
                UPDATE products SET 
                    original_mrp = '$originalMrpRounded',
                    product_mrp = $newMrp,
                    is_discounted = 1
                WHERE product_id = $id
            ";
            $conn->query($updateSql);
        }
        $_SESSION['notifications'][] = " Discount of $activeOffer% applied to " . $productsToDiscount->num_rows . " product(s).";
    } else {
        $_SESSION['notifications'][] = "No products eligible for discount.";
    }

} else {


  
    $productsToRevert = $conn->query("
        SELECT product_id, original_mrp FROM products
        WHERE productTag = 'super_sale' AND is_discounted = 1 AND original_mrp IS NOT NULL AND original_mrp != ''
    ");

    if ($productsToRevert && $productsToRevert->num_rows > 0) {
        while ($product = $productsToRevert->fetch_assoc()) {
            $id = $product['product_id'];
            $originalMrp = intval($product['original_mrp']); 

           
            $updateSql = "
                UPDATE products SET
                    product_mrp = $originalMrp,
                    original_mrp = NULL,
                    is_discounted = 0
                WHERE product_id = $id
            ";
            $conn->query($updateSql);
        }
        $_SESSION['notifications'][] = " Sale ended. Prices reverted for " . $productsToRevert->num_rows . " product(s).";
    } else {
        $_SESSION['notifications'][] = "No discounted products to revert.";
    }
}

$conn->close();
?>
