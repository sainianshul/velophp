<?php

namespace App\Core\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Core\View\View;


class Mailer
{
    private PHPMailer $mailer;

    private string $fromName;
    private string $fromEmail;
    private string $to = '';
    private string $subject ='';
    private string $body ='';
    private string $template ='';
    private bool $isHtml = true;
    private array $template_param = [];

    public function __construct()
    {   $this->fromName = $_ENV['MAIL_FROM_NAME'] ?? '';
         $this->fromEmail = $_ENV['MAIL_FROM_EMAIL'] ?? ''; 
        $this->mailer = new PHPMailer(true);
    }

     
      public function to(string $email){

       $this->to = $email;
       return $this;

      }


      public function subject(string $subject){
  
       $this->subject = $subject;
       return $this;

      }


     
      public function body(string $body){
       
        $this->body = $body;
        return $this;

      }
 

     public function isHtml(bool $isHtml){

       $this->isHtml = $isHtml;
       return $this;

     }


     public function template(string $template,array $param = [],string $engine = 'twig'){

      $this->template = $template;
      $this->param = $param;
      return $this;

     }


public function fromName(string $fromName){

       $this->fromName = $fromName;
       return $this;

     }

     public function fromEmail(string $fromEmail){

       $this->fromEmail = $fromEmail;
       return $this;

     }




    public function send()
    {
        try {
            // Server settings
            $this->mailer->isSMTP();
            $this->mailer->Host = $_ENV['MAIL_HOST'];
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = $_ENV['MAIL_USERNAME'];
            $this->mailer->Password = $_ENV['MAIL_PASSWORD'];
            $this->mailer->SMTPSecure = 'tls';
            $this->mailer->Port = 587;

            // Sender and recipient
            $this->mailer->setFrom($this->fromEmail ?? '', $this->fromName ?? '');
            
            if(!empty($this->to)){
            $this->mailer->addAddress($this->to);
             }

            // Content
            $this->mailer->isHTML($this->isHtml);
            $this->mailer->Subject = $this->subject;

            if(!empty($this->template)){
            	$view = new View('twig','../app/Email_Templates');
             $html = $view->render($this->template,$this->param);
                $this->mailer->Body = $html;
            }else{
                $this->mailer->Body = $this->body;
            }

            // Send email
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            // Log or handle the error
            return false;
        }
    }
}

?>
