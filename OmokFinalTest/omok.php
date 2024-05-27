
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