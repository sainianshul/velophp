<?php 

namespace App\Core\Validation;

class Validation{

 
    private $error = [];
    private $isValidate = true;


   public function validate($inputs,$rules){


        $input_keys = array_keys($inputs);
        $rules_keys = array_keys($rules);


        foreach($rules_keys as $key){
        	
          if(!in_array($key,$input_keys)){

            $this->error[$key][] = $key . " Not Found ";
            $this->isValidate = false;

          }

        }




      foreach ($rules as $input => $rule) {
      
       $rulesArray = explode('|',$rule);
      foreach($rulesArray as $singleRule){
      	
      	if(isset($inputs[$input])){
   
          $in = explode(':',$singleRule);
          $method = $in[0];
         
            if(isset($in[1])){
         



         $isValidate =  $this->{$method}($input, $inputs[$input],$in[1]);


            if($this->isValidate && !$isValidate){
               $this->isValidate = false;
             }
       

            }else{

         $isValidate =  $this->{$method}($input, $inputs[$input]);
          if($this->isValidate && !$isValidate){
               $this->isValidate = false;
               

             }
            }
      	}
      }
      }


    $response['isValidate'] =  $this->isValidate;
    $response['error'] =  $this->error;

    return (object)$response;

   }



// validate rules 

   
      private function required($input,$data){

        if(empty($data)){
        	$this->error[$input][] = $input. " Not be Empty";
        	return false;
        }

            return true;


      }

   private function string($input,$data){

       if(!is_string($data)){
           $this->error[$input][] = $input . " Must Be String";
           return false;
       }
 
          return true;

      }


    private function integer($input,$data){

     if(!is_int($data)){
     	$this->error[$input][] = $input . " Must Be Integer";
     	return false;
     }

      return true;

    }

       
         private function email($input,$data){

         if(filter_var($data,FILTER_VALIDATE_EMAIL) == false){
     	$this->error[$input][] = $input . " Must Be Email";
     	return false;
         }

         return true;

      }



       private function min($input,$data,$len){

        if(strlen($data) < (int)$len){
     	$this->error[$input][] = $input . " Length Must Be more then " . $len;
         return false;
        }

        return true;

      }


       private function max($input,$data,$len){


        if(strlen($data) > (int)$len){
     	$this->error[$input][] = $input . " Length Not Be More then " . $len;
         return false;
        }

        return true;

      }


private function equal($input,$data,$len){ 

             if(strlen($data) != (int)$len){
     	$this->error[$input][] = $input . " Length Must Be Equal To " . $len;
         return false;
        }

        return true;

      }




public function error(){

return $this->error;

}







}  // end class 