<?php
	include("connect.php");
	$id = $_GET['Id'];
	$q = "delete from grocerytb where Id = $id ";
	mysqli_query($con,$q);
?>
