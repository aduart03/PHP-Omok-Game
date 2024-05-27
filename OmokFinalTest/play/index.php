
 <?php
//Ethan Duarte
//PLAY

require '../common/Common.php';
require '../common/Game.php';
require '../common/Response.php';
require 'Strategy.php';

$uri = explode('?', $_SERVER['REQUEST_URI']);     //we pull query from the server
//$uri = "pid=65de79a252f94&x=4&y=2";     //sample query

// check is there's a query
if(count($uri) > 1){
	// get the pid from the query aka $uri[1]
	$pid = getParam("pid", $uri[1]);       //split query into array to find the pid if the query only
	// check if strategy was found
	if($pid){          //if there is a query
	    
		// get the x and y coordinates from the query
	    $xandy = getParam2("x","y", $uri[1]);      //split query into array that gives the x and y coordinates  values
	      
	    if($xandy){        //if there is an x and why then we make a move that checks if it is valid
	     
	        makeMove($pid, array((int)$xandy[0], (int)$xandy[1]));     
	    }
		else{
			echo json_encode(Response::withReason("Move not specified"));
		}
	} else {
		echo json_encode(Response::withReason("Pid not specified"));
	}
} else {
	// othewise $uri did not contain a query
	echo json_encode(Response::withReason("No pid or move specified"));
}


//make move makes a move of our input, checks if it is valid, a win loose or draw, and we write the data to a text file named saved games
function makeMove($pid, $move){
	
	// restore the last saved game
	$game = Game::restore($pid);
	
	// TODO check is valid move
	$ackMove = $game->doMove(TRUE, $move);
	if($ackMove->isWin || $ackMove->isDraw){
		echo json_encode(Response::withMove($ackMove));
	}
	else {
		if($game->strategy === "random"){
			$move = RandomStrategy::getMove($game->board);
		}
		else{
			$move = SmartStrategy::getMove(FALSE, $game->board, $move);
		}
		$myMove = $game->doMove(FALSE, $move);
		echo json_encode(Response::withMoves($ackMove, $myMove));
	}
	saveGame($pid, $game);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omok Game</title>
    <style>
        .board {
            display: grid;
            grid-template-columns: repeat(15, 30px);
            grid-template-rows: repeat(15, 30px);
            gap: 1px;
            background-color: #eee;
        }

        .cell {
            width: 30px;
            height: 30px;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        .cell:hover {
            background-color: #f0f0f0;
            cursor: pointer;
        }

        .cell.black {
            background-color: #000;
        }

        .cell.white {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <h1>Omok Game</h1>
    <div class="board">
        <?php
        // Draw the board
  
        for ($i = 0; $i < 15; $i++) {
            for ($j = 0; $j < 15; $j++) {
                echo '<div class="cell" data-x="' . $i . '" data-y="' . $j . '"></div>';
            }
        }

        ?>
    </div>
    
</body>
</html>
