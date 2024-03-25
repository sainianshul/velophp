<?php 

use \App\Core\Http\Route;
use \App\Controllers\Home;


//  route object
$routes = new Route;


$routes->get('/',function(){echo "This is Me";})
->get('/Home/index',[Home::class,'index'])
->get('/Home/session',[Home::class,'session'])
->get('/Home/mm',[Home::class,'mm'])
->get('/Home/mid',[Home::class,'mid'])
->get('/Home/db',[Home::class,'db'])
->post('/Home/loginsave',[Home::class,'loginsave'])

->get('/Home/login',[Home::class,'login'])

->get('/Home/mail',[Home::class,'mail']);



// return object 
return $routes;