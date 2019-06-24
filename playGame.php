
<!DOCTYPE html>
	<head>
			<title>Minesweeper</title>
		
	</head>
	<body onload='timer=setInterval("countUP()", 1000 );'>
		<form action="#" method="post">
			<button type ="submit" name="logout" value="send to database">Logout</button>			
    	</form>
    	<br/>	
    	Time: <div id="timer_container"></div>
		<p>
			<script type="text/javascript">
			function clearTimer()
				 {
				 	counter = 0;
				 	localStorage.setItem("seconds",counter);
				 }
				  
			</script>
			<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
				<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
				<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			<script type="text/javascript">
				var counter = 0;
				var timer;
				if(localStorage.getItem("seconds") != null)
				{
					counter = parseInt(localStorage.getItem("seconds"));
				}
				else
				{
				 	counter = 0;
				}
					
				function countUP () {

					 counter = counter + 1;//increment the counter by 1
					 	//display the new value in the div
					 document.getElementById("timer_container").innerHTML = counter;
					localStorage.setItem("seconds",counter);
					 
				 }
				 function stopCounter()
				 {
				 	$.post('http://cs3750juan.epizy.com/playGame.php',{postcounter:counter},
				 	function(data) {
				 		//$('#result').html(data);	
				 	});
				 	counter = 0;
				 }
				 function clearTimer()
				 {
				 	counter = 0;
				 	localStorage.setItem("seconds",counter);
				 } 
			</script>

		</p>

		<?php
			session_start();
			$user = $_SESSION["user_name"];
			echo "Welcome ".$user;

			if (isset($_POST['logout']))
        	{
        			session_start();

        			echo '<script type="text/javascript">',
     					'clearTimer();',
    					 '</script>';
					$_SESSION["user_name"] = "";
					unset($_SESSION['user_name']);
					clearSweeper();
					header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");		             	
			}
	
			if(isset($_POST['postcounter']))
			{
				$time = $_POST['postcounter'];
				$user = $_SESSION["user_name"];
				
				$servername = "sql304.epizy.com";
				$username = "epiz_23868833";
				$password = "oZwNrrIhSLY3r";
				$dbname =  "epiz_23868833_game";

				$conn = new mysqli($servername, $username,$password,$dbname);

				if($conn->connect_error)
				{
					die("Connection failed:". $conn->connect_error);
				}
				$sql = "SELECT * FROM  GameMines WHERE User = '" . $user . "'";
				$result = $conn->query($sql);
				if($result->num_rows > 0)
				{
					$row = $result->fetch_assoc();
					$idUser = $row['ID'];
					$query = "INSERT INTO Scores (IDName, Score) VALUES ('" . $idUser . "', '" . $time . "')"; 
					mysqli_query($conn,$query);
					echo $idUser." ".$time;
					session_start();
					$_SESSION["user_name"] = $user;
				}

			}
		?>
	
		<?php
		define('MINEGRID_WIDTH',  9);
		define('MINEGRID_HEIGHT', 9);

		define('MINESWEEPER_NOT_EXPLORED', -1);
		define('MINESWEEPER_MINE',         -2);
		define('MINESWEEPER_FLAGGED',      -3);
		define('MINESWEEPER_FLAGGED_MINE', -4);
		define('ACTIVATED_MINE',           -5);

		function check_field($field) {
		    if ($field === MINESWEEPER_MINE || $field === MINESWEEPER_FLAGGED_MINE) {
		        return true;
		    }
		    else {
		        return false;
		    }
		}

		function explore_field($field) {
		    if (!isset($_SESSION['minesweeper'][$field])
		     || !in_array($_SESSION['minesweeper'][$field],
		                  array(MINESWEEPER_NOT_EXPLORED, MINESWEEPER_FLAGGED))) {
		        return;
		    }

		    $mines = 0;

		    // Make reference to that long name
		    $fields  = &$_SESSION['minesweeper'];


		    // left side options
		    if ($field % MINEGRID_WIDTH !== 1) {
		        $mines += check_field(@$fields[$field - MINEGRID_WIDTH - 1]);
		        $mines += check_field(@$fields[$field - 1]);
		        $mines += check_field(@$fields[$field + MINEGRID_WIDTH - 1]);
		    }

		    // bottom and top
		    $mines += check_field(@$fields[$field - MINEGRID_WIDTH]);
		    $mines += check_field(@$fields[$field + MINEGRID_WIDTH]);

		    // right side options
		    if ($field % MINEGRID_WIDTH !== 0) {
		        $mines += check_field(@$fields[$field - MINEGRID_WIDTH + 1]);
		        $mines += check_field(@$fields[$field + 1]);
		        $mines += check_field(@$fields[$field + MINEGRID_WIDTH + 1]);
		    }

		    $fields[$field] = $mines;

		    if ($mines === 0) {
		        if ($field % MINEGRID_WIDTH !== 1) {
		            explore_field($field - MINEGRID_WIDTH - 1);
		            explore_field($field - 1);
		            explore_field($field + MINEGRID_WIDTH - 1);
		        }

		        explore_field($field - MINEGRID_WIDTH);
		        explore_field($field + MINEGRID_WIDTH);

		        if ($field % MINEGRID_WIDTH !== 0) {
		            explore_field($field - MINEGRID_WIDTH + 1);
		            explore_field($field + 1);
		            explore_field($field + MINEGRID_WIDTH + 1);
		        }
		    }
		}

		session_start(); // will start session storage

		if (!isset($_SESSION['minesweeper'])) {
		    // Fill grid with not explored tiles
		    $_SESSION['minesweeper'] = array_fill(1,
		                                         MINEGRID_WIDTH * MINEGRID_HEIGHT,
		                                         MINESWEEPER_NOT_EXPLORED);

		    $number_of_mines = 10;

		    // generate mines randomly
		    $random_keys = array_rand($_SESSION['minesweeper'], $number_of_mines);

		    foreach ($random_keys as $key) {
		        $_SESSION['minesweeper'][$key] = MINESWEEPER_MINE;
		    }

		    // to make calculations shorter use SESSION variable to store the result
		    $_SESSION['numberofmines'] = $number_of_mines;
		}

		if (isset($_GET['explore'])) {
		    if(isset($_SESSION['minesweeper'][$_GET['explore']])) {
		        switch ($_SESSION['minesweeper'][$_GET['explore']]) {
		            case MINESWEEPER_NOT_EXPLORED:
		                explore_field($_GET['explore']);
		                break;
		            case MINESWEEPER_MINE:
		                $lost = 1;
		                $_SESSION['minesweeper'][$_GET['explore']] = ACTIVATED_MINE;
		                break;
		            default:
		                // The tile was discovered already. Ignore it.
		                break;
		        }
		    }
		    else {
		        die('Tile doesn\'t exist.');
		    }
		}
		elseif (isset($_GET['flag'])) {
		    if(isset($_SESSION['minesweeper'][$_GET['flag']])) {
		        $tile = &$_SESSION['minesweeper'][$_GET['flag']];
		        switch ($tile) {
		            case MINESWEEPER_NOT_EXPLORED:
		                $tile = MINESWEEPER_FLAGGED;
		                break;
		            case MINESWEEPER_MINE:
		                $tile = MINESWEEPER_FLAGGED_MINE;
		                break;
		            case MINESWEEPER_FLAGGED:
		                $tile = MINESWEEPER_NOT_EXPLORED;
		                break;
		            case MINESWEEPER_FLAGGED_MINE:
		                $tile = MINESWEEPER_MINE;
		                break;
		            default:
		                // This tile shouldn't be flagged. Ignore it.
		                break;
		        }
		    }
		    else {
		        die('Tile doesn\'t exist.');
		    }
		}

		// Check if the player won...
		if (!in_array(MINESWEEPER_NOT_EXPLORED, $_SESSION['minesweeper'])
		 && !in_array(MINESWEEPER_FLAGGED,      $_SESSION['minesweeper'])) {
		    $won = true;
		}
		?>
		<style>
		table {
		    border-collapse: collapse;
		}

		td, a {
		    text-align:      center;
		    width:           1em;
		    height:          1em;
		}

		a {
		    display:         block;
		    color:           black;
		    text-decoration: none;
		    font-size:       2em;
		}
		</style>
		<script>
		function flag(number, e) {
		    if (e.which === 2 || e.which === 3) {
		        location = '?flag=' + number;
		        return false;
		    }
		}
		</script>
		<table border="1">
		<?php
		$mine_copy = $_SESSION['minesweeper'];

		for ($x = 1; $x <= MINEGRID_HEIGHT; $x++) {
		    echo '<tr>';
		    for ($y = 1; $y <= MINEGRID_WIDTH; $y++) {
		        echo '<td>';

		        $number = array_shift($mine_copy);
		        switch ($number) {
		            case MINESWEEPER_FLAGGED:
		            case MINESWEEPER_FLAGGED_MINE:
		                if (!empty($lost) || !empty($won)) {
		                    if ($number === MINESWEEPER_FLAGGED_MINE) {
		                        echo '<a>*</a>';
		                    }
		                    else {
		                        echo '<a>.</a>';
		                    }
		                }
		                else {
		                    echo '<a href=# onmousedown="return flag(',
		                         ($x - 1) * MINEGRID_WIDTH + $y,
		                         ',event)" oncontextmenu="return false">?</a>';
		                }
		                break;
		            case ACTIVATED_MINE:
		                echo '<a>:(</a>';
		                break;
		            case MINESWEEPER_MINE:
		            case MINESWEEPER_NOT_EXPLORED:
		                if (!empty($lost)) {
		                    if ($number === MINESWEEPER_MINE) {
		                        echo '<a>*</a>';
		                    }
		                    else {
		                        echo '<a>.</a>';
		                    }
		                }
		                elseif (!empty($won)) {
		                    echo '<a>*</a>';
		                }
		                else {
		                    echo '<a href="?explore=',
		                         ($x - 1) * MINEGRID_WIDTH + $y,
		                         '" onmousedown="return flag(',
		                         ($x - 1) * MINEGRID_WIDTH + $y,
		                         ',event)" oncontextmenu="return false">.</a>';
		                }
		                break;
		            case 0:
		                echo '<a></a>';
		                break;
		            default:
		                echo '<a>', $number, '</a>';
		                break;
		        }
		    }
		}
		?>
		</table>
		<?php
		if (!empty($lost)) {
		    unset($_SESSION['minesweeper']);
		    echo '<p>You lost1 :(. <a href="?">Reboot?</a>';
		    echo '<script type="text/javascript">',
     					'stopCounter();',
    					 '</script>';
    		header("Refresh: 1; url = http://cs3750juan.epizy.com/playGame.php");	
		}
		elseif (!empty($won)) {
		    unset($_SESSION['minesweeper']);
		    echo '<p>Congratulations. You won :).';
		}

		function clearSweeper()
		{
			unset($_SESSION['minesweeper']);
		}

		?>
		
		</body>
</html>