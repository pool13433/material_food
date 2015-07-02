<div class="row" style="margin: 100px 10px 10px 10px">
    <div class="col-md-6 col-md-offset-3">
        <form class="form-horizontal" id="form_login"
              data-bv-message="This value is not valid"
              data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
              data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
              data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h1 class="panel-title">ลงชื่อเข้าใช้งานระบบ</h1>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="username" placeholder="username"
                                   required data-bv-notempty-message="กรุณากรอกชื่อเข้าใช้งานระบบ" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" name="password" placeholder="Password" 
                                   required data-bv-notempty-message="กรุณากรอกรหัสผ่าน" />
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Checkbox
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-log-in"></i> เข้าระบบ
                                </button>
                                <button type="reset" class="btn btn-default">
                                    <i class="glyphicon glyphicon-remove"></i> ปิด
                                </button>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var form_login = $('#form_login');
    $(document).ready(function () {
        var form = form_login.bootstrapValidator().on('success.form.bv', function (e) {
            e.preventDefault();
            login();
        });
    });
    function login() {
        $.ajax({
            url: '../eventDb/user.php?event=login',
            data: form_login.serialize(),
            type: 'post', dataType: 'json', success: function (data, textStatus, xhr) {
                alert(data.message);
                if (data.status) {
                    redirectDelay(data.url);
                }
            }, error: function (xhr, status, error) {
                //notifyShowing('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
                alert('top', 'error', '\n xhr ::==' + xhr + '\n status ::==' + status + '\n error ::==' + error);
            },
            statusCode: {
                404: function () {
                    alert("page not found");
                }
            }
        }).done(function () {
            console.log('requrest http success');
        }).fail(function (jqXHR, textStatus) {
            alert("We could not subscribe you please try again or contact us if the problem persists (" + textStatus + ").");
        });
    }</script>


