<div role="tabpanel" class="tab-pane active" id="food_main">
    <section class="panel">
        <header class="panel-heading clearfix">        
            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">
                <i class="glyphicon glyphicon-food_menu"></i><b>ฟอร์มเมนูอาหาร</b>
            </h4>
        </header>
        <div class="panel-body">
            <section class="row">
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-0">                        
                        <label for="code" class="col-sm-2 control-label">รูป</label>
                        <div class="col-sm-6">
                            <img class="img-rounded" style="max-height: <?= MAX_PICTURE_SIZE ?>px;max-width: <?= MAX_PICTURE_SIZE ?>px;" src="<?= PATH_UPLOAD_MATERIAL . $picture ?>"/>
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
                        <label for="name" class="col-sm-4 control-label">ชื่อเมนูอาหาร</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" placeholder="ชื่อเมนูอาหาร" 
                                   required data-bv-notempty-message="กรุณากรอก ชื่อเมนูอาหาร" 
                                   value="<?= $name; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="price" class="col-sm-4 control-label">ราคา</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="price" placeholder="ราคา" 
                                   required data-bv-notempty-message="กรุณากรอก ราคา" 
                                   value="<?= $price; ?>"/>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="foodType" class="col-sm-4 control-label">ประเภทเมนูอาหาร </label>
                        <div class="col-sm-6">
                            <?php
                            $sql = 'SELECT *  FROM food_type ORDER BY type_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $foodTypes = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="foodType" required data-bv-notempty-message="กรุณาเลือกประเภทเมนูอาหาร">
                                <?php foreach ($food_menuTypes as $index => $data) { ?>
                                    <?php if ($foodType == $data->type_id) { ?>
                                        <option value="<?= $data->type_id ?>" selected><?= $data->type_name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->type_id ?>"><?= $data->type_name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="recipe" class="col-sm-4 control-label">หน่วยเรียก</label>
                        <div class="col-sm-6">
                            <?php
                            $sql = 'SELECT *  FROM material_recipe ORDER BY recipe_name ASC';
                            $stmt = $pdo->conn->prepare($sql);
                            $stmt->execute();
                            $recipes = $stmt->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="recipe" required data-bv-notempty-message="กรุณาเลือกหน่วยเรียก">
                                <?php foreach ($recipes as $index => $data) { ?>
                                    <?php if ($recipe == $data->recipe_id) { ?>
                                        <option value="<?= $data->recipe_id ?>" selected><?= $data->volume_use ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $data->recipe_id ?>"><?= $data->volume_use ?></option>
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
    </section>
</div>