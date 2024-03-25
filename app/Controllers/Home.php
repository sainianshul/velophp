<?php 

declare(strict_types=1);
namespace App\Controllers;

use \App\Core\Session\Session;
use \App\Core\Http\Response;
use \App\Core\Mail\Mailer;
use \App\Core\Validation\Validation;
use \App\Core\Http\Request;
use \App\Core\Upload\Upload;

class Home{

  public function index(){
    
//View::render('first.twig');

echo "This is index";
//echo $html;

  }


public function store(){

//echo $twig->render('first.twig', ['name' => "Raghu"]);

echo "This is store here ";
}





public function mail(){


// // Create a new PHPMailer instance
// $mail = new \PHPMailer\PHPMailer\PHPMailer();

// // Set PHPMailer to use SMTP
// $mail->isSMTP();

// // Enable SMTP debugging
// // 0 = off (for production use)
// // 1 = client messages
// // 2 = client and server messages
// $mail->SMTPDebug = 0;

// // Set the hostname of the mail server
// $mail->Host = 'smtp.gmail.com';

// // Enable SMTP authentication
// $mail->SMTPAuth = true;

// // SMTP username (your Gmail email address)
// $mail->Username = 'anshulsainionline@gmail.com';

// // SMTP password (your Gmail password or App Password)
// $mail->Password = 'cckakankxmfbrerp';

// // Enable TLS encryption
// $mail->SMTPSecure = 'tls';

// // Set the SMTP port (465 for SSL, 587 for TLS)
// $mail->Port = 587;

// // Set the sender and recipient email addresses
// $mail->setFrom('Velo PHP', 'Anshul Saini');
// $mail->addAddress('anshulsaini554@gmail.com', 'ANshul 554');

//  $mail->isHTML(true);
// // Set email subject and body
// $mail->Subject = 'Test Email via Gmail SMTP';
// $mail->Body  = View::getRender('verification.twig',['name' => 'Pappan', 'verification_code' => '12345']);


// // Send the email
// if (!$mail->send()) {
//     echo 'Error: ' . $mail->ErrorInfo;
// } else {
//     echo 'Email has been sent successfully!';
// }


 //  $mail = new Mailer;
 // var_dump($mail->to('anshulsaini554@gmail.com')
 //       ->subject('This is Testing Mail')
 //       ->template('VerificationMail.twig',['name'=>'Anshul','verification_code'=> 'n3dy9r7irgfh39'])
 //       ->send());

}



public function session($req){

//Session::set('name','anshul');

//echo Session::get('name');



// echo Response::view("verification.twig",['name' => 'pappan','verification_code' => '7y2hrury8r73yry39r8'])
// ->send();


//echo Response::download('mm.txt')->send();

//Response::back()->send();

Response::view('verification.twig')->send();


}


// 
public function mm($req){
  echo "<pre>";

   print_r($req->server());


}



public function mid(){

echo "This is middleware";

}


public function db(){


//    $user = new \App\Models\User();
//   //  $user->update(['name' => 'king'], ['name' =>'Pappan']);
//    echo "<pre>";
//   // var_dump($user->all());

//    //$user->get();

//     // Assuming 'name' is a column name and 'pappan' is a string value
// var_dump($user->select(['name','email','*'])->whereAnd("name","=","user3")->orderby('id DESC')->limit(5)->get());


$validate = new Validation();

$result = $validate->validate(['name' => "raghu"],['name' => "required|email"]);

 var_dump($result->error);


}


public function login(){


  Response::view('login.twig')->send();



}


public function loginsave(Request $req){


  //Response::view('login.twig')->send();

//var_dump($req->post());

echo "<pre>";
 $upload = new Upload();
 var_dump($upload->file('file')->save());


}





}