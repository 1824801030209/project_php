<?php
    include_once 'includes/header.php';
?>
<?php
    $HomeController = new HomeController();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $keyword = $_POST['search_product']; 
        $prodSearch = $HomeController->SearchProduct($keyword);      
    }else{
        header('location: index.php');
    }
?>
<div id="demo" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./images/Traicay/chomchom.jpg" alt="First slide" width="100%" height="200px">
        </div>
        <div class="carousel-item">
            <img src="./images/Traicay/saurieng.jpg" alt="First slide" width="100%" height="200px">
        </div>
        <div class="carousel-item">
            <img src="./images/Traicay/dua.jpg" alt="First slide" width="100%" height="200px">
        </div>
    </div>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<div class="body-card m-3">
    <div class="row m-2">
        <div class="col-md -12">
            <h1>Kết quả tìm kiếm: <?php echo $keyword?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>Trái cây tìm kiếm</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                            if($prodSearch){
                                while($result = $prodSearch->fetch_assoc()){
                        ?>
                        <div class="col-md-4 mt-2" style="width: 300px;">
                            <div class="card ">
                                <img class="card-img-top" src="<?php echo $result['image_url']?>" alt="Card image">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $result['name']?></h4>
                                    <p class="card-text">Đơn giá:
                                        <?php
                                        if($result['price_sale'] < $result['price'] && $result['price_sale']  == 0){
                                            echo number_format($result['price']);
                                        }
                                        echo number_format($result['price_sale']);
                                    ?> VNĐ</p>
                                    <a href="productDetail.php?prodid=<?php echo $result['id']?>"
                                        class="btn btn-outline-primary">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                        <?php
                                   }

                             }else{
                                 echo "Không có sản phẩm";
                             }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'includes/footer.php';
?>