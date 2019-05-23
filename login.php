<html>
	<head>
		
	</head>
	<body>
		<script>
			function hashPassword(str){
				var pass = document.getElementById("passwordUser").value;
				var hashed = sha256(pass);
				document.getElementById("answer").innerHTML = hashed;
				
			}
		</script>
		
			Name: <input type="text" name="username" placeholder="enter name"> <br><br>
			Passwor: <input type="password" id="passwordUser" name="password" placeholder="password" onkeyup="hashPassword(this)"><br><br>
			<button type ="submit" name="login" value="send to database" onclick="hashPassword(this)"> Log in</button>
			<p id="answer"></p>
</body>
</html>