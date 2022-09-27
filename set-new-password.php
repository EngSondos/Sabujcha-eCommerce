<?php
$title = "Set New Password";

use APP\Model\Tables\User;
use APP\Validation\Validation;
include_once 'layout/header.php';
include_once 'layout/navbar.php';
include_once 'layout/breadcrumb.php';
include_once "APP/HTTP/Middleware/Auth/Auth.php";

$validation = new Validation;
$user = new User;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $validation->setInputName("Password")->setInputValue($_POST['password'])->require()
        ->regex(
            "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/")->confirm($_POST['password_confirm']);
        $validation->setInputName("Password Confirm")->setInputValue($_POST['password_confirm'])->require()
        ->regex(
            "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/");
        
    if(!$validation->get_Errors()){
        $user->setPassword($_POST['password'])->setEmail($_SESSION["verification_email"]);
        if($user->changepassword()){
          $result= $user-> getUserByEmail();
           $userinfo = $result->fetch_object();
           if ($userinfo) {
            $_SESSION['user'] = $userinfo;
        $suc_message = "<div class ='alert alert-success'>please wait .. ,You will go to Home page </div>";
        header('refresh:5;url=login.php');
        }else{
            $error = "<div class ='alert alert-danger'>some Thing!!</div>";


        }
    }else{
        $error = "<div class ='alert alert-danger'>some Thing</div>";

    }
}else{
    $error = "<div class ='alert alert-danger'>some Thing</div>";
}
}

?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Change password </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="password" name="password" placeholder="Password">
                                        <?= $validation->alertMessage("Password") ?? "" ?>
                                        <input type="password" name="password_confirm" placeholder="Password Confirm">
                                        <?= $validation->alertMessage("Password Confirm") ?? "" ?>
                                        <div class="button-box">
                                            <?= $error ?? "" ?>
                                           <?= $suc_message ?? "" ?>
                                            <button type="submit"><span>Change password</span></button>
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