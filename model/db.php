<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath .'../config.php');
?>
<?php
    class Database {
        protected static $instance;

        public $host   = DB_HOST;
        public $user   = DB_USER;
        public $pass   = DB_PASS;
        public $dbname = DB_NAME;
        public $link;
        
        //contructor
        public function __construct(){
            if (isset(Database::$instance)) {
                throw new Exception("Database Reconstruct !");
            }

            $this->__connectDB();
            Database::$instance = $this;
        }

        public static function reuseOrNew() {
            if (!Database::$instance) {
                new Database();
            }

            return Database::$instance;
        }

        private function __connectDB(){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if(!$this->link){
                $this->error ="Connection fail".$this->link->connect_error;
                return false;
            }
        }
        //select database
        public function select($query){
            $result = $this->link->query($query) or die($this->link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            } else {
                return false;
            }
        }
        
        //insert database
        public function insert($query){
            $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
            if($insert_row){
                return $insert_row;
            } else {
                return false;
            }
        }
        //insert database
        public function delete($query){
            $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
            if($delete_row){
                return $delete_row;
            } else {
                return false;
            }
        }
        
    }
?>