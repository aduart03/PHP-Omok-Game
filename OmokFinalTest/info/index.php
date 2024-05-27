<?php
//Strategies Smart and Random
$strategies = array("Smart", "Random");     //strategies of the game
//size of board 15 by 15
$size = 15;     //here we are createing a board of size 15
$test = new Gameinfo($size,$strategies);        //we are creating the game with the stratgies and the size of the board

if(empty($_SERVER["REQUEST_METHOD"])){      //we pull the request method from the server and if there is none then its true
	json_encode("URL not found");          //if no game then we execute this  code block
} else {
	$test -> toJson();     //if there is a request method then we convert the input to json format and output to the browser
}

//gameinfo classs
class GameInfo{
	public $size;
	public $strategies;
	
	public function __construct($size, $strategies){
		$this -> size = $size;
		$this -> strategies = $strategies;
	}
	
	public function toJson(){
		echo json_encode($this);
	}
}
?>
