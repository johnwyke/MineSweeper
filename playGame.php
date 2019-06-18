<html>
	<head>
		
		<title>Minessweeper</title>
		
	</head>
	<body>
		<form action="#" method="post">
			<button type ="submit" name="logout" value="send to database">Logout</button>			
    	</form>
    	<input type ="button" name="stop" value="Stop Me" onclick="stopCounter();" />	
		<p>
			<script type="text/javascript">
			function clearTimer()
				 {
				 	counter = 0;
				 	localStorage.setItem("seconds",counter);
				 }
				  
			</script>
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
        			/*echo "<script> window.onload = function() {
     						stopCounter();
 						}; </script>";*/
					$_SESSION["user_name"] = "";
					unset($_SESSION['user_name']);
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
		</p>
		<?php
			session_start();
			class cell{
				private $mine; 
				private $value; 
				
				// Constructor
				public function __construct(){
					$mine = false;
					$value = 0;
				}
				// function to return mine or not
				public function get_mine(){
						if ($this->mine == true){
							return true; 
						}
						return false;
					
				}
				public function set_mine($bool){
				$this->mine = $bool;
				}
				
				public function inc_value(){
					$this->value++;
				}
				public function get_value(){return $this->value;}
			}
			
			
			//*******************
			// Start of Game Logic 
			//*******************
			
			// Vars 
			$numbOfMines = 15;
			$colCount = 15;
			$rowCount = 15;
			
			// Init game board
			for($r =0;  $r <$rowCount; $r++){
				for($c=0; $c<$colCount; $c++){
					$gameBoard[$r][$c] = new cell();
						
				}// End of Inner for 			
			}// End of outer for 
			
			// Fill the Game Board with Mines 
				$mc =0;		
			while($mc < $numbOfMines){
				
				$xCord = rand(0,$colCount-2);
				$yCord = rand(0,$rowCount-2);
				
				//TODO:
				// Need to see if mine is already present
				// If it is start loop again 
				
				
				if($gameBoard[$yCord][$xCord]->get_mine()){
					// Mine is already set try agian.
					$mc--;
					continue;
				}			
				
				$gameBoard[$yCord][$xCord]->set_mine(true); 
				
				$mc++;
			}// End of outer for 
			
			
			// TODO: Check neighbors for mines Then Set value
			
			for($r=0; $r<$rowCount-1; $r++){
				for($c=0; $c<$colCount-1; $c++){
					
					// If I am a mine Move to next
					if($gameBoard[$r][$c]->get_mine()){
						continue;
					}
					
					if($r==0){
						// Skip checking Top
							if($c ==0){
								// First in Col Only Check right
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif ($c == $colCount-1){
								//Last in Col only check left
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif($c!=0 && $c != $colCount-1){
								
								// Check Both
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}
							
							
						}elseif ($r == $rowCount-1){
							// Skipcheck bottom
							if($c ==0){
								// First in Col Only Check right
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif ($c == $colCount-1){
								//Last in Col only check left
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif($c!=0 && $c != $colCount-1){
								
								// Check Both
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}
						}else{
							//Check all three
							if($c ==0){
								// First Col 
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif ($c == $colCount-1){
								//Last in Col only check left
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
							}elseif($c!=0 && $c != $colCount-1){
								
								// Check Both
								if ($gameBoard[$r][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r-1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c+1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								if ($gameBoard[$r+1][$c-1]->get_mine()){
									$gameBoard[$r][$c]->inc_value();
								}
								
							}
						}									
				}// End Inner 
			}// End Outer >
		?>
		<!DOCTYPE html>
			<title>Minesweeper</title>
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
			<table border="1">
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
			<body onload='timer=setInterval("countUP()", 1000 );'>
			Time: <div id="timer_container"></div>
			<br>
		<?php
			// this is a test
			for($r =0;  $r <$rowCount-1; $r++){
				echo '<tr>';
				for($c=0; $c<$colCount-1; $c++){
					echo '<td>';
					echo '<a href>.</a>';
					/*if ($gameBoard[$r][$c]->get_mine()){
						echo "*"; 
					}elseif($gameBoard[$r][$c]->get_value()!=0) {
						echo $gameBoard[$r][$c]->get_value();
					}*/
				}// End of Inner for 			
			}// End of outer for 
		?>
		</table>

	</body>
</html>