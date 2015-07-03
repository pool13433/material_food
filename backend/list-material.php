<?php
require_once '../connDb/DbConnection.php';
?>
<section class="panel">
    <header class="panel-heading clearfix">        
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
            <i class="glyphicon glyphicon-thumbs-up"></i><b>ข้อมูลรายการวัตถุดิบทั้งหมด</b>
        </h4>
        <div class="btn-group pull-right">
            <a href="index.php?page=form-material" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus-sign"></i> สร้าง
            </a>
        </div>
    </header>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th style="width: 20%">รูป</th>
                    <th>ชื่อ</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>วันที่ซื้อ</th>
                    <th>วันหมดอายุ</th>
                    <th>ประเภทวัตถุดิบ</th>
                    <th>สถานะ</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = new DbConnection();
                $pdo->conn = $pdo->open();
                $sql = ' SELECT m.mat_id,';
                $sql .= ' m.mat_name,m.mat_volume,m.mat_price,m.mat_status,m.mat_picture,';
                $sql .= ' DATE_FORMAT(m.mat_buydate,\'%d/%m/%Y\') as mat_buydate,';
                $sql .= ' DATE_FORMAT(m.mat_expdate,\'%d/%m/%Y\') as mat_expdate,';
                $sql .= ' mt.type_name';
                $sql .= ' FROM material m';
                $sql .= ' LEFT JOIN material_type mt ON mt.type_id = m.type_id';
                $sql .= ' ORDER BY mt.type_name,m.mat_name';
                $stmt = $pdo->conn->prepare($sql);
                $stmt->execute();
                $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
                ?>
                <?php foreach ($datas as $key => $value) { ?>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><img src="<?= PATH_UPLOAD_MATERIAL . $value->mat_picture ?>" style="max-height: <?= MAX_PICTURE_SIZE_MINI ?>px;max-width: <?= MAX_PICTURE_SIZE_MINI ?>px;"/></td>
                        <td><?= $value->mat_name ?></td>
                        <td><?= $value->mat_volume ?></td>
                        <td><?= $value->mat_price ?></td>
                        <td><?= $value->mat_buydate ?></td>
                        <td><?= $value->mat_expdate ?></td>
                        <td><?= $value->type_name ?></td>
                        <td>
                            <h4>
                                <label class="label label-<?= getDataListByKey($value->mat_status, listMaterialStatus(), 'BGCOLOR') ?>">
                                    <?= getDataListByKey($value->mat_status, listMaterialStatus(), 'NAME') ?>
                                </label>
                            </h4>
                        </td>
                        <td style="width: 8%;">
                            <a href="index.php?page=form-material&id=<?= $value->mat_id ?>" class="btn btn-success">
                                <i class="glyphicon glyphicon-pencil"></i>แก้ไข
                            </a>
                        </td>
                        <td style="width: 8%;">
                            <button type="button" class="btn btn-danger" onclick="delete_data(<?= $value->mat_id ?>, '../eventDb/material.php?event=delete')">
                                <i class="glyphicon glyphicon-trash"></i>ลบ
                            </button>
                        </td>
                    </tr>                
                <?php } ?>
            </tbody>
        </table> 
    </div>
</section>