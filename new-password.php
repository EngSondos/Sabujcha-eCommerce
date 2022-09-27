<?php
$title = "Forget Password";

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
    if (!$validation->get_Errors()) {
        $user->setEmail($_POST['email']);
        $result = $user->getUserByEmail();
       $result= $result->fetch_object();
        if ($result) {
                if (empty($result->email_verified_at)) {
                    header("location:verification_code.php?page=forget");
                    die;
                } else {
                    $_SESSION["verification_email"] = $_POST['email'];

                    header("location:set-new-password.php");
                    die;
                }
            } else {
                $error = "<div class='alert alert-danger '> Email is Incorrect</div>";
            }
        } else {
            $error = "<div class='alert alert-danger '> SOme Thing Wrong Try Again</div>";
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
                            <h4> Enter Your Email </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="" method="post">
                                        <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? "" ?>">
                                        <?= $validation->alertMessage("Email") ?? "" ?>
                                        <div class="button-box">
                                            <?= $error ?? "" ?>
                                            <button type="submit"><span>Set Password</span></button>
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