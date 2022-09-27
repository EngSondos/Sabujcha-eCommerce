<?php
namespace APP\Mailer;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';

abstract class Mail{
    protected string $mailHost='smtp.office365.com';
    protected string $mailUserName='ntib20@hotmail.com';
    protected string $mailPassword ='Nti12345';
    protected int $mailport= 587;
    protected PHPMailer $mail ;
    protected string  $NameFrom=" ";
    protected string $mailTo,$subject,$body,$title=" ";



//Create an instance; passing `true` enables exceptions
function __construct($mailTo,$subject,$body,$NameFrom ="E-commerce")
{
    $this->mailTo=$mailTo;
    $this->subject=$subject;
    $this->body=$body;
   $this->NameFrom=$NameFrom;

    $this->mail=new PHPMailer(true);
    //Server settings
    $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $this->mail->isSMTP();                                            //Send using SMTP
    $this->mail->Host       = $this->mailHost;                     //Set the SMTP server to send through
    $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $this->mail->Username   = $this->mailUserName;                     //SMTP username
    $this->mail->Password   = $this->mailPassword;                               //SMTP password
    $this->mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $this->mail->Port       = $this->mailport;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients  
}
abstract function send();
}
        //Name is optional
?>