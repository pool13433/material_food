<?php
require_once '../connDb/DbConnection.php';
$pdo = new DbConnection();
$pdo->conn = $pdo->open();

$id = '';
$fname = '';
$lname = '';
$username = '';
$password = '';
$card_id = '';
$nation_id = '';
$tel = '';
$sex = '';
$age = 0;
$email = '';
$address = '';
$updatedate = '';
$picture = '';
$type = (empty($_GET['user_type']) ? '' : $_GET['user_type']);
$code = $pdo->createUserSerialCode($type);
if (empty($code)) {
    $code = getDataList($type, listUserPrefixStatus()) . '00001';
}
$validatePicture = 'required data-bv-notempty-message="กรุณาเลือกภาพส่วนตัว"';
/*
 * ตรวจสอบ id เพื่อดูว่ากำลังแก้ไขหรือสร้างใหม่ด้วย ฟังชั่น empty() = ว่าง , !empty = ไม่ว่าง
 */
if (!empty($_GET['id'])) {
    $stmt = $pdo->conn->prepare('SELECT * FROM user WHERE user_id =:id');
    $stmt->execute(array(':id' => $_GET['id']));
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    /*
     * เซตค่าใส่ตัวแปร
     */
    $id = $result->user_id;
    $code = $result->code;
    $fname = $result->fname;
    $lname = $result->lname;
    $username = $result->username;
    $password = $result->password;
    $card_id = $result->card_id;
    $nation_id = $result->nation_id;
    $sex = $result->sex;
    $age = $result->age;
    $tel = $result->tel;
    $email = $result->email;
    $address = $result->address;
    $updatedate = $result->modifieddate;
    $type = $result->type;
    $picture = $result->picture;
    $validatePicture = '';
}
?>
<form class="form-horizontal dropzone" id="form_user"
      data-bv-message="This value is not valid"
      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" enctype="multipart/form-data">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-user"></i><b>ฟอร์มผู้ใช้งาน</b>
            </h4>
            <div class="btn-group pull-right">
                <a href="index.php?user_type=<?= $type ?>&page=list-user" class="btn btn-primary">
                    <i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ
                </a>
            </div>
        </header>
        <div class="panel-body">
            <section class="row">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-0">                        
                        <label for="code" class="col-sm-2 control-label">รูปส่วนตัว</label>
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
                        <label for="code" class="col-sm-4 control-label">รหัสบัตรพนักงาน</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="code" placeholder="รหัสบัตรพนักงาน" 
                                   required data-bv-notempty-message="กรุณากรอกรหัสบัตรพนักงาน" 
                                   value="<?= $code; ?>" readonly/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="card_id" class="col-sm-4 control-label">รหัสบัตรประชาชน</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="card_id" placeholder="รหัสบัตรประชาชน" 
                                   required data-bv-notempty-message="กรุณากรอกรหัสบัตรประชาชน" maxlength="13"
                                   value="<?= $card_id; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <hr/>
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
            <hr/>
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
                    <div class="col-md-6">
                        <label for="fname" class="col-sm-4 control-label">ที่อยู่</label>
                        <div class="col-sm-8">                        
                            <textarea class="form-control" name="address" placeholder="ที่อยู่"
                                      required data-bv-notempty-message="กรุณากรอกชื่อ" rows="10"
                                      ><?= $address ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="fname" class="col-sm-4 control-label">สัญชาติ</label>
                        <div class="col-sm-4">                        
                            <?php
                            $sql = 'SELECT *  FROM nation ORDER BY nat_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $natios = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="nation" required data-bv-notempty-message="กรุณากรอกสัญชาติ">
                                <?php foreach ($natios as $index => $data) { ?>
                                    <?php if ($nation_id == $data->nat_id) { ?>
                                        <option value="<?= $data->nat_id ?>" selected><?= $data->nat_name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->nat_id ?>"><?= $data->nat_name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="sex" class="col-sm-4 control-label">เพศ</label>
                        <div class="col-sm-4">
                            <?php $sexs = listUserSex(); ?>
                            <select class="form-control" name="sex" required data-bv-notempty-message="กรุณาเลือกเพศ">                                
                                <?php foreach ($sexs as $key => $data) { ?>
                                    <?php if ($sex == $key) { ?>
                                        <option value="<?= $key ?>" selected><?= $data ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $key ?>"><?= $data ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="age" class="col-sm-4 control-label">อายุ</label>
                        <div class="col-sm-3">
                            <?php $ages = listUserAge(20, 70); ?>
                            <select class="form-control" name="age" required data-bv-notempty-message="กรุณาเลือกอายุ">                                
                                <?php foreach ($ages as $key => $data) { ?>
                                    <?php if ($age == $key) { ?>
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
                            <input type="text" class="form-control" name="tel" placeholder="เบอร์โทรศัพท์" 
                                   required data-bv-notempty-message="กรุณากรอกเบอร์โทรศัพท์" maxlength="10"
                                   value="<?= $tel; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="panel-footer">

            <!-- hidden input-->
            <input type="hidden" name="id" value="<?= $id ?>"/>
            <input type="hidden" name="type" value="<?= $type ?>"/>
            <input type="hidden" name="picture" value="<?= $picture ?>"/>

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
            submitMutipartPostForm(e.target, '../eventDb/user.php?event=create');
        });

    });
</script>