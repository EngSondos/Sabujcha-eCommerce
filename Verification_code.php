<?php

use APP\Model\Tables\User;
use APP\Validation\Validation;

$title = "Verification_code";
include 'layout/header.php';
include_once 'layout/navbar.php';

$validation = new Validation;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $validation->setInputName("Verification Code")->setInputValue($_POST['verification_code'])->require()->exist('users','verification_code');
    if (!$validation->get_Errors()) {
        $user = new User;
        $user->setEmail($_SESSION["verification_email"])->setVerification_code($_POST['verification_code']);
        $result =  $user->comparedcode();
        if ($result) {
            $user->setEmail_verified_at(date("Y-m-d H-i-s"));
            if ($user->updateVerificationCode()) {
                unset($_SESSION["verification_email"]);
                if($_GET['page']=='login'||$_GET['register']){

                $suc_message = "<div class ='alert alert-success'>please wait .. ,You will go to the login page </div>";
                header("Refresh:5; url=login.php");
            }elseif($_GET['page']=='forget'){
                $suc_message = "<div class ='alert alert-success'>please wait .. ,You will go to the set New password page </div>";
                header("Refresh:5; url=set-new-password.php");
            }
        }
        } else {
                $error = "<div class ='alert alert-danger'>some Thing!!</div>";
            }
        }
    }





?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <aclass="active" data-toggle="tab" href="#lg2">
                            <h4> Verification Code </h4>
                            </a>
                    </div>

                    <div id="lg2" class="tab-pane">
                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form action="" method="post">
                                    <?= $suc_message ?? "" ?>
                                    <?= $error ?? "" ?>

                                    <input type="text" name="verification_code" placeholder="Verification Code " value=<?= $_POST['Verification_code'] ?? "" ?>>
                                    <?= $validation->alertMessage("Verification Code") ?? "" ?>

                                    <div class="button-box">
                                        <button type="submit" class="w-100"><span>Submit</span></button>
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


?>