<?php
/*
Plugin Name: PHP Mailler
Plugin URI:
Description: PHP SMTP kullanımı için yazılmış modül.
Version: 1.0
Author:
Author URI:
*/

namespace Extensions;

include_once(__DIR__ . '/php/class.phpmailer.php');

class PHPMailer extends Prepare
{
    private $data;

    public function __construct($host, $port, $ssl, $username, $password, $senderEmail, $senderName)
    {
        parent::__construct();
        $this->data->host = $host;
        $this->data->port = $port;
        $this->data->ssl = $ssl;
        $this->data->username = $username;
        $this->data->password = $password;
        $this->data->senderEmail = $senderEmail;
        $this->data->senderName = $senderName;
    }

    public function emailSend($sendEmailAddress, $mailSubject = '', $mailContent = '')
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SetLanguage('tr', 'language/');
        $mail->Host = $this->data->host;
        $mail->Port = $this->data->port;
        $mail->SMTPSecure = $this->data->ssl;
        $mail->SMTPAuth = true;
        $mail->Username = $this->data->username;
        $mail->Password = $this->data->password;
        $mail->From = $this->data->senderEmail;
        $mail->FromName = $this->data->senderName;
        $mail->AddAddress($sendEmailAddress);
        $mail->Subject = $mailSubject;
        $mail->Body = $mailContent;
        $mail->CharSet = "UTF-8";
        $mail->ContentType = "text/html";
        if(!$mail->Send())
            return false; else return true;
    }
}