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
    $stmt = $pdo->conn->prepare('SELECT * FROM nation WHERE nat_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->nat_id;
    $name = $result->nat_name;
    $updatedate = $result->nat_modifieddate;
}
?>

<form class="form-horizontal" id="form_nation"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-nation"></i><b>ฟอร์มสัญชาติ</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?page=list-nation" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">
            
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="name" class="col-sm-4 control-label">ชื่อสัญชาติ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="ชื่อสัญชาติ" 
                                   required data-bv-notempty-message="กรุณากรอก ชื่อสัญชาติ" 
                                   value="<?= $name; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </section>
        </div>
        <div class="panel-footer">
            
        <!-- hidden input-->
        <input type="hidden" name="id" value="<?=$id?>"/>
            
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
        var formId = 'form_nation';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            submitPostForm(formId, '../eventDb/nation.php?event=create');
        });
    });
</script>