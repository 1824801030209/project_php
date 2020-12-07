<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mua Bán Trái Cây</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/gijgo.min.css">
    <link rel="stylesheet" href="./css/flickity.min.css">
</head>

<body>
    <?php
        $filepath = realpath(dirname(__FILE__));
        include_once ($filepath . '../../controller/HomeController.php');        
        include_once ($filepath.'../../controller/ProductController.php');
    ?>
    <div class="container">
        <header>
            <div class="row">
                <div class="col-md-12">
                    <img src="./images/logo.png" alt="" width="350px">
                </div>
            </div>

            <nav class="navbar navbar-expand-sm navbar-light bg-light">
                <a class="navbar-brand" href="index.php">
                    <h3>Home</h3>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                    data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                       
                    </ul>
                    <form method="POST" action="search.php" class="form-inline my-2 my-lg-0 row">
                        <input class="form-control mr-sm-2" name="search_product" type="text" placeholder="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        <div style="float: right;">
                            <a class="btn btn-sm btn-outline-success ml-5" href="cart.php" role="button">
                                Cart
                            </a>
                            <?php
                                if(isset($_SESSION['username']))
                                    {
                            ?>
                            <a class="btn btn-sm btn-outline-success ml-5" href="#" role="button">
                                <i class="fa fa-user-circle mr-1"></i> <?php echo $_SESSION['username']?>
                            </a>
                            <a class="btn btn-sm btn-danger ml-2 mr-2" href="?logout" role="button">
                                </i> Logout
                            </a>
                            <?php 
                                    } else {
                            ?>
                            <a class="btn btn-sm btn-outline-success ml-5" href="login.php" role="button">
                                <i class="fa fa-user-circle mr-1"></i> Đăng Nhập
                            </a>
                            <a class="btn btn-sm btn-outline-success ml-2 mr-2" href="register.php" role="button">
                                <i class="fa fa-user-circle mr-1"></i> Đăng kí
                            </a>
                            <?php   
                                }
                                if(isset($_GET['logout'])){
                                    $_SESSION['username'] = Null;
                                    $_SESSION['users_id'] = Null;
                                    header('Location:index.php');
                                }
                            ?>

                        </div>
                </div>
                </form>
            </nav>
        </header>