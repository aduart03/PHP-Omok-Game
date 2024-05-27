<?php
// used to get the parammeters from the query
// extra parameters and order doesn't matter
function getParam($toFind, $query){
    $params = explode('&', $query);
    foreach($params as $p){
        $p = strtolower($p);
        $param = explode('=', $p);
        if($param[0] === $toFind){
            if($param[1]){
                return $param[1];
            }
            else {
                break;
            }
        }
    }
    return FALSE;
}

function saveGame($pid, $game){
    // write json version of game to a file named with pid
    $filename = "../writable/savedGames/$pid.txt";
    // TODO handle the case where file isn't found with Response
    $handle = fopen($filename, 'w') or die('Cannot open file:  '.$filename);
    fwrite($handle, json_encode($game));
    fclose($handle);
}

function getParam2($toFind1, $toFind2, $query){     //example pid=65de79a252f94&x=4&y=2
    $params = explode('&', $query);		           //pid=65de79a252f94,  x=4, y=2
    
    $index = 0;
    
    foreach($params as $p){
        
        $counter = 0 + $index;
        $p = strtolower($p);
        $param = explode('=', $p);                  //pid ,65de79a252f94 , x ,4 ,y ,2
        
        //if x
        if($param[$counter-1] === $toFind1){        
            //array that will have stored values
            $newCoord = array();                    
            array_push($newCoord, $param[$counter]);
            
            foreach($params as $p){
                $p = strtolower($p);
                $param = explode('=', $p);
                
                //since x already checked out, check if y
                if($param[$counter-1] === $toFind2){
                    array_push($newCoord, $param[$counter]);
                    return $newCoord;
                    break;
                } 
            } 
        }
        
        $index++;  
    }
    
    return FALSE;
}