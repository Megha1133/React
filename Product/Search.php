<html>
<body>
<center>
<?php
$search=$_GET['Search'];
?>
<h1>Product list application</h1>
<a href="Add.php">Add Product</a><br>
<form action="">
<input type="text" name="Search" value="<?php echo $search; ?>">
<input type="submit" value="Search">
</form>
 <h3>Search Product Data <?php echo $search; ?> </h3>
<table border='1' width="300px">
<tr>
<td>#</td>
<td>pr_name</td>
<td>pr_discription</td>
<td>pr_category</td>
<td>pr_sub_category</td>
<td>pr_price</td>
<td>Edit</td>
<td>Delete</td>
</tr>
<?php
$search='%'.$search.'%';
require_once('db.php');
$sql='select * from product where pr_name like "'.$search.'" or pr_discription like "'.$search.'" pr_category like "'.$search.'" pr_sub_category like "'.$search.'" pr_price like "'.$search.'"order by pr_id';
$stm=mysqli_prepare($conn,$sql);
$a=1;
if(mysqli_stmt_execute($stm)){
	$result=mysqli_stmt_get_result($stm);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		echo '<tr>';
		echo '<td>'.$a++.'</td>';
		echo '<td>'.$row['pr_name'].'</td>';
		echo '<td>'.$row['pr_discription'].'</td>';
		echo '<td>'.$row['pr_category'].'</td>';
    echo '<td>'.$row['pr_sub_category'].'</td>';
    echo '<td>'.$row['pr_price like'].'</td>';
		echo '<td><a href="Edit.php?sl_no='.$row['pr_id'].'">Edit</a></td>';
		echo '<td><a href="Delete.php?sl_no='.$row['pr_id'].'">Delete</a></td>';
		echo '</tr>';
		}
	}
}
?>
</table>
</center>
</body>
</html>
