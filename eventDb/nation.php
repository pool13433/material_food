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
            $params = array(
                ':name' => $name,
            );

            if (empty($id)) {// insert เพิ่มข้อมูลใหม่
                $sql = ' INSERT INTO `nation`(';
                $sql .= ' `nat_name`, `nat_modifieddate` ';
                $sql .= ' ) VALUES (';
                $sql .= ' :name,NOW()';
                $sql .= ' )';
            } else { // update แก้ไขข้อมูลใหม่
                $sql = ' UPDATE `nation` SET ';
                $sql .= ' `nat_name`=:name,';
                $sql .= ' `nat_modifieddate`=NOW()';
                $sql .= ' WHERE `nat_id` = :id';
                $params['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บ ันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-nation');
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        }
        break;
    case 'delete':
        // delete ลบข้อมูล
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM nation WHERE nat_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-nation');
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

