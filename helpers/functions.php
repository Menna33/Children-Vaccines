<?php  

 function  printMessages($txt ){
    if(isset($_SESSION['Message'])){
        foreach ($_SESSION['Message'] as $key => $value) {
            # code...
            echo '* '.$value.'<br>';
        }
           unset($_SESSION['Message']);
    
    }else{
         echo $txt;
    }
}

?>