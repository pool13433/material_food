<?php
/*case 'create':
        // ตรวจสอบค่า POST
        if (!empty($_POST)) {
            $pdo->conn = $pdo->open();

            $objectUser = json_decode($_POST['objUser'], true);
            //var_dump($objectUser);
            // ประกาศตัวแปรรับ
            $id = $objectUser['id'];
            $code = $objectUser['code'];
            $fname = $objectUser['fname'];
            $lname = $objectUser['lname'];
            $username = $objectUser['username'];
            $password = $objectUser['password'];
            $card_id = $objectUser['card_id'];
            $nation_id = $objectUser['nation'];
            $tel = $objectUser['tel'];
            $sex = $objectUser['sex'];
            $age = $objectUser['age'];
            $email = $objectUser['email'];
            $address = $objectUser['address'];
            $type = $objectUser['type'];
            $picture = $objectUser['picture'];


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
                ':type' => $type,
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
                $sql .= ' `picture`=:picture';
                $sql .= ' WHERE `user_id`=:id';
                $params['id'] = $id;
            }

            /*
             * upload file code
             */

                $picture_user_name = '';
            //$upload_dir = '../uploads/picture_user/';
            if (empty($picture) || !empty($_FILES)) {
                $tempFile = $_FILES['file']['tmp_name'][0];
                // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
                $targetPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . PATH_UPLOAD . DIRECTORY_SEPARATOR;
                // Adding timestamp with image's name so that files with same name can be uploaded easily.
                $picture_user_name = time() . '-' . $_FILES['file']['name'][0];
                $picture_new_name = $targetPath . $picture_user_name;
                move_uploaded_file($tempFile, $picture_new_name);
            } else {
                $picture_user_name = $picture;
            }
            /*
             * End Upload file code
             */


            $params['picture'] = $picture_user_name;

            $stmt = $pdo->conn->prepare($sql);
            $exe = $stmt->execute($params);
            if ($exe) {
                echo returnJson(true, 'บันทึกสำเร็จ', 'บันทึกสำเร็จ', './index.php?page=list-user&user_type=' . $type);
            } else {
                echo returnJson(false, 'เกิดข้อผิดพลาด', 'บันทึก ไม่สำเร็จ [ ' . $sql . ' ]', '');
                var_dump($params);
            }
        }
        break;*/