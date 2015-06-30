<?php
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();
$pdo->conn = $pdo->open();

$id = '';
$fname = '';
$lname = '';
$username = '';
$password = '';
$idcard = '';
$mobile = '';
$email = '';
$address = '';
$updatedate = '';
$updateby = '';
$status = (empty($_GET['user_status']) ? '' : $_GET['user_status']);
$code = $pdo->createUserSerialCode($status);
if (empty($code)) {
    $code = getDataList($status, listUserPrefixStatus()) . '00001';
}

/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE u_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->u_id;
    $code = $result->u_code;
    $fname = $result->u_fname;
    $lname = $result->u_lname;
    $username = $result->u_username;
    $password = $result->u_password;
    $idcard = $result->u_idcard;
    $mobile = $result->u_mobile;
    $email = $result->u_email;
    $address = $result->u_address;
    $updatedate = $result->u_modifieddate;
    $updateby = $result->u_modifiedby;
    $status = $result->u_status;
}
?>

<form class="form-horizontal" id="form_user"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-user"></i><b>ฟอร์มผู้ใช้งาน</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?user_status=<?= $status ?>&page=list-user" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="code" class="col-sm-4 control-label">รหัสบัตรพนักงาน</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="code" placeholder="รหัสบัตรพนักงาน" 
                                   required data-bv-notempty-message="กรุณากรอกรหัสบัตรพนักงาน" 
                                   value="<?= $code; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="idcard" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="idcard" placeholder="รหัสบัตรประชาชน" 
                                   required data-bv-notempty-message="กรุณากรอกรหัสบัตรประชาชน" 
                                   value="<?= $idcard; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="fname" class="col-sm-4 control-label">ชื่อเข้าใช้งานระบบ</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="username" placeholder="ชื่อเข้าใช้งานระบบ" 
                                   required data-bv-notempty-message="กรุณากรอก username" 
                                   value="<?= $username; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="lname" class="col-sm-4 control-label">รหัสผ่าน</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" 
                                   required data-bv-notempty-message="กรุณากรอกpassword" 
                                   value="<?= $password; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="col-sm-4 control-label">ยืนยันรหัสผ่าน</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="password" placeholder="ยืนยันรหัสผ่าน" 
                                   required data-bv-notempty-message="กรุณากรอกpassword" 
                                   value="<?= $password; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="fname" class="col-sm-4 control-label">ชื่อ</label>
                        <div class="col-sm-6">                        
                            <input type="text" class="form-control" name="fname" placeholder="ชื่อ" 
                                   required data-bv-notempty-message="กรุณากรอกชื่อ" 
                                   value="<?= $fname; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="col-sm-4 control-label">สกุล</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="lname" placeholder="สกุล" 
                                   required data-bv-notempty-message="กรุณากรอกสกุล" 
                                   value="<?= $lname; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="fname" class="col-sm-2 control-label">ที่อยู่</label>
                        <div class="col-sm-8">                        
                            <textarea class="form-control" name="address" placeholder="ที่อยู่"
                                required data-bv-notempty-message="กรุณากรอกชื่อ" 
                                ><?=$address?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="fname" class="col-sm-4 control-label">อีเมลล์</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="email" placeholder="อีเมลล์" 
                                   required data-bv-notempty-message="กรุณากรอกอีเมลล์" 
                                   value="<?= $email; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="col-sm-4 control-label">เบอร์โทรศัพท์</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="mobile" placeholder="เบอร์โทรศัพท์" 
                                   required data-bv-notempty-message="กรุณากรอกเบอร์โทรศัพท์" 
                                   value="<?= $mobile; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="panel-footer">
            
        <!-- hidden input-->
        <input type="hidden" name="id" value="<?=$id?>"/>
        <input type="hidden" name="status" value="<?=$status?>"/>
            
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
        var formId = 'form_user';
        $('#' + formId).bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            submitPostForm(formId, '../eventDb/user.php?event=create');
        });
    });
</script>