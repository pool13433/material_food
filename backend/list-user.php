<?php 
require_once '../connDb/DbConnection.php'; 
$user_type = $_GET['user_type'];
?>
<section class="panel">
    <header class="panel-heading clearfix">        
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-user"></i><b>ข้อมูลรายการผู้ใช้งานทั้งหมด</b>
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?user_type=<?=$user_type?>&page=form-user" class="btn btn-primary">
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
                $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE type =:type');
                $stmt->execute(array(':type' => $user_type));
                $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($datas as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value->fname. '   ' . $value->lname ?></td>
                        <td><?= $value->tel?></td>
                        <td><?= $value->email ?></td>
                        <td><?= getDataList($value->type , listUserStatus())?></td>
                        <td style="width: 8%;">
                            <a href="index.php?user_type=<?=$user_type?>&page=form-user&id=<?= $value->user_id ?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->user_id ?>, '../eventDb/user.php?event=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>                
                <?php } ?>
            </tbody>
        </table> 
    </div>
</section>