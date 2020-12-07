<?php
    include_once 'includes/header.php';
?>
<?php
    if(isset($_SESSION['username'])){
        header('location: index.php');
    }
?>
    <div class="row">
        <div class="mx-auto p-5">
        <form method="POST" action="login.php">
            <?php
                $HomeController = new HomeController();
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $email = $_POST['email'];
                    $password = md5($_POST['password']);
                    $login = $HomeController->login($email, $password);
                }

                if(isset($login)) {
                    echo "<p class='alert alert-danger'> $login </p>";
                }
            ?>

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </div>
<?php
    include_once 'includes/footer.php';
?>