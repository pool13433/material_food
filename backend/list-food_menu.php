<?php 
require_once '../connDb/DbConnection.php'; 
?>
<section class="panel">
    <header class="panel-heading clearfix">        
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-thumbs-up"></i><b>ข้อมูลรายการเมนูอาหารทั้งหมด</b>
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-food_menu" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </header>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new DbConnection();
                $pdo->conn = $pdo->open();
                $stmt = $pdo->conn->prepare('SELECT * FROM food_menu');
                $stmt->execute();
                $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($datas as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $value->nat_name?></td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-food_menu&id=<?= $value->nat_id ?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->nat_id ?>, '../eventDb/food_menu.php?event=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>                
                <?php } ?>
            </tbody>
        </table> 
    </div>
</section>