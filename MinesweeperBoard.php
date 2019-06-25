<html> 
	<head> 
		<style>
			td{
				text-align:      center;
				width:           3em;
				height:          3em;				
			}
		</style>
	</head>
	
	<body id="body"> 
		<?php
			if(isset($_POST['postcounter']))
			{
				echo "I am here";
				header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
			}
			if(isset($_POST['testCallingFunction']))
			{
				echo "I am here";
				header("Refresh: 1; url = http://cs3750juan.epizy.com/login.php");
			}
	
			//$list = json_decode($_SESSION['board'],true);
			/*var_dump($list);
			$x = $list['0-0'];
			echo " THis is before the specific Value <br>";
			var_dump($x);
			$x['beenChecked'] = 1;
			echo $x["beenChecked"];
			echo json_decode($_SESSION['board']);*/
			//session_destroy();
		?>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script>
		
			function myFunction(obj)
			{
				$.ajax({
				        url: "http://3750grp5minesweeper.epizy.com/LearningJson.php",
				        method: "GET",
				        async: false,
				        data: { cellobjid : obj.id },
				        dataType: "text",
				        success: function(data) {
							obj.innerHTML = data;
					    }
				});
				
			}
			function loadBoard(){
				$.ajax({
					url: "http://3750grp5minesweeper.epizy.com/ReloadBoard.php",
					method:"GET",
					async: false,					
					dataType: "text",
					success:function(Result){
						// Need to loop through array and refill data.
						//alert("I am in success");
						var str = Result;
						//alert(Result);
						var arrs = JSON.parse(str);
						//alert(arrs);
						$.each(arrs, function(key,value){
							if (value['beenChecked'] == "1"){
								//alert("I have a cell that has beenchecked");
							document.getElementById(key).innerHTML = value['value'];
							}else{}//alert("beenChecked did not fire");}
							//alert("My Cell is " + key +" and my value is "+ value['value']);
						});						
					}
				});
			}// End Function
			
			document.getElementById("body").onload = function() {loadBoard();};
		</script>
		<table id = "GameBoard" border="1" style = "border-collapse: collapse">
			<tr>
				<td id = "0-0" onclick = "myFunction(this)">.</td>
				<td id = "0-1" onclick = "myFunction(this)">.</td>
				<td id = "0-2" onclick = "myFunction(this)">.</td>
				<td id = "0-3" onclick = "myFunction(this)">.</td>
				<td id = "0-4" onclick = "myFunction(this)">.</td>
				<td id = "0-5" onclick = "myFunction(this)">.</td>
				<td id = "0-6" onclick = "myFunction(this)">.</td>
				<td id = "0-7" onclick = "myFunction(this)">.</td>
				<td id = "0-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = '1-0' onclick = "myFunction(this)">.</td>
				<td id = "1-1" onclick = "myFunction(this)">.</td>
				<td id = "1-2" onclick = "myFunction(this)">.</td>
				<td id = "1-3" onclick = "myFunction(this)">.</td>
				<td id = "1-4" onclick = "myFunction(this)">.</td>
				<td id = "1-5" onclick = "myFunction(this)">.</td>
				<td id = "1-6" onclick = "myFunction(this)">.</td>
				<td id = "1-7" onclick = "myFunction(this)">.</td>
				<td id = "1-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "2-0" onclick = "myFunction(this)">.</td>
				<td id = "2-1" onclick = "myFunction(this)">.</td>
				<td id = "2-2" onclick = "myFunction(this)">.</td>
				<td id = "2-3" onclick = "myFunction(this)">.</td>
				<td id = "2-4" onclick = "myFunction(this)">.</td>
				<td id = "2-5" onclick = "myFunction(this)">.</td>
				<td id = "2-6" onclick = "myFunction(this)">.</td>
				<td id = "2-7" onclick = "myFunction(this)">.</td>
				<td id = "2-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "3-0" onclick = "myFunction(this)">.</td>
				<td id = "3-1" onclick = "myFunction(this)">.</td>
				<td id = "3-2" onclick = "myFunction(this)">.</td>
				<td id = "3-3" onclick = "myFunction(this)">.</td>
				<td id = "3-4" onclick = "myFunction(this)">.</td>
				<td id = "3-5" onclick = "myFunction(this)">.</td>
				<td id = "3-6" onclick = "myFunction(this)">.</td>
				<td id = "3-7" onclick = "myFunction(this)">.</td>
				<td id = "3-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "4-0" onclick = "myFunction(this)">.</td>
				<td id = "4-1" onclick = "myFunction(this)">.</td>
				<td id = "4-2" onclick = "myFunction(this)">.</td>
				<td id = "4-3" onclick = "myFunction(this)">.</td>
				<td id = "4-4" onclick = "myFunction(this)">.</td>
				<td id = "4-5" onclick = "myFunction(this)">.</td>
				<td id = "4-6" onclick = "myFunction(this)">.</td>
				<td id = "4-7" onclick = "myFunction(this)">.</td>
				<td id = "4-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "5-0" onclick = "myFunction(this)">.</td>
				<td id = "5-1" onclick = "myFunction(this)">.</td>
				<td id = "5-2" onclick = "myFunction(this)">.</td>
				<td id = "5-3" onclick = "myFunction(this)">.</td>
				<td id = "5-4" onclick = "myFunction(this)">.</td>
				<td id = "5-5" onclick = "myFunction(this)">.</td>
				<td id = "5-6" onclick = "myFunction(this)">.</td>
				<td id = "5-7" onclick = "myFunction(this)">.</td>
				<td id = "5-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "6-0" onclick = "myFunction(this)">.</td>
				<td id = "6-1" onclick = "myFunction(this)">.</td>
				<td id = "6-2" onclick = "myFunction(this)">.</td>
				<td id = "6-3" onclick = "myFunction(this)">.</td>
				<td id = "6-4" onclick = "myFunction(this)">.</td>
				<td id = "6-5" onclick = "myFunction(this)">.</td>
				<td id = "6-6" onclick = "myFunction(this)">.</td>
				<td id = "6-7" onclick = "myFunction(this)">.</td>
				<td id = "6-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "7-0" onclick = "myFunction(this)">.</td>
				<td id = "7-1" onclick = "myFunction(this)">.</td>
				<td id = "7-2" onclick = "myFunction(this)">.</td>
				<td id = "7-3" onclick = "myFunction(this)">.</td>
				<td id = "7-4" onclick = "myFunction(this)">.</td>
				<td id = "7-5" onclick = "myFunction(this)">.</td>
				<td id = "7-6" onclick = "myFunction(this)">.</td>
				<td id = "7-7" onclick = "myFunction(this)">.</td>
				<td id = "7-8" onclick = "myFunction(this)">.</td>
			</tr>
			<tr>
				<td id = "8-0" onclick = "myFunction(this)">.</td>
				<td id = "8-1" onclick = "myFunction(this)">.</td>
				<td id = "8-2" onclick = "myFunction(this)">.</td>
				<td id = "8-3" onclick = "myFunction(this)">.</td>
				<td id = "8-4" onclick = "myFunction(this)">.</td>
				<td id = "8-5" onclick = "myFunction(this)">.</td>
				<td id = "8-6" onclick = "myFunction(this)">.</td>
				<td id = "8-7" onclick = "myFunction(this)">.</td>
				<td id = "8-8" onclick = "myFunction(this)">.</td>
			</tr>
			</table>
		<?php session_destroy(); ?>
	</body>
</html>