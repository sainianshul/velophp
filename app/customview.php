<?php 

namespace App;

class View{

  
  
   public function __construct(
   	private string $path,
  private array $param
){

   $this->path = $path;
   $this->param = $param;

   }

 
    public function __get($key){

    return $this->param[$key] ?? null;

    }




   public static function make($path,$param = []){

     return new static($path,$param);

   }



public function __toString() : string{

  extract($this->param);
  return $this->render($this->path);


}


 
public function render() : string{


$path =  __DIR__ . "/Views/".$this->path.".php";

if(file_exists($path)){
	
	ob_start();
	include $path;
	$data = ob_get_clean();

     return (string)$data;


}else{
	return "file not found";
}


}
 
 




}