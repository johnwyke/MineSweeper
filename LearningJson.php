<html>
	<head>
		
		<title>Minessweeper</title>
		
	</head>
	<body>
		<input type ="button" name="stop" value="Stop Me" onclick="stopCounter();" />	
		<p>
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js">
			function stopCounter()
				 {
				 	alert("Hola");
				 	$.ajax({
				        url: "http://cs3750juan.epizy.com/LearningJson.php",
				        method: "GET",
				        async: false,
				        data: {funcion: "funcion1"},
				        dataType: "json",
				        success: function(respuesta) {
				         	location.href = "http://cs3750juan.epizy.com/login.php";
					}
					});
					//src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"
				 }
				  
			</script>
		</p>

		<?php

			function accion1()
			{
				header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
			}


			if(isset($_GET['funcion']) && !empty($_GET['funcion'])) {
		    $funcion = $_GET['funcion'];
		    header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
		    //En función del parámetro que nos llegue ejecutamos una función u otra
		    switch($funcion) {
		        case 'funcion1': 
		        	header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
		            $a -> accion1();
		            break;
		        case 'funcion2': 
		            $b -> accion2();
		            break;
		    }
		 }
	?>
	</body>
</html>