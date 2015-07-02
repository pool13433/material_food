<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue to Bootsnipp</h1>
            <div class="account-wall">
<!--                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                     alt="">-->
                <form class="form-signin" id="form_login"
                      data-bv-message="This value is not valid"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                    <input type="text" class="form-control" name="username" placeholder="Email"
                           required data-bv-notempty-message="กรุณากรอกชื่อบริษัทการเดินรถ" />
                    <input type="password" class="form-control" name="password" placeholder="Password" 
                           required data-bv-notempty-message="กรุณากรอกชื่อบริษัทการเดินรถ" />
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Sign in</button>
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me">
                        Remember me
                    </label>
                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
            <a href="#" class="text-center new-account">Create an account </a>
        </div>
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