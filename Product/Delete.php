<?php
$pr_id=false;
if(isset($_GET['pr_id'])){
	$pr_id=$_GET['pr_id'];
}
require_once('db.php');
if(!empty($pr_id)){
	$sql='delete from product where pr_id=?';
	 $stm=mysqli_prepare($conn,$sql);
	 mysqli_stmt_bind_param($stm,"s",$pr_id);
		if(mysqli_stmt_execute($stm)){
		 header("Location: http://localhost/index.php");
		 exit();
		}else{
				echo 'failed';
		}
	 }else{
		echo 'failed';
	 }
?>
