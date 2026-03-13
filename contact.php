<?php
    $from = 'info@cameronwestauthor.com';
    $to = 'authorcameronwest@yahoo.com';
    $okMessage = "Thank you, I will get back to you soon!";
    $subject = 'New message from contact form';
    $name = $_POST["fname"];
    $email= $_POST["email"];
    $text= $_POST["message"];
    $phone= $_POST["phone"];

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $email . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td>'.$firstname.'  '.$laststname.'</td>
        </tr>
        <tr><td>Email: '.$email.'</td></tr>
        <tr><td>phone: '.$phone.'</td></tr>
        <tr><td>Text: '.$text.'</td></tr>
        
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        header("Location: https://www.cameronwestauthor.com/thanks.html");
        exit;
    }else{
        echo 'failed';
    }

?>
