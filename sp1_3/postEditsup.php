<!DOCTYPE html>
<html>
<head>
	<title>OnlineShooping</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<?php 
session_start(); 

//$productId = $_GET['id'];


if (!isset($_SESSION['userId']) && !isset($_SESSION['admin'])) { 
	    header("Location: login.php");
	}?>
<body>
	<div class="signup">
		<?php require 'template/header1.php'; ?>
		<?php require 'template/menu.php'; ?>
<div class="maincontent">
			<div class="content">
				<div>
					<?php 
						if(isset($_SESSION['a_p_message'])) {
							echo $_SESSION['a_p_message'];
							unset($_SESSION['a_p_message']);
						}
					 ?>
				</div>

<?php
$mysqli = new mysqli("localhost", "root","","sp1");
if ($mysqli->connect_errno) {
       die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

	$name  =  $_POST['name'];
$contact=$_POST["name1"];
if($name==""||$contact==""){
echo "you can't any field empty"."</br>";	
	
	
}
else{
		$sql = "SELECT * FROM supplier";
$supid=$_SESSION["editsup"];

$supplierValue=strtolower($name);
	// insert category
	
	$result = mysqli_query($mysqli,$sql)or die(mysqli_error());
		 if (mysqli_num_rows($result) > 0) {
    // output data of each row
 while($row = mysqli_fetch_assoc($result)) {
        //echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["cgpa"]. "<br>";
		if((strtolower($row["name"])==$supplierValue)&&($row["id"]!=$supid)){
break;
		}
    }
 }
	if((strtolower($row["name"])==$supplierValue)&&($row["id"]!=$supid)){?>
	<div class="content">
	<h1 style="color:red;"><?php	echo "supplier already exist!"."</br>";?> </h1>
		</div>
	<?php
	}
	else{
	
		$sq2 = "UPDATE supplier SET name   ='".strtoupper($supplierValue)."'
								WHERE id   =$supid";

	

	if ($mysqli->query($sq2) == true ) {
	    echo "update supplier successfully"."</br>";
	} else {
		print 'Error : ('. $mysqli->errno .') '. $mysqli->error;die();
	} 
	}
	
$mysqli->close();

}

?>


</div>
</div>	
		<div class="footer">
			<p>&copy; AIUB 2016</p>
		</div>
	</div>

</body>
</html>