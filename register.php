<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/gijgo.min.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-md-12">
                    <img src="./images/logo.png" alt="" width="350px">
                </div>
            </div>
            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <a class="navbar-brand" href="#">Trang chủ</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Danh Mục</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#">Danh mục 1</a>
                                <a class="dropdown-item" href="#">Danh mục 2</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Thương Hiệu</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#">Thương Hiệu 1</a>
                                <a class="dropdown-item" href="#">Thương Hiệu 2</a>
                            </div>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 row">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        <div style="float: right;">

                        </div>
                </div>
                </form>
            </nav>
        </header>
        <div class="register">
            <div class="row">
                <h1 class="mx-auto">
                    Đăng kí
                </h1>
            </div>
            <div class="row pb-5">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 row">
                    <div class="col-md-12">
                    <?php 
                    $filepath = realpath(dirname(__FILE__)); // lấy đường dẫn file mặt đinh http://localhost/1824801030209_PhanTheNhut
                    include ($filepath . '../controller/HomeController.php'); // truyền file HomeController vào 
                    ?>
                    <?php
                        $HomeController = new HomeController();  //khởi tạo class HomeController 
                        //phát hiện event post là lấy giá trị từ form
                        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                            $email = $_POST['email'];
                            $username = $_POST['username'];
                            $phone = $_POST['phone'];
                            $password =  md5($_POST['password']);
                            $rePassword = md5($_POST['rePassword']); //MD5 là dạng mã hóa các kí tự
                            $register = $HomeController->register($email, $username, $phone, $password, $rePassword);
                        }
                    ?>
                    <?php
                        if(isset($register)) //hàm isset là nếu tồn taị một giá trị thì trả về true ngược lại false
                        {
                            echo $register; 
                        }
                    ?>
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" id=""
                                    aria-describedby="emailHelpId" placeholder="Nhập email">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" class="form-control" name="username" id=""
                                    aria-describedby="emailHelpId" placeholder="Nhập username">
                            </div>
                            <div class="form-group">
                                <label for="">phone</label>
                                <input type="text" class="form-control" name="phone" id=""
                                    aria-describedby="emailHelpId" placeholder="Nhập phone">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password" id=""
                                    aria-describedby="emailHelpId" placeholder="Nhập password">
                            </div>
                            <div class="form-group">
                                <label for="">Repassword</label>
                                <input type="password" class="form-control" name="rePassword" id=""
                                    aria-describedby="emailHelpId" placeholder="Nhập Repassword">
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-outline-success">Đăng kí</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="page-footer font-small blue">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2020 Copyright: nhutphan25082000@gmail.com
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
    <script src="./js/jquery-1.9.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/gijgo.min.js"></script>
    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
        });
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    </div>
</body>

</html>