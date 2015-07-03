<?php

require './valiableDefine.php';
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();


switch ($_GET['event']) {
    case 'create':
        // ตรวจสอบค่า POST
        if (!empty($_POST)) {
            $pdo->conn = $pdo->open();
            // ประกาศตัวแปรรับ
            $id = $_POST['id'];
            $name = $_POST['name'];
            $materialType = $_POST['materialType'];
            $quantity = $_POST['quantity'];
            $volume = $_POST['volume'];
            $price = $_POST['price'];
            $buydate = $_POST['buydate'];
            $expdate = $_POST['expdate'];
            $picture = $_POST['picture'];
            $status = $_POST['status'];
            
            $params = array(
                ':type'=> $materialType,
                ':quantity' => $quantity,
                ':name' => $name,
                ':volume' =>$volume,
                ':price' => $price,
                ':buydate' => $buydate,
                ':expdate' => $expdate,
                ':status' => $status
                //,':picture' => $picture
            );

            if (empty($id)) {// insert เพิ่มข้อมูลใหม่
                $sql = ' INSERT INTO `material`(';
                $sql .= ' `type_id`, `quan_id`, `mat_name`,';
                $sql .= ' `mat_volume`, `mat_price`, `mat_buydate`,';
                $sql .= ' `mat_expdate`, `mat_picture`,';
                $sql .= ' `mat_modifieddate`,mat_status) VALUES (';
                $sql .= ' :type,:quantity,:name,';
                $sql .= ' :volume,:price,STR_TO_DATE(:buydate,\'%d/%m/%Y\'),';
                $sql .= ' STR_TO_DATE(:expdate,\'%d/%m/%Y\'),:picture,';
//                 $sql .= ' :volume,:price,NOW(),';
//                $sql .= ' NOW(),:picture,';
                $sql .= ' NOW(),:status)';
                
            } else { // update แก้ไขข้อมูลใหม่
                $sql = ' UPDATE `material` SET ';
                $sql .= ' `type_id`=:type,';
                $sql .= ' `quan_id`=:quantity,`mat_name`=:name,';
                $sql .= ' `mat_volume`=:volume,`mat_price`=:price,';
                $sql .= ' `mat_buydate`=STR_TO_DATE(:buydate,\'%d/%m/%Y\'),`mat_expdate`=STR_TO_DATE(:expdate,\'%d/%m/%Y\'),';
                $sql .= ' `mat_picture`=:picture,`mat_modifieddate`=NOW(),';
                $sql .= ' mat_status =:status';
                $sql .= ' WHERE `mat_id`=:id';
                $params['id'] = $id;
            }
            
            /*
             * Upload File
             */
            $picture_material_name = '';
            if (!isset($picture) || !empty($_FILES['file']['name'])) {
                $tempFile = $_FILES['file']['tmp_name'];
                // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
                $targetPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . PATH_UPLOAD_MATERIAL . DIRECTORY_SEPARATOR;
                // Adding timestamp with image's name so that files with same name can be uploaded easily.
                $picture_material_name = time() . '-' . $_FILES['file']['name'];
                $picture_new_name = $targetPath . $picture_material_name;
                move_uploaded_file($tempFile, $picture_new_name);
            } else {
                $picture_material_name = $picture;
            }
            /*
             * End Upload File
             */
            $params['picture'] = $picture_material_name;
            
            
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บ ันทึกสำเร็จ' , 'บันทึกสำเร็จ', './index.php?page=list-material');
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
                var_dump($params);
            }
        }
        break;
    case 'delete':
        // delete ลบข้อมูล
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM material WHERE mat_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-material');
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;

    default:
        break;
}

