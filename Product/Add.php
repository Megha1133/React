<html>
<body>
<center>
<h1>Add Products</h1>
<?php
$pr_name=false;
$pr_discription=false;
$pr_category=false;
$pr_sub_category=false;
$pr_price=false;
if(isset($_POST['pr_name'])){
	$pr_name=$_POST['pr_name'];
	if(empty($pr_name)){
		echo 'Enter Product Name ';
	}
}
if(isset($_POST['pr_discription'])){
	$pr_discription=$_POST['pr_discription'];
	if(empty($pr_discription)){
		echo 'Enter Product discription ';
	}
}
if(isset($_POST['pr_category'])){
	$pr_category=$_POST['pr_category'];
	if(empty($pr_category)){
		echo 'Enter product category ';
	}
}
if(isset($_POST['pr_sub_category'])){
	$pr_sub_category=$_POST['pr_sub_category'];
	if(empty($pr_sub_category)){
		echo 'Enter product  sub category ';
	}
}
if(isset($_POST['pr_price'])){
	$pr_price=$_POST['pr_price'];
	if(empty($pr_price)){
		echo 'Enter product price ';
	}
}
require_once('db.php');
if(!empty($pr_name) && !empty($pr_discription) && !empty($pr_category) && !empty($pr_sub_category) && !empty($pr_price) ){
	$sql='insert into product(pr_name,pr_discription,pr_category,pr_sub_category,pr_price) value (?,?,?,?,?)';
	$stm=mysqli_prepare($conn,$sql);
	 mysqli_stmt_bind_param($stm,"sssss",$pr_name,$pr_discription,$pr_category,$pr_sub_category,$pr_price);
	 if(mysqli_stmt_execute($stm)){
		 header("Location: http://localhost/index.php");
		 exit();
	 }else{
		echo 'failed';
	 }

}


?>
<form action="Add.php" method="post">
Product Name: <input type="" name="pr_name"><br>
Product Discription: <input type="" name="pr_discription"><br>
Product Category : <input type="" name="pr_category"><br>
Product Sub_Category : <input type="" name="pr_sub_category"><br>
Product Price(Rs) : <input type="" name="pr_price"><br>
<input type="submit">Save
</form>
</center>
</body>
</html>
