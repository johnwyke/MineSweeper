<html>
	<head>
		<style>
				td, a {
					text-align:      center;
					width:           3em;
					height:          3em;
					
				}

				a {
					display:         block;
					color:           black;
					text-decoration: none;
					font-size:       2em;
				}
			</style> 
			<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		</head>
			<script>
				$("#right").mousedown(function(event) {
					switch (event.which) {
						case 1:
							right.innerHTML = "*";
							break;
						case 2:
							alert('Middle Mouse button pressed.');
							break;
						case 3:
							right.innerHTML = "F";
							break;
						default:
							alert('You have a strange Mouse!');
					}
				});
		</script>
		<body>
			<table id = "GameBoard" border="1" style = "border-collapse: collapse">
			<tr>
				<div id = "right"><td>.</td></div>
				<td id = "01" onclick = "myFunction(this)">.</td>
				<td id = "02" onclick = "myFunction(this)">.</td>
				<td id = "03" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "10" onclick = "myFunction(this)">.</td>
				<td id = "11" onclick = "myFunction(this)">.</td>
				<td id = "12" onclick = "myFunction(this)">.</td>
				<td id = "13" onclick = "myFunction(this)">.</td>
			<tr>
				<td id = "20" onclick = "myFunction(this)">.</td>
				<td id = "21" onclick = "myFunction(this)">.</td>
				<td id = "22" onclick = "myFunction(this)">.</td>
				<td id = "23" onclick = "myFunction(this)">.</td>
			</tr>
			</table>
			<div id="result"> </div>
	</body>
</html>