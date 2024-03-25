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


 //  $mail = new Mailer;
 // var_dump($mail->to('user@.com')
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
