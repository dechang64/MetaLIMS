<?php include('../index.php'); ?>
<?php include('../database_connection.php'); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DNA Extraction Kit Update</title>
</head>
<body>

<div class="page-header">
<h3>Update DNA Extraction Kit Dropdown</h3>	
</div>
	<?php 
		//error && type checking 
		if(isset($_GET['submit'])){
			echo '<div class="border">';
			//print_r($_GET);
			$error = 'false';
			$submitted = 'false';
			
			//sanatize user input to make safe for browser
			$p_dExtr = htmlspecialchars($_GET['dExtr']);
			
			if($p_dExtr == ''){
					echo '<p>You must enter a DNA Extraction Kit Name!<p>';
					$error = 'true';
			}

			
			//check if dna extraction kit name exists
			$stmt1 = $dbc->prepare("SELECT d_kit_name FROM dna_extraction WHERE d_kit_name = ?");
			$stmt1 -> bind_param('s', $p_dExtr);
				
  			if ($stmt1->execute()){
    			$stmt1->bind_result($name);
    			if ($stmt1->fetch()){
        			echo "Name: {$name}<br>";
        			if($name == $p_dExtr){
        				echo $p_dExtr." Exists. Please Check Name.";
						$error = 'true';
					}
				}
			} 
			else {
				$error = 'true';
    			die('execute() failed: ' . htmlspecialchars($stmt1->error));
				
			}
			$stmt1 -> close();
	
			//insert info into db
		    if($error != 'true'){
		    	
				$stmt2 = $dbc -> prepare("INSERT INTO dna_extraction (d_kit_name) VALUES (?)");
				$stmt2 -> bind_param('s', $p_dExtr);
				
				$stmt2 -> execute();
				$rows_affected2 = $stmt2 ->affected_rows;
				$stmt2 -> close();
				
				//check if add was successful or not. Tell the user
		   		if($rows_affected2 > 0){
					echo 'You added new DNA Extraction Info: '.$p_dExtr;
					$submitted = 'true';
				}else{
					
					echo 'An error has occurred';
					mysqli_error($dbc);	
				}
			}
			echo '</div>';
		}
	?>

	<form class="registration" action="update_dna_extr.php" method="GET">
	* = required field <!--arbitrary requirement at this moment-->
		
		<fieldset>
		<LEGEND><b>DNA Extraction Info:</b></LEGEND>
		<div class="col-xs-6">
		<!--DNA Extraction Kit Name-->
		<p>
		<label class="textbox-label">DNA Extraction Kit Name:*</label>
		<input type="text" name="dExtr" placeholder="Enter A DNA Extraction Kit Name" value="<?php if(isset($_GET['submit']) && $submitted != 'true'){ echo $p_dExtr;} ?>"<br>
		</p>
		</div>
		<!--submit button-->
		<button class="button" type="submit" name="submit" value="1"> Add </button>
		<input action="action" class="button" type="button" value="Go Back" onclick="history.go(-1);" />
		</fieldset>
		
	</form>
	
	

	
</body>
	
</html>
