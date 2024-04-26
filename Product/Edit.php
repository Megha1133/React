<html>
<body>
<center>
<h1>Edit Prodct Details</h1>
<?php
$pr_id=false;
if(isset($_GET['pr_id'])){
	$pr_id=$_GET['pr_id'];
}
require_once('db.php');
if(!empty($pr_id)){
	$sql='select * from product where pr_id=?';
	 $stm=mysqli_prepare($conn,$sql);
	 mysqli_stmt_bind_param($stm,"s",$pr_id);
	 if(mysqli_stmt_execute($stm)){
		 $result=mysqli_stmt_get_result($stm);
		 	if(mysqli_num_rows($result)>0){
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	?>
			<form action="Update.php" method="post">
				<input type="hidden" name="pr_id" value="<?php echo $pr_id; ?>">
		Product	Name : <input type="text" value="<?php echo $row['pr_name']; ?>" name="pr_name"><br>
			Product Discription: <input type="text" value="<?php echo $row['pr_discription']; ?>" name="pr_discription"><br>
			Product category : <input type="text" value="<?php echo $row['pr_category']; ?>" name="pr_category"><br>
      Product Sub_category : <input type="text" value="<?php echo $row['pr_sub_category']; ?>" name="pr_sub_category"><br>
      Product Price : <input type="text" value="<?php echo $row['pr_price']; ?>" name="pr_price"><br>
			<input type="submit">Save
			</form>
	<?php
	}
	 }else{
		echo 'failed';
	 }
}
?>
</center>
</body>
</html>
