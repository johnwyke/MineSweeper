<html>
	<head>
		
		<title>Minessweeper</title>
		
	</head>
	<body>
		<form action="#" method="post">
			<button type ="submit" name="logout" value="send to database">Logout</button>			
    	</form>


		<p>
<?php
			session_start();
			$user = $_SESSION["user_name"];
			echo "Welcome ".$user;


			
			if (isset($_POST['logout']))
        	{
        			session_start();
					$_SESSION["user_name"] = "";
					unset($_SESSION['user_name']);
					header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
					             	
			}
			

?>
</p>
	</body>
</html>