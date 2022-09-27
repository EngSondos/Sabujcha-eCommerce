<?php
namespace APP\Mailer;
use PHPMailer\PHPMailer\Exception;
use APP\Mailer\Mail;

class SendVerificationCode extends Mail{
    protected string  $NameFrom=" ";

function send(){
    try {
    
        //Recipients
        $this->mail->setFrom($this->mailUserName, $this->NameFrom);
        $this->mail->addAddress($this->mailTo);               //Name is optional
    
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $this->subject;
        $this->mail->Body    = $this->body;
        $this->mail->send();
        return true;
        echo 'Message has been sent';
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        return false;
    }
}
}