<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$id = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';

if (!$id) {
    echo json_encode(['status' => false, 'message' => 'No productId provided']);
    exit;
}

$query = mysqli_query($conn, "
    SELECT 
        p.*, 
        b.brand_title, 
        c.category_name, 
        m.material_name, 
        co.color_code
    FROM products p
    LEFT JOIN brands b ON p.product_brand = b.brand_id
    LEFT JOIN category c ON p.product_category = c.category_id
    LEFT JOIN material m ON p.product_material = m.material_id
    LEFT JOIN colors co ON p.product_color = co.color_id
    WHERE p.product_id = '$id' AND p.status = 1
");

$count = mysqli_num_rows($query);

$singleproduct = [];

if ($count > 0) {
    while ($data = mysqli_fetch_assoc($query)) {
        $singleproduct = $data;
    }
    $result = ['status' => true, 'response' => $singleproduct];
} else {
    $result = ['status' => false, 'message' => 'Product not found'];
}

echo json_encode($result);*/










// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

// include "../../includes/db.php";  

// $id = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';
// if (!$id) {
//     echo json_encode(['status' => false, 'message' => 'No productId provided']);
//     exit;
// }


// $query = mysqli_query($conn, "
//   SELECT p.*, b.brand_title, c.category_name, m.material_name,
//          co.color_code AS main_color_code, co.color_shade AS main_color_shade
//   FROM products p
//   LEFT JOIN brands b ON p.product_brand = b.brand_id
//   LEFT JOIN category c ON p.product_category = c.category_id
//   LEFT JOIN material m ON p.product_material = m.material_id
//   LEFT JOIN colors co ON p.product_color = co.color_id
//   WHERE p.product_id = '$id' AND p.status = 1
// ");

// if (!$query || mysqli_num_rows($query) === 0) {
//     echo json_encode(['status' => false, 'message' => 'Product not found']);
//     exit;
// }

// $data = mysqli_fetch_assoc($query);


// $images = [];
// for ($i = 1; $i <= 5; $i++) {
//     $imgKey = "image_$i";
//     $altKey = "alttext_$i";
//     if (!empty($data[$imgKey])) {
//         $images[] = [
//             'image' => $data[$imgKey],
//             'alt'   => $data[$altKey] ?? $data['product_alttext'] ?? ''
//         ];
//     }
// }
// if (!empty($data['product_image'])) {
//     $images[] = [
//         'image' => $data['product_image'],
//         'alt'   => $data['product_alttext'] ?? ''
//     ];
// }


// $images_by_color = [];
// $mainShade = $data['main_color_shade'] ?? 'Default';
// $images_by_color[$mainShade] = $images;


// $colorQuery = mysqli_query($conn, "
//   SELECT pc.product_color, co.color_shade,
//          pc.image1, pc.alttext1,
//          pc.image2, pc.alttext2,
//          pc.image3, pc.alttext3,
//          pc.image4, pc.alttext4,
//          pc.image5, pc.alttext5
//   FROM product_colors pc
//   LEFT JOIN colors co ON pc.product_color = co.color_id
//   WHERE pc.product_name = '$id' AND pc.status = 1
// ");

// if ($colorQuery && mysqli_num_rows($colorQuery) > 0) {
//     while ($row = mysqli_fetch_assoc($colorQuery)) {
//         $shade = $row['color_shade'] ?? 'Unknown';
//         if (!isset($images_by_color[$shade])) {
//             $images_by_color[$shade] = [];
//         }
//         for ($i = 1; $i <= 5; $i++) {
//             $img = $row["image$i"];
//             if (!empty($img)) {
//                 $images_by_color[$shade][] = [
//                     'image' => $img,
//                     'alt'   => $row["alttext$i"] ?? ''
//                 ];
//             }
//         }
//     }
// }


// $colorMap = [];
// foreach ($images_by_color as $shade => $_) {
//     $esc = mysqli_real_escape_string($conn, $shade);
//     $res = mysqli_query($conn, "
//       SELECT color_code
//       FROM colors
//       WHERE color_shade = '{$esc}'
//         AND status = 1
//       LIMIT 1
//     ");
//     if ($res && mysqli_num_rows($res) > 0) {
//         $row = mysqli_fetch_assoc($res);
//         $colorMap[$shade] = $row['color_code'];
//     } else {
//         $colorMap[$shade] = '#ccc';
//     }
// }


// $data['images'] = $images;
// $data['images_by_color'] = $images_by_color;
// $data['colorMap'] = $colorMap;

// echo json_encode([
//     'status'   => true,
//     'response' => $data
// ]);



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin");

include "../../includes/db.php";

$id = isset($_GET['productId']) ? mysqli_real_escape_string($conn, $_GET['productId']) : '';

if (!$id) {
    echo json_encode(['status' => false, 'message' => 'No productId provided']);
    exit;
}


$query = mysqli_query($conn, "
    SELECT 
        p.*, 
        b.brand_title, 
        c.category_name, 
        m.material_name,
        co.color_code AS main_color_code,
        co.color_shade AS main_color_shade
    FROM products p
    LEFT JOIN brands b ON p.product_brand = b.brand_id
    LEFT JOIN category c ON p.product_category = c.category_id
    LEFT JOIN material m ON p.product_material = m.material_id
    LEFT JOIN colors co ON p.product_color = co.color_id
    WHERE p.product_id = '$id' AND p.status = 1
");

if (!$query || mysqli_num_rows($query) === 0) {
    echo json_encode(['status' => false, 'message' => 'Product not found']);
    exit;
}

$data = mysqli_fetch_assoc($query);


$images = [];
for ($i = 1; $i <= 5; $i++) {
    $imgKey = "image_$i";
    $altKey = "alttext_$i";
    if (!empty($data[$imgKey])) {
        $images[] = [
            'image' => $data[$imgKey],
            'alt'   => $data[$altKey] ?? $data['product_alttext'] ?? ''
        ];
    }
}
if (!empty($data['product_image'])) {
    $images[] = [
        'image' => $data['product_image'],
        'alt'   => $data['product_alttext'] ?? ''
    ];
}


$size     = $data['product_size'] ?? '';
$material = $data['material_name'] ?? '';
$quantity = $data['product_quantity'] ?? '';


$images_by_color = [];


$mainShade = $data['main_color_shade'] ?? 'Default';
$images_by_color[$mainShade] = [
    'images'   => $images,
    'size'     => $size,
    'material' => $material,
    'quantity' => $quantity
];


$colorQuery = mysqli_query($conn, "
    SELECT 
        pc.product_color, co.color_shade,
        pc.image1, pc.alttext1,
        pc.image2, pc.alttext2,
        pc.image3, pc.alttext3,
        pc.image4, pc.alttext4,
        pc.image5, pc.alttext5,
        pc.product_size,
        pc.product_material,
        pc.product_quantity,
        m.material_name
    FROM product_colors pc
    LEFT JOIN colors co ON pc.product_color = co.color_id
    LEFT JOIN material m ON pc.product_material = m.material_id
    WHERE pc.product_name = '$id' AND pc.status = 1
");

if ($colorQuery && mysqli_num_rows($colorQuery) > 0) {
    while ($row = mysqli_fetch_assoc($colorQuery)) {
        $shade = strtolower(trim($row['color_shade'] ?? ''));
if ($shade === '' || is_numeric($shade)) {
    $shade = 'unknown';
}

        $shade_images = [];
        for ($i = 1; $i <= 5; $i++) {
            $img = $row["image$i"];
            if (!empty($img)) {
                $shade_images[] = [
                    'image' => $img,
                    'alt'   => $row["alttext$i"] ?? ''
                ];
            }
        }

     $images_by_color[$shade] = [
    'images'   => $shade_images,
    'size'     => $row['product_size'] ?? $size,
    'material' => $row['material_name'] ?? $material,
    'quantity' => $row['product_quantity'] ?? $quantity
];
    }
}


$colorMap = [];
foreach ($images_by_color as $shade => $_) {
    $esc = mysqli_real_escape_string($conn, $shade);
    $res = mysqli_query($conn, "
        SELECT color_code
        FROM colors
        WHERE color_shade = '{$esc}' AND status = 1
        LIMIT 1
    ");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $colorMap[$shade] = $row['color_code'];
    } else {
        $colorMap[$shade] = '#ccc';
    }
}


$data['images_by_color'] = $images_by_color;
$data['colorMap'] = $colorMap;


echo json_encode([
    'status'   => true,
    'response' => $data
]);
?>













