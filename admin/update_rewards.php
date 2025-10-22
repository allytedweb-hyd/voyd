<?php
include 'includes/db.php';

$customer_id = $_POST['customer_id'] ?? '';

if (empty($customer_id)) {
    echo json_encode(['message' => 'Customer ID is required']);
    exit;
}


$query = "SELECT * FROM customer WHERE customer_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['message' => 'Customer not found']);
    exit;
}

$data = $result->fetch_assoc();

$referral_code = $data['refferal_code'];
$referred_by = $data['refered_by'];


if ($referral_code === $referred_by) {
    echo json_encode(['message' => 'No reward: self-referral']);
    exit;
}


$count_query = "
    SELECT COUNT(*) AS unique_referrals
    FROM customer
    WHERE refered_by = ?
      AND refered_by != ''
      AND refered_by IS NOT NULL
";
$stmt2 = $conn->prepare($count_query);
$stmt2->bind_param("s", $referral_code);
$stmt2->execute();
$result2 = $stmt2->get_result();
$row = $result2->fetch_assoc();

$unique_referrals = (int)$row['unique_referrals'];


$reward_amount = $unique_referrals * 10000;

if ($reward_amount > 0) {
   
    $update = $conn->prepare("UPDATE customer SET reward_amount = ?, updated_at = NOW() WHERE customer_id = ?");
    $update->bind_param("ii", $reward_amount, $customer_id);

    if ($update->execute()) {
        echo json_encode([
            'message' => 'Reward updated successfully',
            'reward_amount' => $reward_amount,
            'unique_referrals' => $unique_referrals
        ]);
    } else {
        echo json_encode(['message' => 'Failed to update reward']);
    }
} else {
    echo json_encode(['message' => 'No eligible referrals for reward']);
}
?>
