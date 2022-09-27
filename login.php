<?php
$title = "Login";

use APP\Model\Tables\User;
use APP\Validation\Validation;
include_once 'layout/header.php';
include_once 'layout/navbar.php';
include_once 'layout/breadcrumb.php';
include_once "APP/HTTP/Middleware/Auth/Auth.php";

$validation = new Validation;
$user = new User;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $validation->setInputName("Email")->setInputValue($_POST['email'])->require()->regex("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix")->exist('users', 'email');
    $validation->setInputName("Password")->setInputValue($_POST['password'])->require()
        ->regex(
            "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/"
        );
    if (!$validation->get_Errors()) {
        $user->setEmail($_POST['email']);
        $result = $user->getUserByEmail();
        $userinfo = $result->fetch_object();
        if ($userinfo) {
            if (password_verify($_POST['password'], $userinfo->password)) {
                if (!empty($userinfo->email_verified_at)) {
                    $_SESSION['user'] = $userinfo;
                    if(isset($_POST['remember_me'])){
                        setcookie('user', $_POST['email'], time() + (86400 * 30),'/');
                    }
                    header("location:index.php");
                } else {
                    $_SESSION["verification_email"] = $userinfo->email;
                    header("location:verification_code.php?page=login");
                    die;
                }
            } else {
                $error = "<div class='alert alert-danger '> Email or Password is Incorrect</div>";
            }
        } else {
            $error = "<div class='alert alert-danger '> Email or Password is Incorrect</div>";
        }
    }
    
}
#post 
#validation 
#notVerified -> header-->verification_code 
#verified => 
#compare in data base 

?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? "" ?>">
                                        <?= $validation->alertMessage("Email") ?? "" ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->alertMessage("Password") ?? "" ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" name="remember_me">
                                                <label>Remember me</label>
                                                <a href="new-password.php">Forgot Password?</a>
                                            </div>
                                            <?= $error ?? "" ?>
                                            <button type="submit"><span>Login</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php

include_once 'layout/footer.php';
include_once 'layout/scrips.php';

?>