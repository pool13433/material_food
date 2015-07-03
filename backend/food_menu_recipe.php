<div role="tabpanel" class="tab-pane" id="food_recipe">
    <section class="row">
        <div class="form-group">
            <div class="col-md-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#dialog-material_recipe">
                    <i class="glyphicon glyphicon-search"></i> ค้นหา
                </button>
                <?php require '../dialog/dialog-material_recipe.php'; ?>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="form-group">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="materialChoose">
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    function chooseMaterial(material_id, material_name) {
        var materialChoose = $('#materialChoose');
        var tr = ' <tr>';
        tr += '  <td>' + material_id + '</td>';
        tr += '   <td>' + material_name + '</td>';
        tr += '   <td>';
        tr += '   <button type="button" class="btn btn-danger" onclick="removeTr(this)">';
                tr += '   <i class="glyphicon glyphicon-remove"></i>';
        tr += '   </button>';
        tr += '   </td>';
        tr += '  </tr>';
        materialChoose.append(tr);
        dialogMaterial('hide');
    }
    function dialogMaterial(status) {
        $('#dialog-material_recipe').modal(status);
    }
    function removeTr(button){
        $(button).parent().parent().remove(); // remove td
    }
</script>