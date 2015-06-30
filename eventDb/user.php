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
            $code = $_POST['code'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $idcard = $_POST['idcard'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $status = $_POST['status'];
            $params = array(
                ':code' => $code,
                ':username' => $username,
                ':password' => $password,
                ':fname' => $fname,
                ':lname' => $lname,
                ':idcard' => $idcard,
                ':mobile' => $mobile,
                ':email' => $email,
                ':address' => $address,
                ':actor' => 1, // actor
                ':status' => $status
            );

            if (empty($id)) {// insert เพิ่มข้อมูลใหม่
                $sql = ' INSERT INTO `user`(';
                $sql .= ' `u_code`, `u_username`, `u_password`,';
                $sql .= ' `u_fname`, `u_lname`, `u_idcard`, `u_mobile`,';
                $sql .= ' `u_email`, `u_address`, `u_modifieddate`,';
                $sql .= ' `u_modifiedby`, `u_status`) VALUES (';
                $sql .= ' :code,:fname,:lname,';
                $sql .= ' :username,:password,:idcard,:mobile,';
                $sql .= ' :email,:address,NOW(),';
                $sql .= ' :actor,:status)';
            } else { // update แก้ไขข้อมูลใหม่
                $sql = ' UPDATE `user` SET ';
                $sql .= ' `u_code`=:code,';
                $sql .= ' `u_username`=:username,`u_password`=:password,';
                $sql .= ' `u_fname`=:fname,`u_lname`=:lname,';
                $sql .= ' `u_idcard`=:idcard,`u_mobile`=:mobile,';
                $sql .= ' `u_email`=:email,`u_address`=:address,';
                $sql .= ' `u_modifieddate`=NOW(),`u_modifiedby`=:actor,';
                $sql .= ' `u_status`=:status';
                $sql .= ' WHERE `u_id`=:id';
                $params['id'] = $id;
            }
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-user&user_status=' . $status);
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        }
        break;
    case 'delete':
        // delete ลบข้อมูล
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM user WHERE u_id =:id';
            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute(array(
                ':id' => $_POST['id'],
            ));
            if ($exe) {
                echo returnJson(true, 'ลบข้อมูล', 'ลบสำเร็จ', './index.php?page=list-user');
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'ลบ ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'logout':
        if (!empty($_SESSION['person'])) {
            unset($_SESSION['person']);
        }
        echo returnJson(true, 'ออกจากระบบเรียบร้อย', 'ออกจากระบบเรียบร้อย', '../index.html');
        break;
    case 'login':
        // login เข้าสู่ระบบ
        try {
            $pdo = new DbConnection();
            $pdo->conn = $pdo->open();
            $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE u_username =:username AND u_password =:password');
            $stmt->execute(
                    array(
                        ':username' => $_POST['username'],
                        ':password' => $_POST['password'],
                    )
            );
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            if (empty($result)) {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'ไม่พบข้อมูลผู้ใช้งานในระบบ [ ' . $sql . ' ]', '');
            } else {
                $url = './index.php?page=' . BACKEND_HOME;
                $_SESSION['person'] = $result;
                //var_dump($result->status);
                if ($result->u_status == EMPLOYEE) {
                    $url = '../backend/index.php?page=' . BACKEND_HOME;
                } else {
                    $url = './index.php?page=van_search';
                }
                echo returnJson(true, 'แจ้งสถานะเข้าระบบ', 'แจ้งสถานะเข้าระบบสำเร็จ', $url);
            }
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        $pdo->close();
        break;
    case 'register':
        // register สมัครสมาชิก

        break;
    default:
        break;
}

