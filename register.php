<?php

use APP\Mailer\SendVerificationCode;
use APP\Model\Tables\User;
use APP\Validation\Validation;
$title="Register";
include_once 'layout/header.php';
include_once 'layout/navbar.php';
include_once 'layout/breadcrumb.php';




$validation =new Validation;

if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST)){


    $validation->setInputName("First Name")->setInputValue($_POST['first_name'])->require()->string()->max(32);

    $validation->setInputName("Last Name")->setInputValue($_POST['last_name'])->require()->string()->max(32);

    $validation->setInputName("gender")->setInputValue($_POST['gender'])->require()->in_rang(['m','f']);

    $validation->setInputName("Email")->setInputValue($_POST['email'])->require()->regex("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix")->unique('users','email');

    $validation->setInputName("Phone")->setInputValue($_POST['phone'])->require()->regex("/^01[0-2]{1}[0-9]{8}/")->unique('users','phone');
   
    $validation->setInputName("Password")->setInputValue($_POST['password'])->require()->confirm($_POST['password_confirmation'])
    ->regex("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/"
    , " Must be Minimum eight characters, at least one letter, one number and one special character");
    $validation->setInputName("Password Confirmation ")->setInputValue($_POST['password_confirmation'])->require();
    $verification_code =rand(100000,999999);
    if(empty($validation->get_Errors())){
        $user = new User;
        $user->setFirst_name($_POST['first_name'])->setLast_name($_POST['last_name'])->setEmail($_POST['email'])->setPhone($_POST['phone'])
        ->setPassword($_POST['password'])->setGender($_POST['gender'])->setVerification_code($verification_code);
        // print_r($user);
        if(!$user->create()){
            $error="<div class ='alert alert-danger'>Try again later </div>";
        }else{

            $body=" <p>Dear , {$_POST['first_name']} {$_POST['last_name']} , <p>
            <p>Your Verification code Is {$verification_code}<p>";
            $subject="Verification Code ##";
            $sendCode= new SendVerificationCode($_POST['email'],$subject,$body,"Verification Code For Your Email");
            if($sendCode->send()){
            $_SESSION["verification_email"] = $_POST['email'];
            header("location:verification_code.php");
            }else{
                $error ="Some Thing Worng ,  Try Again";
            }

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
                                    <h4> Register </h4>
                                </a>
                            </div>
                            
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="" method="post">
                                            <?=$error ?? ""?>

                                                <input type="text" name="first_name" placeholder="First Name " value=<?=$_POST['first_name'] ?? ""?>>
                                                <?=  $validation->alertMessage("First Name") ?? ""?>
                                                <input type="text" name="last_name" placeholder="Last Name" value=<?=$_POST['last_name'] ?? ""?>>
                                                <?=  $validation->alertMessage("Last Name") ?? ""?>

                                                <label for="gender ">gender </label>
                                                <select name="gender" class="mb-5">
                                                    <option value='m' >Male</option>
                                                    <option value='f'>Female</option>
                                                </select>
                                                <?=  $validation->alertMessage("Gender") ?? ""?>

                                                <input name="email" placeholder="Email" type="email" value=<?=$_POST['email'] ?? ""?>>
                                                <?=  $validation->alertMessage("Email") ?? ""?>

                                                <input type="tel" name="phone" placeholder="Phone" value=<?=$_POST['phone'] ?? ""?>>
                                                <?=  $validation->alertMessage("Phone") ?? ""?>

                                                <input type="password" name="password" placeholder="Password">
                                                <?=  $validation->alertMessage("Password") ?? ""?>
                                                <input type="password" name="password_confirmation" placeholder="Password confirm">

                                                <div class="button-box">
                                                    <button type="submit"><span>Register</span></button>
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