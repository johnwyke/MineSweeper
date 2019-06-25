<?php			class cell{
				private $mine; 
				private $value; 
				private $beenChecked;
				// Constructor
				public function __construct(){
					$mine = 0;
					$value = 0;
					$beenChecked = 0;
				}
				// Getters and Setter for mine status
				public function get_mine(){
						if ($this->value == -1){
							return true; 
						}
						return false;
					
				}
				public function set_mine($bool){
				$this->value = -1;
				}
				
				// INcrement the number value if not a mine
				public function inc_value(){
					$this->value++;
				}
				public function get_value(){return $this->value;}
				
				// Getters and Setter for been Checked
				public function set_beenChecked($numb){
					$this->beenChecked = $numb; 
				}
				public function get_beenChecked(){
					return $this->beenChecked;
				}
			}
			
			// Initialize the game Board 
			//function init_Game(){
			
			header("Content-type: application/json");
			//*******************
			// Start of Game Logic 
			//*******************
			
			// Vars 
			$numbOfMines = 10;
			$colCount = 9;
			$rowCount = 9;
			
				for($r =0;  $r <$rowCount; $r++){
					for($c=0; $c<$colCount; $c++){
						$gameBoard[$r][$c] = new cell();
					}// End of Inner for 			
				}// End of outer for 
				// Fill the Game Board with Mines 
				$mc =0;		
				while($mc < $numbOfMines){
				
				$xCord = rand(0,$colCount-1);
				$yCord = rand(0,$rowCount-1);
				
				//if mine is already present
				// If it is start loop again 
				
				
				if($gameBoard[$yCord][$xCord]->get_mine()){
					echo "I am at a cell with a mine already";
					// Mine is already set try agian.
					$mc--;
					continue;
				}			
				
				echo "Placing mine ";
				$gameBoard[$yCord][$xCord]->set_mine(true); 
				
				echo "I am at position Row: " . $yCord ." Col: ".$xCord . "<br>";
				$mc++;
			}// End of outer for 
			
			for($r=0; $r<$rowCount; $r++){
				for($c=0; $c<$colCount; $c++){
					
					// If I am a mine Move to next
					/*if($gameBoard[$r][$c]->get_mine()){
						//$arr [$r . "-" .$c] = $gameBoard[$r][$c]->get_value();
						$arr [$r . "-" .$c] = json_encode($gameBoard[$r][$c],JSON_FORCE_OBJECT);
						continue;
					}*/
					if(!$gameBoard[$r][$c]->get_mine()){
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
					}						
				
				// This Creates Dictionary for JSON Conversion. Single Array Format (Row - Col : Value) 
				//$arr [$r . "-" .$c] = $gameBoard[$r][$c]->get_value();
				$arr [$r . "-" .$c] = array("value"=>$gameBoard[$r][$c]->get_value(),"beenChecked"=>$gameBoard[$r][$c]->get_beenChecked());				
				//echo " I have stored an cell object in Associative array";
				}// End Inner 
			}// End Outer 
			//}
			
			
			echo json_encode($arr);
			//$JSONBoard = json_encode($arr,JSON_FORCE_OBJECT);			
			//$_SESSION['board']= $JSONBoard;
			
			
			
			//}
			?>