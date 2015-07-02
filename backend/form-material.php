<?php
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();
$pdo->conn = $pdo->open();

$id = '';
$name = '';
$volume = '';
$materialType = '';
$quantity = '';
$price = '';
$buydate = '';
$expdate = '';
$status = '';
$updatedate = '';
$picture = '';
$validatePicture = 'required data-bv-notempty-message="กรุณาเลือกภาพ"';
/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM material WHERE mat_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->mat_id;
    $name = $result->mat_name;
    $volume = $result->mat_volume;
    $materialType = $result->quan_id;
    $quantity = $result->$quan_id;
    $price = $result->$mat_price;
    $buydate = $result->$mat_buydate;
    $expdate = $result->$mat_expdate;
    $status = $result->mat_status;
    $picture = $result->mat_picture;
    $updatedate = $result->mat_modifieddate;
}
?>

<form class="form-horizontal" id="form_material"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-material"></i><b>ฟอร์มวัตถุดิบ</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-material" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">
            <section class="row">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-0">                        
                        <label for="code" class="col-sm-2 control-label">รูป</label>
                        <div class="col-sm-6">
                            <img class="img-rounded" style="max-height: <?= MAX_PICTURE_SIZE ?>px;max-width: <?= MAX_PICTURE_SIZE ?>px;" src="<?= PATH_UPLOAD . $picture ?>"/>
                        </div>
                        <div class="col-md-4 col-sm-offset-0"> 
                            <input type="file" name="file" <?= $validatePicture ?>/>                      
                        </div>  
                    </div>    
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name" class="col-sm-4 control-label">ชื่อวัตถุดิบ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="ชื่อวัตถุดิบ" 
                                   required data-bv-notempty-message="กรุณากรอก ชื่อวัตถุดิบ" 
                                   value="<?= $name; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="volume" class="col-sm-4 control-label">ปริมาณ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="volume" placeholder="ปริมาณ" 
                                   required data-bv-notempty-message="กรุณากรอก ปริมาณ" 
                                   value="<?= $volume; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="materialType" class="col-sm-4 control-label">ประเภทวัตถุดิบ </label>
                        <div class="col-sm-6">
                            <?php
                            $sql = 'SELECT *  FROM material_type ORDER BY type_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $materialTypes = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="materialType" required data-bv-notempty-message="กรุณาเลือกประเภทวัตถุดิบ">
                                <?php foreach ($materialTypes as $index => $data) { ?>
                                    <?php if ($materialType == $data->type_id) { ?>
                                        <option value="<?= $data->type_id ?>" selected><?= $data->type_name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->type_id ?>"><?= $data->type_name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="quantity" class="col-sm-4 control-label">หน่วยเรียก</label>
                        <div class="col-sm-6">
                            <?php
                            $sql = 'SELECT *  FROM quantity ORDER BY quan_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $quantitys = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="quantity" required data-bv-notempty-message="กรุณาเลือกหน่วยเรียก">
                                <?php foreach ($quantitys as $index => $data) { ?>
                                    <?php if ($quantity == $data->quan_id) { ?>
                                        <option value="<?= $data->quan_id ?>" selected><?= $data->quan_name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->quan_id ?>"><?= $data->quan_name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </section>            
            <section class="row">
                <div class="form-group">
                    <div class='col-md-6'>
                        <label for="price" class="col-sm-4 control-label">วันที่ซื้อมา</label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='datetimepicker_begin'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-search"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for="price" class="col-sm-4 control-label">วันหมดอายุ</label>
                        <div class="col-sm-4">
                            <div class='input-group date' id='datetimepicker_end'>
                                <input type='text' class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-search"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="price" class="col-sm-4 control-label">ราคา</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="price" placeholder="ราคา" 
                                   required data-bv-notempty-message="กรุณากรอก ราคา" 
                                   value="<?= $price; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="col-sm-4 control-label">สถานะ</label>
                        <div class="col-sm-4">
                            <?php $status = listMaterialStatus(); ?>
                            <select class="form-control" name="status" required data-bv-notempty-message="กรุณาเลือกสถานะ">                                
                                <?php foreach ($status as $key => $data) { ?>
                                    <?php if ($status == $key) { ?>
                                        <option value="<?= $key ?>" selected><?= $data ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $key ?>"><?= $data ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="panel-footer">

            <!-- hidden input-->
            <input type="hidden" name="id" value="<?= $id ?>"/>

            <div class="row">
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-10">
                        <button type="submit" class="btn btn-success">
                            <i class="glyphicon glyphicon-saved"></i> บันทึก
                        </button>
                        <button type="button" class="btn btn-danger">
                            <i class="glyphicon glyphicon-remove"></i> ล้างค่า
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var formId = 'form_material';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            submitPostForm(formId, '../eventDb/material.php?event=create');
        });
    });
</script>