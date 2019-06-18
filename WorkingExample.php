<div id='right'>HELLOO THERE!!
    <br/>
    <br/>    
    <br/>
    <br/>
    
    THIS IS A TEST!</div>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
			<script>
				$('#right').mousedown(function(event) {
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