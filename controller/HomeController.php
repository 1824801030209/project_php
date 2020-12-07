<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '../../model/db.php');
    session_start();
?>
<?php
    class HomeController {
        private $__db;
        
        //contructor
        public function __construct()
        {
            $this->__db = Database::reuseOrNew();
        }

        //Đăng Nhập
        public function login($email , $password){

            //chống hack nhoaaa
            $email = mysqli_real_escape_string($this->__db->link, $email);
            $password = mysqli_real_escape_string($this->__db->link, $password);

            //check login và đăng nhập nè
            if (empty($email) || empty($password)) {
                $alert = 'Vui lòng nhập tài khoản và mật khẩu';
                return $alert;
            } else {
                $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
                $result = $this->__db->select($query);

                if($result){
                    $value = $result->fetch_assoc();
                    $_SESSION['username'] = $value['username'];
                    $_SESSION['users_id'] = $value['id'];
                    header('Location:index.php');
                } else {
                    $alert = 'sai tài khoản mật khẩu';
                    return $alert;
                }
            }
        }
        public function register($email, $username, $phone, $password, $rePassword){
            //NÀY ĐỂ CHỐNG BỌN NÓ HACK :))
            $email = mysqli_real_escape_string($this->__db->link, $email);
            $username = mysqli_real_escape_string($this->__db->link, $username);
            $password = mysqli_real_escape_string($this->__db->link, $password);
            $rePassword = mysqli_real_escape_string($this->__db->link, $rePassword);

            //xử lý
            if(empty($email) || empty($username) || empty($password) || empty($rePassword) || empty($phone)) // trường hợp 1 trong tất cả form rổng
            {
                $result = "<p class='alert alert-danger'>Vui lòng nhập đầy đử thông tin</p>";
                return $result;
            }
            else if(isset($password) &&  isset($rePassword)) //nếu có đủ password và repassword
            {
               //check password và repassword
               if($password === $rePassword){
                  $query = "INSERT INTO users (email, username, phone, password) VALUES ('$email', '$username','$phone', '$password')";
                  $result = $this->__db->insert($query);
                  if($result){
                    $results = "<p class='alert alert-success'>Đăng kí không thành công</p>";
                    return $results;
                  }
                  else 
                  {
                    $result = "<p class='alert alert-danger'>Đăng kí không thành công</p>";
                    return $result;
                  }
               }
               else 
               {
                   $result = "<p class='alert alert-danger'>Mật khẩu không khớp</p>";
                   return $result;
               }
               
            }
        }
        public function SearchProduct($keyword){
            $query = "select * from product where name LIKE '%$keyword%'";
            $result = $this->__db->select($query);
            return $result;
        }
    }

?>