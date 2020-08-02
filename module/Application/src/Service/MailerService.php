<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 10:48
 */

namespace Application\Service;


use Laminas\Mime\Part;
use User\Entity\User;
use Laminas\Mail\Message;
use Laminas\Mail\Transport\Smtp;
use Laminas\Mail\Transport\SmtpOptions;

class MailerService
{
    protected $config;

    protected $viewRenderer;

    public function __construct(array $config, $viewRenderer)
    {
        $this->config = $config;
        $this->viewRenderer = $viewRenderer;
    }

    public function sendPassResetMail(User $user):bool
    {
        $dest = $user->getEmail();

        // Send an email to user.
        $subject = 'Password Reset';


        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $protocol = isset($_SERVER['HTTPS'])?'https':'http';

        // Produce HTML of password reset email

        $httpHost = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:'localhost';
        $protocol = isset($_SERVER['HTTPS'])?'https://':'http://';
        $host = $protocol . $httpHost;

        $bodyHtml = $this->viewRenderer->render(
            'service/email/forgotten-password',
            [
                'host'=>$host,
                'token' => $user->getPasswordResetToken(),
            ]);

        $html = new Part($bodyHtml);
        $html->type = "text/html";

        $dest = [
            'email'=>$user->getEmail(),
            'name'=>$user->getAlias(),
        ];
        return $this->sendMail($html, $subject, $dest);


    }

    protected function sendMail(Part $html, string $subject, array $dest):bool
    {

        $body = new \Laminas\Mime\Message();
        $body->addPart($html);

        $mail = new Message();
        //$mail->setEncoding($this->config['encoding']);
        $mail->setBody($body);
        $mail->setFrom($this->config['from_mail'], $this->config['from_name']);
        $mail->addTo($dest['email'], $dest['name']);
        $mail->setSubject($subject);

        // Setup SMTP transport
        $transport = new Smtp();
        $options   = new SmtpOptions($this->config['smtp_options']);
        $transport->setOptions($options);

        try{
            $transport->send($mail);
            return true;
        } catch (\Exception $e){
            die(var_dump($e->getMessage()));
            return false;
        }
    }

}