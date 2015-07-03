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
            $material = $_POST['material'];
            $volume_use = $_POST['volume_use'];
            
            $params = array(
                ':material' => $name,
                ':volume_use' => $volume_use                
            );

            if (empty($id)) {// insert เพิ่มข้อมูลใหม่
                $sql = ' INSERT INTO `material_recipe`(';
                $sql .= ' `mat_id`, `volume_use`,`recipe_modifieddate` ';
                $sql .= ' ) VALUES (';
                $sql .= ' :material,:volume_use,NOW()';
                $sql .= ' )';
            } else { // update แก้ไขข้อมูลใหม่
                $sql = ' UPDATE `material_recipe` SET ';
                $sql .= ' `mat_id`=:material,';
                $sql .= ' volume_use =:volume_use,';
                $sql .= ' `type_modifieddate`=NOW()';
                $sql .= ' WHERE `recipe_id` = :id';
                $params['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บ ันทึกสำเร็จ' , 'บันทึกสำเร็จ', './index.php?page=list-material_recipe');
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        }
        break;
    case 'delete':
        // delete ลบข้อมูล
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM material_recipe WHERE recipe_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-material_recipe');
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

