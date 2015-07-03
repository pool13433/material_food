<?php
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();
$pdo->conn = $pdo->open();

$id = '';
$foodType = '';
$recipe = '';
$name = '';
$price = '';
$cost = '';
$picture = PICTURE_DEFAULT;
$status = '';
$validatePicture = 'required data-bv-notempty-message="กรุณาเลือกภาพ"';
/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM food_menu WHERE food_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->food_id;
    $foodType = $result->type_id;
    $recipe = $result->recipe_id;
    $name = $result->food_name;
    $price = $result->food_price;
    $cost = $result->$food_cost;
    $picture = $result->food_picture;
    $status = $result->food_status;
}
?>

<form class="form-horizontal" id="form_food_menu"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-food_menu"></i><b>ฟอร์มเมนูอาหาร</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-food_menu" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#food_main" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-list-alt"></i> ข้อมูลเมนูอาหาร
                    </a>
                </li>
                <li role="presentation">
                    <a href="#food_recipe" aria-controls="profile" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-list"></i> รายการวัตถุดิบ
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <?php require './food_menu_main.php';?>
                <?php require './food_menu_recipe.php';?>
            </div>
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
        var formId = 'form_food_menu';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            submitPostForm(formId, '../eventDb/food_menu.php?event=create');
        });
    });
</script>