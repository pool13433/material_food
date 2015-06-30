<!DOCTYPE html>
<html>
    <head>
        <title>โปรแกรมจัดการวัตถุดิบร้านขายอาหาร</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require '../resources/includeCssJs.php'; ?>
    </head>
    <body>        
        <?php
        if (!empty($_GET)) { // ตรวจสอบค่าตัวแปร GET ไม่ว่างก็ทำ ข้างในนี้
            $page = $_GET['page'] . '.php';
            if (file_exists($page)) {
                include $page;
            } else {
                // หน้าจอโปรแกรมกรณีเรียกหน้า้พจไม่ถูกต้อง 404
                include './404.php';
            }
        } else {
            include './login.php';
        }
        ?>
    </body>
</html>
