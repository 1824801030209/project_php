<?php
    include_once 'includes/header.php';
    include_once 'controller/cartController.php';
    $cart = new CartController();
?>
<?php
       //check id product
        $id = null;
        if(!isset($_GET['prodid']) || $_GET['prodid'] == NULL ){
            echo "<script>window.location='index.php'</script>";
        }
        else {
            $id = $_GET['prodid'];
        }
        //post product
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['users_id'])){
                $idUser = $_SESSION['users_id'];
                $quantity = $_POST['quantity'];
                $ct = $cart->buyProduct($quantity, $id, $idUser);
            }else{
                echo "<script>window.location='login.php'</script>";
            }
        }

?>

<div class="body-card m-3 ">
    <div class="row" style="background-color: rgb(218, 216, 216);">
        <div class="d-flex p-3 text-white" style="margin: auto;">
            <div class="p-2 pr-4 bg-warning" style="border-radius: 20px 0 0 20px;"><a style="color: black;"
                    href="index.html"><strong>HOME</strong></a></div>
            <div class="p-2 bg-success" style="border-radius: 0 20px 20px 0;"><a style="color: white;"
                    href="productDetail.html"><strong>PRODUCT</strong></a></div>
        </div>
    </div>
    <?php
        $product = new ProductController();
        $show_product_detail = $product->getProductDetail($id);
        if($show_product_detail){
            while($result = $show_product_detail->fetch_assoc()){
    ?>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="row m-3">
                <img src="<?php echo $result['image_url']?>" class="zoom" alt="" width="100%">
            </div>
            <!-- <div class="card row mt-3 p-3">
                <div class="card-header">
                    SẢN PHẨM LIÊN QUAN
                </div>
                <div class="card-body">
                    <div class="carousel" data-flickity='{ "groupCells": true }'>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                        <div class="carousel-cell">
                            <a href="productDetail.html">
                                <img class="imageRelate" src="./images/Traicay/chuoi.jpg" class="zoom" alt=""
                                    width="100%" height="100%">
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="col-md-6 container">
            <div class="headerProd">
                <div class="row">
                    <h1>
                        <?php echo $result['name']?>
                    </h1>
                </div>
                <div class="row">
                    <i class="fa fa-star fa-2x text-danger"></i>
                    <i class="fa fa-star fa-2x text-danger"></i>
                    <i class="fa fa-star fa-2x text-danger"></i>
                    <i class="fa fa-star fa-2x text-danger"></i>
                    <i class="fa fa-star fa-2x text-muted"></i>
                    <span class="fa fa-2x">
                        <h5>(109) Votes</h5>
                    </span>
                </div>
            </div>
            <hr>
            <div class="bodyProd mb-2">
                <div class="row">
                    <?php 
                        if($result['price_sale'] <  $result['price'] && $result['price_sale'] == 0){
                    ?>
                    <div class="col-md-3">
                        <h2 class="price">
                            <?php echo number_format($result['price']) ;?>
                        </h2>
                    </div>
                    <?php
                    }else{
                    ?>
                    <div class="col-md-3">
                        <h2 class="price">
                            <?php echo number_format($result['price_sale']) ?>
                        </h2>
                    </div>
                    <div class="col-md-9">
                        <h2 class="priceSale" style="text-decoration: line-through; color: red;">
                            <?php echo number_format($result['price'])?>
                        </h2>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <form method="POST">
                    <div class="row mt-3 p-2"
                        style="box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);">
                        <div class="col-md-2 m-2">
                            <input type="number" class="form-control w-35" name="quantity" value="1"
                                aria-describedby="helpId" placeholder="1" min="1" required>
                        </div>
                        <div class="col-md-9 m-2">
                            <button type="submit" class="btn btn-warning w-100">Mua Hàng</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="footerProd">
                <div class="mt-3">
                    <br>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home">Mô tả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#menu1">Lợi ích</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active"><br>
                            <p>
                                <?php
                                echo $result['description'];
                               ?>
                            </p>

                        </div>
                        <div id="menu1" class="container tab-pane fade"><br>
                            <p>
                                <?php
                                echo $result['heathy_description'];
                               ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
            }
        }
    ?>
</div>
<?php
    include_once 'includes/footer.php';
?>