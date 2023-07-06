<?php

    $mail = new PHPMailer();
    $mail->isSMTP();


    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = 'no-reply@vertconclube.com.br';
    $mail->Password = 'Senti@nela2021';

    $mail->setFrom('no-reply@vertconclube.com.br', 'vertconclube');

    $mail->addReplyTo('no-reply@vertconclube.com.br', 'vertconclube');



?>