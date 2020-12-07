<?php
    include_once 'includes/header.php';
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
    <div class="row">
        <div class="col-md-3">
            <div class="card row">
                <div class="card-header">
                    <b>Trái cây theo loại</b>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Chuối</li>
                        <li class="list-group-item">Ổi</li>
                        <li class="list-group-item">Dưa hấu</li>
                    </ul>
                </div>
            </div>
            <div class="card row mt-3">
                <div class="card-header">
                    <b>Trái cây theo giá</b>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Trên 150.000</li>
                        <li class="list-group-item">Từ 100.000 - 150.000</li>
                        <li class="list-group-item">Từ 80.000 - 100.000</li>

                    </ul>
                </div>
            </div>
            <div class="card row m-3">
                <div class="card-header">
                    <b>Ngày</b>
                </div>
                <div class="mx-auto">
                    <div class="row">
                        <table class="table-condensed table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th colspan="7">
                                        <span class="btn-group">
                                            <a class="btn"><i class="icon-chevron-left"></i></a>
                                            <a class="btn active">Tháng 7 năm 2020</a>
                                            <a class="btn"><i class="icon-chevron-right"></i></a>
                                        </span>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Su</th>
                                    <th>Mo</th>
                                    <th>Tu</th>
                                    <th>We</th>
                                    <th>Th</th>
                                    <th>Fr</th>
                                    <th>Sa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="muted">29</td>
                                    <td class="muted">30</td>
                                    <td class="muted">31</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td>15</td>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td class="btn-primary"><strong>20</strong></td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                </tr>
                                <tr>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                    <td class="muted">1</td>
                                    <td class="muted">2</td>
                                    <td class="muted">3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Sản phẩm trái cây nổi bật</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                            $product = new ProductController();
                            $show_product = $product->showProduct();
                            if($show_product){
                                while($result = $show_product->fetch_assoc()){
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

                             }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <b>Trái cây bán nhiều</b>
                </div>
                <?php
                    $product = new ProductController();
                    $show_product_Many = $product->productBuyMany();
                    if($show_product_Many){
                    while($result = $show_product_Many->fetch_assoc()){
                ?>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <img class="card-img-top" src=<?php echo $result['image_url']?> alt="Card image">
                            <span><?php echo $result['name']?></span>
                        </li>
                    </ul>
                </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <b>Thống kê lượt truy cặp</b>
                </div>
                <div class="card-body">
                    <div class="row">
                        <b><span>Tổng truy cập: 699</span></b>
                    </div>
                    <div class="row">
                        <b style="color: green;"> Đang online: 12 </b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'includes/footer.php';
?>