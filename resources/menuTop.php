<div class="bs-component">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?page=dashboard"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                <ul class="nav navbar-nav">
<!--                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i> จัดการผู้ใช้งาน <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?page=list-nation"><i class="glyphicon glyphicon-thumbs-up"></i> สัญชาติ</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php?page=list-user&user_type=<?= EMPLOYEE ?>"><i class="glyphicon glyphicon-user"></i> พนักงานร้าน</a></li>
                            <li><a href="index.php?page=list-user&user_type=<?= ONWER ?>"><i class="glyphicon glyphicon-user"></i> เจ้าของร้าน</a></li>
                            <li><a href="index.php?page=list-user&user_type="><i class="glyphicon glyphicon-user"></i> อืื่นๆ</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="glyphicon glyphicon-tree-conifer"></i> จัดการวัตถุดิบ <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="index.php?page=list-material">จัดการวัตถุดิบ</a></li>
                            <li><a href="index.php?page=list-material_type">จัดการประเภทวัตถุดิบ</a></li>
                            <li><a href="index.php?page=list-quantity">จัดการหน่วยเรียกของวัตถุดิบ</a></li>                            
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                            <li class="divider"></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <!--                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>-->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" onclick="logout('../eventDb/user.php?event=logout')">
                            <i class="glyphicon glyphicon-log-out"></i> ออกระบบ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>