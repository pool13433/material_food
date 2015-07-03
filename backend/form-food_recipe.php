<?php
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();
$pdo->conn = $pdo->open();

$id = '';
$name = '';
$updatedate = '';

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM food_recipe WHERE mat_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->mat_id;
    $name = $result->mat_name;
    $updatedate = $result->mat_modifieddate;
}
?>

<form class="form-horizontal" id="form_food_recipe"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-food_recipe"></i><b>ฟอร์มวัตถุดิบ</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-food_recipe" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">

            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="material" class="col-sm-4 control-label">วัตถุดิบ </label>
                        <div class="col-sm-6">
                            <?php
                            $sql = 'SELECT *  FROM material ORDER BY mat_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $materials = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="material" required data-bv-notempty-message="กรุณาเลือกประเภทวัตถุดิบ">
                                <?php foreach ($materials as $index => $data) { ?>
                                    <?php if ($material == $data->mat_id) { ?>
                                        <option value="<?= $data->mat_id ?>" selected><?= $data->mat_name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->mat_id ?>"><?= $data->mat_name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="col-sm-4 control-label">จำนวน</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="ชื่อวัตถุดิบ" 
                                   required data-bv-notempty-message="กรุณากรอก ชื่อวัตถุดิบ" 
                                   value="<?= $name; ?>"/>
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
        var formId = 'form_food_recipe';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            submitPostForm(formId, '../eventDb/food_recipe.php?event=create');
        });
    });
</script>