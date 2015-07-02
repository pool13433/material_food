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
            $card_id = $_POST['card_id'];
            $nation_id = $_POST['nation'];
            $tel = $_POST['tel'];
            $sex = $_POST['sex'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $type = $_POST['type'];
            $picture = $_POST['picture'];
            $params = array(
                ':code' => $code,
                ':username' => $username,
                ':password' => $password,
                ':fname' => $fname,
                ':lname' => $lname,
                ':card_id' => $card_id,
                ':nation_id' => $nation_id,
                ':tel' => $tel,
                ':sex' => $sex,
                ':age' => $age,
                ':email' => $email,
                ':address' => $address,
                ':type' => $type
            );

            if (empty($id)) {// insert เพิ่มข้อมูลใหม่
                $sql = ' INSERT INTO `user`(';
                $sql .= ' `code`, `username`, `password`,';
                $sql .= ' `fname`, `lname`, `card_id`, nation_id,`tel`,';
                $sql .= ' sex,age,';
                $sql .= ' `email`, `address`, `modifieddate`,';
                $sql .= '  `type`,picture) VALUES (';
                $sql .= ' :code,:fname,:lname,';
                $sql .= ' :username,:password,:card_id,:nation_id,:tel,';
                $sql .= ' :email,:address,NOW(),';
                $sql .= ' :type,:picture)';
            } else { // update แก้ไขข้อมูลใหม่
                $sql = ' UPDATE `user` SET ';
                $sql .= ' `code`=:code,';
                $sql .= ' `username`=:username,`password`=:password,';
                $sql .= ' `fname`=:fname,`lname`=:lname,';
                $sql .= ' `card_id`=:card_id,nation_id=:nation_id,`tel`=:tel,';
                $sql .= ' sex=:sex,age=:age,';
                $sql .= ' `email`=:email,`address`=:address,';
                $sql .= ' `modifieddate`=NOW(),';
                $sql .= ' `type`=:type,';
                $sql .= ' picture =:picture';
                $sql .= ' WHERE `user_id`=:id';
                $params['id'] = $id;
            }

            /*
             * Upload File
             */
            $picture_user_name = '';
            if (!isset($picture) || !empty($_FILES['file']['name'])) {
                $tempFile = $_FILES['file']['tmp_name'];
                // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
                $targetPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . PATH_UPLOAD . DIRECTORY_SEPARATOR;
                // Adding timestamp with image's name so that files with same name can be uploaded easily.
                $picture_user_name = time() . '-' . $_FILES['file']['name'];
                $picture_new_name = $targetPath . $picture_user_name;
                move_uploaded_file($tempFile, $picture_new_name);
            } else {
                $picture_user_name = $picture;
            }
            /*
             * End Upload File
             */
            $params['picture'] = $picture_user_name;

            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-user&user_type=' . $type);
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
            }
        }
        break;
    case 'delete':
        // delete ลบข้อมูล
        try {
            $pdo->conn = $pdo->open();
            $sql = 'DELETE FROM user WHERE user_id =:id';
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
            $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE username =:username AND password =:password');
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
                //var_dump($result->type);
                if ($result->type == EMPLOYEE) {
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

    