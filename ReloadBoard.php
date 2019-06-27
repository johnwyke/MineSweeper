<?php
	session_start();
	//echo "I am in Reload Board";
	
	if(isset($_SESSION['board'])){
		$fullBoard = json_decode($_SESSION['board'],true);
		
		//echo "Reload Session is set";
		echo json_encode($fullBoard);
		
	}

?>