<!-- Modal -->
<div class="modal fade" id="dialog-material_recipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">เลือกวัตถุดิบที่ใช้สำหรับปรุงอาหาร</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                        <tr>
                            <th>เลือก</th>
                            <th style="width: 20%">รูป</th>
                            <th>ชื่อ</th>
                            <th>จำนวน</th>
                            <th style="width: 25%">วัน</th>
                            <th>ประเภทวัตถุดิบ</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo->conn = $pdo->open();
                        $sql = ' SELECT m.mat_id,';
                        $sql .= ' m.mat_name,m.mat_volume,m.mat_price,m.mat_status,m.mat_picture,';
                        $sql .= ' DATE_FORMAT(m.mat_buydate,\'%d/%m/%Y\') as mat_buydate,';
                        $sql .= ' DATE_FORMAT(m.mat_expdate,\'%d/%m/%Y\') as mat_expdate,';
                        $sql .= ' mt.type_name';
                        $sql .= ' FROM material m';
                        $sql .= ' LEFT JOIN material_type mt ON mt.type_id = m.type_id';
                        $sql .= ' WHERE m.mat_status = ' . MATERIAL_NAORMAL;
                        $sql .= ' ORDER BY mt.type_name,m.mat_name';
                        $stmt = $pdo->conn->prepare($sql);
                        $stmt->execute();
                        $datas = $stmt->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach ($datas as $key => $value) { ?>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="chooseMaterial(<?=$value->mat_id?>,'<?=$value->mat_name?>')">
                                        <i class="glyphicon glyphicon-ok-circle"></i> <?= ($key + 1) ?>
                                    </button>
                                </td>
                                <td><img src="<?= PATH_UPLOAD_MATERIAL . $value->mat_picture ?>" style="max-height: <?= MAX_PICTURE_SIZE_MINI ?>px;max-width: <?= MAX_PICTURE_SIZE_MINI ?>px;"/></td>
                                <td><?= $value->mat_name ?></td>
                                <td><?= $value->mat_volume ?></td>
                                <td>
                                    <label class="label label-success">วันที่ซื้อ : <?= $value->mat_buydate ?></label>
                                    <label class="label label-warning">วันหมดอายุ : <?= $value->mat_expdate ?></label>
                                </td>
                                <td><?= $value->type_name ?></td>
                                <td>
                                    <h4>
                                        <label class="label label-<?= getDataListByKey($value->mat_status, listMaterialStatus(), 'BGCOLOR') ?>">
                                            <?= getDataListByKey($value->mat_status, listMaterialStatus(), 'NAME') ?>
                                        </label>
                                    </h4>
                                </td>
                            </tr>                
                        <?php } ?>
                    </tbody>
                </table> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
