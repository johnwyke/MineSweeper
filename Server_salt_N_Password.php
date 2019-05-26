
<html>
	<body>
		<?php
		
		
		// varialbes for DB 
		$dbUsername = "epiz_23949586";
		$dbPassword = "wLe9nillhzK";
		$dbServer = "sql312.epizy.com";
		//$dbName = "epiz_23949586_Minesweeper";
		$conn-> new mysqli($dbServer, $dbUsername, $dbPassword);
		
		// Check connection status 
		/*if($conn->connect_error){
			die("Connection Failed: " . $conn->connect_error);
		}*/
		echo "I have connected";
		
		// This is to accept text and hash it multiple with sha 256 
		
		// Variables for User and hashing
		$textFromClient = "Testing"; //$_GET['password'];
		$SALT = "M!nesweeper" . rand(100000,10000000);
		$wholePass = $SALT . $textFromClient;
		
			
			// Hashing the text 11 times with the default SALT. Need to look more into using own SALT
			for($cnt =0; $cnt <=10; $cnt++){
				echo "Pass befor hash it  done: " . $wholePass . "<br>";
				
				$hash = password_hash($textFromClient,PASSWORD_BCRYPT);				
				if(!$hash){
					echo " The hash has failed and returned a false.";
				}
				//echo $hash; 
				$wholePass = $hash; 
				
				echo "Password after hash is done: " . $wholePass . "<br>";			
			}
			
			$conn->close();
		?>
	</body>
</html>