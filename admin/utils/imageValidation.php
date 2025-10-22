<?php

// function ValidateImage($path, $imgName)
// {

//     $allwoedExtentions = ['jpg', 'jpeg', 'png',];

//     $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));

//     if (in_array($imageFileType, $allwoedExtentions)) {
//         $imgRename = date('Ymdhis') . rand(0, 999) . '.' . $imageFileType;
//         if (move_uploaded_file($imgName['tmp_name'], $path . $imgRename)) {
//             return $imgRename;
//         } else {
//             return false;
//         }
//     } else {
//         return false;
//     }
// }


// function ValidateImage($path, $imgName)
// {
//     $allowedExtensions = ['jpg', 'jpeg', 'png'];

//     $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));

//     if (in_array($imageFileType, $allowedExtensions)) {
//         // Create directory if it doesn't exist
//         if (!is_dir($path)) {
//             mkdir($path, 0777, true);
//         }

//         $imgRename = date('Ymdhis') . rand(0, 999) . '.' . $imageFileType;

//         if (move_uploaded_file($imgName['tmp_name'], $path . '/' . $imgRename)) {
//             return $imgRename;
//         } else {
//             return false;
//         }
//     } else {
//         return false;
//     }
// }


// function ValidateImage($path, $imgName) {
  
//     $allowedExtensions = ['jpg', 'jpeg', 'png'];

//     $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));


//     $maxFileSize = 5 * 1024 * 1024; 

 
//     if (in_array($imageFileType, $allowedExtensions)) {

       
//         if ($imgName['size'] > $maxFileSize) {
//             return 'Error: File size exceeds the allowed limit of 5MB.';
//         }

       
//         if (!is_dir($path)) {
//             if (!mkdir($path, 0777, true)) {
//                 return 'Error: Failed to create upload directory.';
//             }
//         }

      
//         $imgRename = date('Ymdhis') . rand(0, 999) . '.' . $imageFileType;

 
//         if (move_uploaded_file($imgName['tmp_name'], $path . '/' . $imgRename)) {
//             return $imgRename;  
//         } else {
//             return 'Error: Failed to move uploaded file.';
//         }

//     } else {
//         return 'Error: Invalid file type. Only JPG, JPEG, PNG files are allowed.';
//     }
// }


// function ValidateImage($path, $imgName,) {
//     $allowedExtensions = ['jpg', 'jpeg', 'png'];
//     $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));
//     $maxFileSize = 5 * 1024 * 1024;

//     if (!in_array($imageFileType, $allowedExtensions)) {
//         echo "Invalid file type: $imageFileType<br>";
//         return false;
//     }

//     if ($imgName['size'] > $maxFileSize) {
//         echo "File too large: {$imgName['size']} bytes<br>";
//         return false;
//     }

//     if (!is_dir($path)) {
//         if (!mkdir($path, 0777, true)) {
//             echo "Failed to create directory: $path<br>";
//             return false;
//         }
//     }

//     $imgRename = date('Ymdhis') . rand(0, 999) . '.' . $imageFileType;
//     $targetFile = $path . '/' . $imgRename;

   

//     if (move_uploaded_file($imgName['tmp_name'], $targetFile)) {
//         return $imgRename;
//     } else {
//         echo "move_uploaded_file failed.<br>";
//         echo "File exists in tmp? " . (file_exists($imgName['tmp_name']) ? 'Yes' : 'No') . "<br>";
//         return false;
//     }
// }




function validateImage($path, $imgName)
{
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));
    $maxFileSize = 5 * 1024 * 1024;

    // Check if extension is valid
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Invalid file type: $imageFileType<br>";
        return false;
    }

    // Check if file size is acceptable
    if ($imgName['size'] > $maxFileSize) {
        echo "File too large: {$imgName['size']} bytes<br>";
        return false;
    }

    // Create directory if it doesn't exist
    if (!is_dir($path)) {
        if (!mkdir($path, 0777, true)) {
            echo "Failed to create directory: $path<br>";
            return false;
        }
    }


    $imgRename = date('YmdHis') . rand(100, 999) . '.' . $imageFileType;
    $targetFile = rtrim($path, '/') . '/' . $imgRename;

   
    // echo "Attempting to move file to: $targetFile<br>";
    // echo "Temporary file: " . $imgName['tmp_name'] . "<br>";
    // echo "File exists in tmp? " . (file_exists($imgName['tmp_name']) ? 'Yes' : 'No') . "<br>";

    

    if (move_uploaded_file($imgName['tmp_name'], $targetFile)) {
        return $imgRename;
    } else {
        echo "move_uploaded_file failed<br>";
        return false;
    }
}













function validatePdf($path, $imgName)
{
    $allowedExtensions = ['pdf'];

    $imageFileType = strtolower(pathinfo($imgName['name'], PATHINFO_EXTENSION));

    if (in_array($imageFileType, $allowedExtensions)) {
        // Create directory if it doesn't exist
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $imgRename = date('Ymdhis') . rand(0, 999) . '.' . $imageFileType;

        if (move_uploaded_file($imgName['tmp_name'], $path . '/' . $imgRename)) {
            return $imgRename;
        } else {
            return false;
        }
    } else {
        return false;
    }
}






