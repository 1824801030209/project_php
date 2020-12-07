<?php
    include_once 'includes/header.php';
    include_once 'controller/cartController.php';
?>
<?php
    $cart = new cartController();
    $sum = 0; //tổng tiền
    $show_cart_product = $cart->getCart($_SESSION['users_id']);
    if($show_cart_product){
        if(!isset($_SESSION['username'])){
            header('location: index.php');
        }
        if(isset($_GET['cartId']) ){
            if(isset($_SESSION['users_id'])){
                $idUser = $_SESSION['users_id'];
                $idCart = $_GET['cartId'];
                $cart->destroyProduct($idCart, $idUser);
            }else{
                echo "<script>window.location='login.php'</script>";
            }
        }
        if(isset($_GET['checkout'])){
           $status = $cart->checkout($_SESSION['users_id']);
        }
    }else{
        echo '<script type="text/javascript">alert("Giỏ hàng trống ấn OK để quay lại!!")</script>';
        echo "<script>window.location='index.php'</script>";
    }
    
?>
<div class="bodyCart m-3">
    <div class="row" style="background-color: rgb(218, 216, 216);">
        <div class="d-flex p-3 text-white" style="margin: auto;">
            <div class="p-2 pr-2 bg-warning" style="border-radius: 20px 0 0 20px;"><a style="color: black;"
                    href="index.html"><strong>HOME</strong></a></div>
            <div class="p-2 bg-success" style="border-radius: 0 20px 20px 0;"><a style="color: white;"
                    href="productDetail.html"><strong>CART</strong></a></div>
        </div>
    </div>
    <div class="tableCard row mt-4">
        <div class="card col-md-8 mr-5">
            <div class="card-body">
                <table class="table table-reponsive table-bordered">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng (Kg)</th>
                            <th>Tổng tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           
                            if($show_cart_product){
                                while($result = $show_cart_product->fetch_assoc()){
                                    if($result['price'] > $result['price_sale'] && $result['price_sale'] == 0){
                                        $sum += $result['price']*$result['quantity'];
                                    }else{
                                        $sum += $result['price_sale']*$result['quantity'];
                                    }
                        ?>
                        <tr>
                            <td>
                                <img src="<?php echo $result['image_url']?>" width="150px"
                                    class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                    alt="">
                            </td>
                            <td><b><?php echo $result['name']?></b></td>
                            <td>
                                <b>
                                    <?php
                                        if($result['price'] >  $result['price_sale'] && $result['price_sale'] == 0){
                                            echo number_format($result['price']);
                                        }else {
                                            echo number_format($result['price_sale']);
                                        }
                                    ?>
                                </b>
                            </td>
                            <td><input class="form-control" value="<?php echo $result['quantity']?>" type="number"></td>
                            <td>
                                <b>
                                    <?php 
                                        if($result['price'] >  $result['price_sale'] && $result['price_sale'] == 0){
                                            echo $result['price'] * $result['quantity'];
                                        }else{
                                            echo $result['price_sale'] * $result['quantity'];
                                        }
                                    ?>
                                </b>
                            </td>
                            <td>
                            <a class="btn btn-danger"  onclick="return confirm('Bạn có muốn xóa không?');" href="?cartId=<?php echo $result['idCart']?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                            </td>
                        </tr>
                        <?php
                                }
                            }else{
                                echo "Không có sản phẩm nào được thêm";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card col-md-3">
            <div class="card-body">
                <h5 class="mb-3">Tổng số tiền</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Số tiền tạm thời
                        <span>
                        <?php 
                            echo $sum;
                        ?>
                        </span>
                    </li>
                    <!-- <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Shipping
                        <span>0</span>
                    </li> -->
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>Tổng số tiền</strong>
                            <strong>
                                <p class="mb-0">(Bao gồm VAT)</p>
                            </strong>
                        </div>
                        <span>
                            <strong>
                                <?php
                                    echo $sum;
                                ?>
                            </strong>
                        </span>
                    </li>
                </ul>
                <a href="?checkout=1" style="color: green;"
                    class="btn btn-outline-success btn-block waves-effect waves-light">
                    Tiếp tục thanh toán</a>
            </div>
        </div>
    </div>
</div>
<?php
    include_once 'includes/footer.php';
?>