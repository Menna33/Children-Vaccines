<?php 

function clean($input){

    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = trim($input);
    return $input;

}  
function validate($input,$flag,$length = 6){
   
    $status = true;

    switch ($flag) {
        case 1:
            # code...
            if(empty($input)){
                $status = false;
            }
            break;

        case 2: 
            # code ... 
             if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
                $status = false;
             }
            break;
        
        case 3: 
            #code ... 
            if(strlen($input) < $length){
                $status = false;
            }    
            break;

        case 4: 
            #code ... 
            if(!filter_var($input,FILTER_VALIDATE_URL)){
                $status = false;
            }    
            break; 

        case 5: 
            #code ... 
            if(!filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
            }  
            break;
           #National ID valdiation
        case 6:
            if(strlen($input) != 7){
                $status = false;
            }    
            break;
            #check for name not to be integer
        case 7:
            if(filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
            }  
            break;
            #check for phone number
        case 8:
            if(strlen($input) !=11){
                $status = false;
            }     
            break;
        case 9:
            if (!preg_match('/^[1-9]\d*$/',$input))
            //\^[0-9]*$/
            
            {
                $status = false;
            }
            break;
        case 10:
                if(strlen ($input) != 14){
                    $status= false;
                }    
                break; 
    }
    return $status;

}

?>