<html> 
	<head> 
	</head>
	
	<body> 
		<?php
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
			}
			
			
			//*******************
			// Start of Game Logic 
			//*******************
			
			// Vars 
			$numbOfMines =10;
			$colCount = 15;
			$rowCount = 15;
			
			// Init game board
			for($r =0;  $r <$rowCount-1; $r++){
				for($c=0; $c<$colCount-1; $c++){
					$gameBoard[$r][$c] = new cell();
				}// End of Inner for 			
			}// End of outer for 
			
			// Fill the Game Board with Mines 
						
			for($r =0;  $r < $numbOfMines; $r++){
				
				$xCord = rand(0,$colCount-1);
				$yCord = rand(0,$rowCount-1);
				
				//TODO:
				// Need to see if mine is already present
				// If it is start loop again 
				$gameBoard[$yCord][$xCord] = new cell();
				
				echo "Placing mine ";
				$gameBoard[$yCord][$xCord]->set_mine(true); 
				
				echo "I am at position Row: " . $yCord ." Col: ".$xCord . "<br>";
				
			}// End of outer for 
			
			
			// TODO: Check neighbors for mines Then Set value
			
			// Check same row
			for($r=0; $r<$rowCount-1; $r++){
				for($c=0; $c<$colCount-1; $c++){
					if($r==0){
						// Skip checking Top
						if($c ==0){
							// First in Row Only Check right
						}
						else if	($c == $colCount-1){
							//Last in row only check left
							
						}else {
							// Check Both
						}
					}else if ($r == $rowCount-1){
						// Skipcheck bottom
						if($c ==0){
							// First in Row Only Check right
						}
						else if	($c == $colCount-1){
							//Last in row only check left
							
						}else {
							// Check Both
						}
					}else{
						//Check all three
						if($c ==0){
							// First in Row Only Check right
						}
						else if	($c == $colCount-1){
							//Last in row only check left
							
						}else {
							// Check Both
						}
					}
				}// End Inner 
			}// End Outer 
			
			// this is a test
			for($r =0;  $r <$rowCount-1; $r++){
				for($c=0; $c<$colCount-1; $c++){
					
					//var_dump($gameBoard[$r][$c]->get_mine());
					if ($gameBoard[$r][$c]->get_mine()){
						echo " I have a mine at cell Row: " .$r . " Col: ". $c . "<br>"; 
					}
				
					//echo " cell Row: " .$r . " Col: ". $c . "<br>";
				}// End of Inner for 			
			}// End of outer for 			
		?>
	</body>
</html>