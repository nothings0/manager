<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PVN Shop</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Quản lý dữ liệu</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="~/Supplier"><i class="fa fa-square"></i> Nhà cung cấp</a></li>
                    <li><a href="~/Customer"><i class="fa fa-user"></i> Khách hàng</a></li>
                    <li><a href="~/Shipper"><i class="fa fa-motorcycle"></i> Người giao hàng</a></li>
                    <li><a href="~/Employee"><i class="fa fa-users"></i> Nhân viên</a></li>
                    <li><a href="~/Category"><i class="fa fa-th-list"></i> Loại hàng</a></li>
                    <li><a href="~/Product"><i class="fa fa-square"></i> Mặt hàng</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Quản lý bán hàng</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="~/Order"><i class="fa fa-shopping-cart"></i> Đơn hàng</a></li>
                    <li><a href="~/Order/Create"><i class="fa fa-plus"></i> Lập đơn hàng</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
<header class="main-header">
    <a href="~/" class="logo">
        <span class="logo-mini"><b>PVN</b></span>
        <span class="logo-lg"><b>PVN</b> Shop</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                @{
                    var userData = User.GetUserData();
                    if(userData != null)
                    {
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img class="user-image" alt="User Image"
                                     src="@(string.IsNullOrEmpty(userData.Photo) ? Url.Content("~/themes/dist/img/user.jpg") : Url.Content($"~/images/employees/{userData.Photo}"))" />
                                <span class="hidden-xs">@userData.DisplayName</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img class="img-circle" alt="User Image"
                                         src="@(string.IsNullOrEmpty(userData.Photo) ? Url.Content("~/themes/dist/img/user.jpg") : Url.Content($"~/images/employees/{userData.Photo}"))" />
                                    <p>
                                        @userData.DisplayName
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="~/Account/ChangePassword" class="btn btn-default btn-flat">Đổi mật khẩu</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="~/Account/Logout" class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    }
                    else
                    {
                        <div style="height: 50px; display: flex; align-items: center; padding: 10px;">
                            <button class="btn">
                                <a href="/Account/Login">Đăng nhập</a>
                            </button>
                        </div>
                    }
                }
            </ul>
        </div>
    </nav>
</header>
<div class="container">
  <!-- Content here -->
</div>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2024 <a href="#">PVN</a>.</strong> All rights
    reserved.
</footer>
</body>
</html>
