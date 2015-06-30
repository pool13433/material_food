<?php 
require_once '../connDb/DbConnection.php'; 
$user_status = $_GET['user_status'];
?>
<section class="panel">
    <header class="panel-heading clearfix">        
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-user"></i><b>ข้อมูลรายการผู้ใช้งานทั้งหมด</b>
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?user_status=<?=$user_status?>&page=form-user" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </header>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ-สกล</th>
                    <th>โทรศัพท์</th>
                    <th>อีเมลล์</th>
                    <th>สถานะ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new DbConnection();
                $pdo->conn = $pdo->open();
                $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE u_status =:status');
                $stmt->execute(array(':status' => $user_status));
                $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($datas as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value->u_fname . '   ' . $value->u_lname ?></td>
                        <td><?= $value->u_mobile ?></td>
                        <td><?= $value->u_email ?></td>
                        <td><?= getDataList($value->u_status , listUserStatus())?></td>
                        <td style="width: 8%;">
                            <a href="index.php?user_status=<?=$user_status?>&page=form-user&id=<?= $value->u_id ?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->u_id ?>, '../eventDb/user.php?event=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>                
                <?php } ?>
            </tbody>
        </table> 
    </div>
</section>