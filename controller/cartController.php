<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '../../model/db.php');
?>
<?php
class CartController{
        private $__db;

        //contructor
        public function __construct()
        {
            $this->__db = Database::reuseOrNew();
        }
        //check exits ID product in cart
        public function isExitsProduct($idProduct, $idUser){
            $query = "SELECT * FROM cart where product_id = $idProduct and users_id = $idUser and status = 0";
            $result = $this->__db->select($query);
            return $result;
        }
        //check exits Id cart 
        public function isExitsCart($idCart, $idUsers){
            $query = "SELECT * FROM cart where id = $idCart and users_id = $idUsers";
            $result = $this->__db->select($query);
            return $result;
        }
        //Show cart in Cart.php
        public function getCart($id){
            $query = "SELECT a.quantity, a.id as idCart, b.* FROM cart as a, product as b, users as c WHERE a.product_id = b.id and a.users_id = c.id and c.id = '$id' and status = 0 ";
            $result = $this->__db->select($query);
            return $result;
        }
        //insert product 
        public function buyProduct($quantity, $idProduct, $idUser) {
            $checkIdProduct = $this->isExitsProduct($idProduct, $idUser);
            if(!$checkIdProduct){
                $query = "INSERT INTO `cart` (`product_id`, `quantity`, `users_id`, `id`, `status`) VALUES ('$idProduct', '$quantity', '$idUser', NULL, 0);";
                $result = $this->__db->insert($query);
                echo '<script type="text/javascript">alert("Thêm sản phẩm vào giỏ hàng thành công")</script>';
                header('location:cart.php');
            } else {
                $quantityUpdate = 0;
                while($quantityProduct = $checkIdProduct->fetch_assoc()){
                    $quantityUpdate = $quantityProduct['quantity'] + $quantity;
                }
                $query = "UPDATE cart SET quantity = $quantityUpdate WHERE product_id = $idProduct and users_id = $idUser";
                $result = $this->__db->insert($query);
                echo '<script type="text/javascript">alert("Cập nhật giỏ hàng thành công")</script>';
                header('location:cart.php');
            }
        }
        //destroy product
        public function destroyProduct($cartId, $idUsers){
            $checkIdCart = $this->isExitsCart($cartId, $idUsers);
            if($checkIdCart){
                $query =  "DELETE FROM `cart` WHERE `cart`.`id` = $cartId";
                $result = $this->__db->delete($query);
                header('location:cart.php');
            }else{
                echo '<script type="text/javascript">alert("Không có sản phẩm trong giỏ hàng")</script>';
            }
        }
        //Check out cart
        public function checkout($idUser){
            //status = 1 is checkout or status = 0  is product in cart
            $query = "UPDATE `cart` SET `status`= 1 WHERE `users_id` = '$idUser' and `status` = 0";
            $result = $this->__db->select($query);
            header('location: complete.php');
        }

}
?>