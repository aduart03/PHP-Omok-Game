<?php

require '../common/Common.php';
require '../common/Game.php';
require '../common/Response.php';

$uri = explode('?', $_SERVER['REQUEST_URI']);
// check if there's a query



if(count($uri) > 1){                            //count the aray length and check if its greatter than 1
	// get the strategy from the query aka $uri[1]
	$strategy = getParam("strategy", $uri[1]);     //call param function to 
	                                               //split the array and compare its "strtegy" 
	                                               //value to a strategy: ie. Smart or random
	// check if the strategy is valid
	if($strategy === "smart" || $strategy === "random"){
		// everything checks out, start a new game
		newGame($strategy);   //if there is a strategy then we create a new game and we use the class of the strategy 
		
	} else if ($strategy){
		// invalid strategy received
		echo json_encode(Response::withReason("Unknown strategy"));       //if we schoose a strategy that is not smart or random  we get this error
	} else {
		// no strategy found in the query
		echo json_encode(Response::withReason("Strategy not specified"));     //if no strategy chosen
	}
} else {
	// $uri did not contain a query
	echo json_encode(Response::withReason("Strategy not specified"));  //otherwise if ther is no smart or random then we get a defualt error of no strategy choosen
}


function newGame($strategy){
	 $pid = uniqid();              //example: $pid = "54cb50f5b6c21";
	$game = new Game($strategy);   
	saveGame($pid, $game);         //here we are saving the $pid from game into a text file or data file.
	echo json_encode(Response::withPid($pid));     //and we output the $pid confirmation
}
?>
