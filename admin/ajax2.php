




<?php
include 'includes/db.php';



if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = mysqli_query($conn, "select * from manufacturer_category where select_product = '" . $id . "' && status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($query)) {
        echo "<option value=" . $fet['mcategory_id'] . ">" . $fet['category_name'] . "</option>";
    }
}

if (isset($_POST['id1'])) {
    $id1 = $_POST['id1'];
    $MCquery = mysqli_query($conn, "select * from manufacturer_subCategory where select_category = '" . $id1 . "' && status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($MCquery)) {
        echo "<option value=" . $fet['mSubcategory_id'] . ">" . $fet['sub_category'] . "</option>";
    }
}

if (isset($_POST['id2'])) {
    $id2 = $_POST['id2'];
    $MSquery = mysqli_query($conn, "select * from attributes where sub_category ='" . $id2 . "'&& status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($MSquery)) {
        echo "<option value=" . $fet['attribute_id'] . ">" . $fet['attributes'] . "</option>";
    }
}

if (isset($_POST['id3'])) {
    $id3 = $_POST['id3'];
    $Attriquery = mysqli_query($conn, "select * from value_master where attributes ='" . $id3 . "'&& status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($Attriquery)) {
        echo "<option value=" . $fet['values_id'] . ">" . $fet['enter_values'] . "</option>";
    }
}

if (isset($_POST['id4'])) {
    $id4 = $_POST['id4'];
    $categoryquery = mysqli_query($conn, "select * from subcategory where category ='" . $id4 . "'&& status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($categoryquery)) {
        echo "<option value=" . $fet['subcategory_id'] . ">" . $fet['sub_category'] . "</option>";
    }
}

if (isset($_POST['element'])) {
    $element = $_POST['element'];
    $elementquery = mysqli_query($conn, "select * from element_master where property_block ='" . $element . "'&& status = 1");
    echo "<option value=''>Select</option>";
    while ($fet = mysqli_fetch_array($elementquery)) {
        echo "<option value=" . $fet['element_id'] . ">" . $fet['element_name'] . "</option>";
    }
}


// if (isset($_POST['projectSubStatus'])) {
//     $subStatusVal = $_POST['subStatus'];
//     $quotationId = $_POST['queId'];
//     $false_ceiling = $_POST['false_ceiling'];
//     $electrical_lighting = $_POST['electrical_lighting'];
//     $sanitary = $_POST['sanitary'];
//     $wardrobes = $_POST['wardrobes'];
//     $wall_putty = $_POST['wall_putty'];
//     $painting = $_POST['painting'];
//     $updateSubStatus = mysqli_query($conn, "UPDATE questionnaire tbl1, quotation tbl2 SET 
//     tbl2.false_ceiling = '" . $false_ceiling . "', 
//     tbl2.elec_light = '" . $electrical_lighting . "', 
//     tbl2.sanitary = '" . $sanitary . "', 
//     tbl2.wardrobes = '" . $wardrobes . "', 
//     tbl2.wall_putty = '" . $wall_putty . "', 
//     tbl2.painting = '" . $painting . "', 
    
//     WHERE tbl1.que_id = tbl2.que_id && tbl1.que_id='" . $quotationId . "' && tbl1.status=1");
//     echo json_encode($updateSubStatus);
// }

// if (isset($_POST['action']) && $_POST['action'] === 'update_status_percentages') {
//     $quotationId = $_POST['que_id'] ?? null;
//     $false_ceiling = $_POST['false_ceiling'] ?? null;
//     $electrical_lighting = $_POST['electrical_lighting'] ?? null;
//     $sanitary = $_POST['sanitary'] ?? null;
//     $wardrobes = $_POST['wardrobes'] ?? null;
//     $wall_putty = $_POST['wall_putty'] ?? null;
//     $painting = $_POST['painting'] ?? null;
  
//     $false_ceiling_status = $_POST['false_ceiling_status'] ?? null;
//     $electrical_lighting_status = $_POST['electrical_lighting_status'] ?? null;
//     $sanitary_status = $_POST['sanitary_status'] ?? null;
//     $wardrobes_status = $_POST['wardrobes_status'] ?? null;
//     $wall_putty_status = $_POST['wall_putty_status'] ?? null;
//     $painting_status = $_POST['painting_status'] ?? null;
//     $manager_reason = $_POST['manager_reason'] ?? null;

    
    

//     if ($quotationId !== null) {
        
//         $stmt = $conn->prepare("
//             UPDATE quotation T2
//             JOIN questionnaire T1 ON T1.que_id = T2.que_id
//             SET 
//                 T2.false_ceiling = ?, 
//                 T2.elec_light = ?, 
              
//                 T2.sanitary = ?, 
//                 T2.wardrobes = ?, 
//                 T2.wall_putty = ?, 
//                 T2.painting = ?,
//                 T2.false_ceiling_status = ?,
//                 T2.electrical_lighting_status = ?,
//                 T2.sanitary_status = ?,
//                 T2.wardrobes_status = ?,
//                 T2.wall_putty_status = ?,
//                 T2.painting_status = ?,
//                 T2.manager_reason = ?
//             WHERE T1.que_id = ? AND T1.status = 1
//         ");

//         if ($stmt) {
//             $stmt->bind_param(
//                 "ddddddsssssssi", 
//                 $false_ceiling, 
//                 $electrical_lighting, 
             
//                 $sanitary, 
//                 $wardrobes, 
//                 $wall_putty, 
//                 $painting, 
//                 $false_ceiling_status, 
//                 $electrical_lighting_status, 
//                 $sanitary_status, 
//                 $wardrobes_status, 
//                 $wall_putty_status, 
//                 $painting_status, 
//                 $manager_reason, 
//                 $quotationId
//             );

//             if ($stmt->execute()) {
//                echo json_encode(['success' => true]);
//             } else {
//                echo json_encode(['success' => false, 'message' => $stmt->error]);
//             }
//             $stmt->close();
//         } else {
//          echo json_encode(['success' => false, 'message' => $stmt->error]);
//         }
//     } 
//     else {
//         echo json_encode(['success' => false, 'message' => 'Missing que_id']);
//     }
//     exit;
// }

if (isset($_POST['action']) && $_POST['action'] === 'update_status_percentages') {
    $quotationId = $_POST['que_id'] ?? null;
    $false_ceiling = $_POST['false_ceiling'] ?? null;
    $electrical_lighting = $_POST['electrical_lighting'] ?? null;
    $sanitary = $_POST['sanitary'] ?? null;
    $wardrobes = $_POST['wardrobes'] ?? null;
    $wall_putty = $_POST['wall_putty'] ?? null;
    $painting = $_POST['painting'] ?? null;

    $false_ceiling_status = $_POST['false_ceiling_status'] ?? null;
    $electrical_lighting_status = $_POST['electrical_lighting_status'] ?? null;
    $sanitary_status = $_POST['sanitary_status'] ?? null;
    $wardrobes_status = $_POST['wardrobes_status'] ?? null;
    $wall_putty_status = $_POST['wall_putty_status'] ?? null;
    $painting_status = $_POST['painting_status'] ?? null;
    $manager_reason = $_POST['manager_reason'] ?? null;

    if ($quotationId === null) {
        echo json_encode(['success' => false, 'message' => 'Missing que_id']);
        exit;
    }

   
    $sql = "
        UPDATE quotation T2
        JOIN questionnaire T1 ON T1.que_id = T2.que_id
        SET 
            T2.false_ceiling = ?, 
            T2.elec_light = ?, 
            T2.sanitary = ?, 
            T2.wardrobes = ?, 
            T2.wall_putty = ?, 
            T2.painting = ?,
            T2.false_ceiling_status = ?,
            T2.electrical_lighting_status = ?,
            T2.sanitary_status = ?,
            T2.wardrobes_status = ?,
            T2.wall_putty_status = ?,
            T2.painting_status = ?
    ";

    $params = [
        $false_ceiling,
        $electrical_lighting,
        $sanitary,
        $wardrobes,
        $wall_putty,
        $painting,
        $false_ceiling_status,
        $electrical_lighting_status,
        $sanitary_status,
        $wardrobes_status,
        $wall_putty_status,
        $painting_status
    ];
    $types = "ddddddssssss";

    
    if ($manager_reason !== null && trim($manager_reason) !== "") {
        $sql .= ", T2.manager_reason = ?";
        $params[] = $manager_reason;
        $types .= "s";
    }

    
    $sql .= " WHERE T1.que_id = ? AND T1.status = 1";
    $params[] = $quotationId;
    $types .= "i";

    
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
    exit;
}




if (isset($_POST['action']) && $_POST['action'] == 'get_status_percentages') {
    $que_id = $_POST['que_id'];
    $query = "SELECT false_ceiling, elec_light, sanitary, wardrobes, wall_putty, painting, false_ceiling_status,
                electrical_lighting_status,
                sanitary_status,
                wardrobes_status,
                wall_putty_status,
                painting_status,
                manager_reason FROM quotation WHERE que_id = '$que_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found']);
    }
    exit;
}


if (isset($_POST['action']) && $_POST['action'] === 'approve_status') {
   
    $que_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $approve_status = isset($_POST['approve_status']) ? mysqli_real_escape_string($conn, $_POST['approve_status']) : '';

    if ($que_id > 0 && $approve_status !== '') {
        $sql = "UPDATE quotation SET approve_status='$approve_status' WHERE que_id=$que_id";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => true, 'message' => 'Approval status updated']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database update failed']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
    exit;
}








if (isset($_POST['eveType']) && $_POST['eveType'] == 'vendor-name') {
    $vendorId = $_POST['vendorId'];

    $getQuery = mysqli_query($conn, "SELECT * FROM vendor_management WHERE vendor_id = '$vendorId' && status = 1");
    $count = mysqli_num_rows($getQuery);
    echo json_encode($count);
    exit();
}


if (isset($_GET['filter'])) {
    $filter = $_GET['filter'];
    if ($filter ==  "" || $filter == "All") {
        $MCquery = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.status=1");
        $i = 1;
        while ($fetch = mysqli_fetch_array($MCquery)) {
?>
            <tr>
                <td ><?php echo $i; ?></td>
                <td><?php echo $fetch['first_name'] . " " . $fetch['last_name']; ?></td>
                <td><?php echo "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'] ?>
                </td>
                <td class="emailcap" style="text-transform: none;" ><?php echo $fetch['email']; ?></td>
                <td><?php echo $fetch['mobile']; ?></td>
                <td><?php echo $fetch['state']; ?></td>
                <td><?php echo $fetch['city']; ?></td>
                <td>

                           <?php
        $rawDesc = $fetch['locality'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text"  data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                    
              
            </td>
                <td>

                        <?php
        $rawDesc = $fetch['street'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>

                   
                </td>
                <td><?php echo $fetch['quotation_id']; ?></td>
                <!-- <td><?php echo $fetch['map_link']; ?></td> -->
                <td><?php echo $fetch['property']; ?></td>
                <td><?php echo $fetch['property_type']; ?></td>
                <!-- <td><?php echo $fetch['near_by']; ?></td> -->
            
                <td><?php echo $fetch['budget']; ?></td>
                <td><?php echo $fetch['product_classification']; ?></td>
                <td><?php echo $fetch['manufacturer_classification']; ?></td>

                <?php
                $getmanager = mysqli_query($conn,"SELECT * FROM login_admin WHERE id='".$fetch['manager_id']."'");
                $managername = mysqli_fetch_array($getmanager);
                ?>

                    <td>
    <?php echo !empty($managername['admin_name']) ? $managername['admin_name'] : 'Not assigned'; ?>
</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="padding: 14px 25px;" >  <a class="iedit" href="./request_quote.php?id=<?php echo $fetch['que_id'] ?>&user=<?php echo $fetch['customer_id'];?>"><i class='bx bx-show'></i></a></td>
                <td>
                    <a class="idelete" href="./delete-questionnaire.php?id=<?php echo $fetch['que_id']; ?>"><i class='bx bx-trash' 
                            name="deleteQueries"></i></a>
                  
                    
                </td>
                <td></td>
            </tr>
        <?php
            $i++;
        }
    } 
    else {
        $Mquery = mysqli_query($conn, "SELECT * FROM questionnaire T1, quotation T2 WHERE T1.que_id = T2.que_id AND T1.freeze='freezed' AND T1.status=1");

        $i = 1;
        while ($fetch = mysqli_fetch_array($Mquery)) {
        ?>

            <tr>
                <td ><?php echo $i; ?></td>
                <td><?php echo $fetch['first_name'] . " " . $fetch['last_name']; ?></td>
                <td><?php echo "VOYD0" . $fetch['customer_id'] . "-" . $fetch['property'] . "(" . $fetch['property_type'] . ")-" . $fetch['que_id'] ?>
                </td>
                <td class="emailcap" style="text-transform: none;" ><?php echo $fetch['email']; ?></td>
                <td><?php echo $fetch['mobile']; ?></td>
                <td><?php echo $fetch['state']; ?></td>
                <td><?php echo $fetch['city']; ?></td>
                <td>

                    <?php
        $rawDesc = $fetch['locality'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                
                    
                
            </td>
                <td>

                    <?php
        $rawDesc = $fetch['street'] ?? '';
        $plainDesc = strip_tags($rawDesc);                       
        $cleanDesc = str_replace('&nbsp;', ' ', $plainDesc);    
        $escapedDesc = htmlspecialchars($cleanDesc); 
    ?>
    <div class="tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?= $escapedDesc ?>">
        <?= htmlspecialchars(mb_strimwidth($cleanDesc, 0, 50, '...')) ?> 
    </div>
                    
               
            </td>
                <td><?php echo $fetch['quotation_id']; ?></td>
                <!-- <td><?php echo $fetch['map_link']; ?></td> -->
                <td><?php echo $fetch['property']; ?></td>
                <td><?php echo $fetch['property_type']; ?></td>
                <!-- <td><?php echo $fetch['property_type']; ?></td> -->
                
                <td><?php echo $fetch['budget']; ?></td>
                <td><?php echo $fetch['product_classification']; ?></td>
                <td><?php echo $fetch['manufacturer_classification']; ?></td>
                 <?php
                $getmanager = mysqli_query($conn,"SELECT * FROM login_admin WHERE id='".$fetch['manager_id']."'");
                $managername = mysqli_fetch_array($getmanager);
                ?>

                  <td>
    <?php echo !empty($managername['admin_name']) ? $managername['admin_name'] : 'Not assigned'; ?>
</td>
                <td><?php echo $fetch['assigned_vendor']; ?></td>
                <td><?php echo $fetch['assigned_project_user']; ?></td>
                <td><?php echo $fetch['deadline']; ?></td>
                <td><?php echo $fetch['startdate']; ?></td>
                <td style="padding: 14px 25px;">    <a class="iedit" href="./request_quote.php?id=<?php echo $fetch['que_id'] ?>&user=<?php echo $fetch['customer_id'];?>"><i
                            class='bx bx-show '></i></a></td>
                <td>
                    <a class="idelete" href="./delete-questionnaire.php?id=<?php echo $fetch['que_id']; ?>"><i
                            class='bx bx-trash ' name="deleteQueries"></i></a>
                

                    <button class="assignprojectbutton" onclick="handlePopup(<?php echo  $fetch['que_id'] ?>)">
                        <img width="20" src="./assets/images/assign.png" alt="" />
                    </button>

                </td>
                <td>
                    <!-- <button type="button" class="btn btn-secondary" style="font-size: 14px;
    padding: 6px;"
>UnFreeze</button> -->
<?php if ($fetch['freeze'] === 'freezed') { ?>
    <button class="btn btn-warning btn-sm unfreeze-btn" data-id="<?= $fetch['que_id'] ?>">Unfreeze</button>
<?php } ?>

                    <button type="button" class="btn btn-success" style="font-size: 14px;
    padding: 6px; color:white;"><a
                            href="project-progress.php?id=<?php echo $fetch['que_id'] ?>" style="color:white;" >Track</a></button>
                </td>
            </tr>
<?php
            $i++;
        }
    }
}
?>

<?php
if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $Taskquery = mysqli_query($conn, "SELECT * FROM task_master WHERE task_id ='" . $task . "'&& status = 1");
    $fet = mysqli_fetch_array($Taskquery);
    echo "<div>" . $fet['task_name'] . "</div> 
        <input type='hidden' value='" . $fet['task_name'] . "' name='charttask'/>";
}
?>
<!-- Button trigger modal -->





<!-- Modal -->
<script>
    function handlePopup(id) {

        $('#exampleModal').modal('show')
        // const queId = document.getElementById("vendorClassInput").value = id;
        document.cookie = "queId=" + id;
    }
</script>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>