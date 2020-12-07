<?php
$filepath  = realpath(dirname(__FILE__));
include_once ($filepath.'../../model/db.php');


class ProductController
{
    private $__db;
        
    //contructor
    public function __construct()
    {
        $this->__db = Database::reuseOrNew();
    }
    //show product index
    public function showProduct(){
        $query = 'select * from product';
        $result = $this->__db->select($query);
        return $result;
    }
    //show product detail 
    public function getProductDetail($id){
        $query = "select * from product where id = '$id'";
        $result = $this->__db->select($query);
        return $result;
    }
    //show product buy many
    public function productBuyMany(){
        $query = 'SELECT * FROM `product` ORDER BY id DESC LIMIT 4';
        $result = $this->__db->select($query);
        return $result;
    }
}

?>