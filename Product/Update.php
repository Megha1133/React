<?php
$pr_id=false;
$pr_name=false;
$pr_discription=false;
$pr_category=false;
$pr_sub_category=false;
$pr_price=false;
if(isset($_POST['pr_id'])){
	$pr_id=$_POST['pr_id'];
}
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
		echo 'Enter Product category ';
	}
}
if(isset($_POST['pr_sub_category'])){
	$pr_sub_category=$_POST['pr_sub_category'];
	if(empty($pr_sub_category)){
		echo 'Enter Product Sub category ';
	}
}
if(isset($_POST['pr_price'])){
	$pr_price=$_POST['pr_price'];
	if(empty($pr_price)){
		echo 'Enter Product Price ';
	}

require_once('db.php');
if(!empty($pr_id) &&  !empty($pr_name) && !empty($pr_discription) && !empty($pr_category)&& !empty($pr_sub_category) && !empty($pr_price)){
	$sql='update product set pr_name=?,pr_discription=?,pr_category=?,pr_sub_category=?,pr_price=? where pr_id=?';
	 echo $sql;
	 $stm=mysqli_prepare($conn,$sql);
	 mysqli_stmt_bind_param($stm,"ssssss",$pr_name,$pr_discription,$pr_category,$pr_sub_category,$pr_price,$pr_id);
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
