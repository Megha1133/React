<?php
	include("connect.php");

	if (isset($_POST['btn'])) {
		$date=$_POST['Id'];
		$q="select * from grocerytb where Id='$id'";
		$query=mysqli_query($con,$q);
	}
	else {
		$q= "select * from grocerytb";
		$query=mysqli_query($con,$q);
	}
?>

<html>

<head>
	<meta http-equiv="Content-Type"
		content="text/html; charset=UTF-8">

	<title>Product List</title>

	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<link rel="stylesheet"
		href="css/style.css">
</head>

<body>
	<div class="container mt-5">

		<!-- top -->
		<div class="row">
			<div class="col-lg-8">
				<h1>View Product List</h1>
				<a href="add.php">Add Item</a>
				<a href="search.php">Search Item</a>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-8">

						<!-- Date Filtering-->
						<form method="post" action="">
							<input type="id"
								class="form-control"
								name="id">

							<div class="col-lg-4"
								method="post">
								<input type="submit"
								class="btn btn-danger float-right"
								name="btn" value="filter">
							</div>
							<!--search bar-->
							<div class="wrapper">
			            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			                <input type="text" name="txtSearch" value="<?php if(isset($keywords)){ echo $keywords; }?>" title="Input keywords here" required>
			                <button type="submit" name="btnSearch" class="btnSearch" title="Search keywords">Search</button>
			                <a href="index.php" class="btnReset" title="Reset search">Reset</a>
			            </form>
			        </div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Grocery Cards -->
		<div class="row mt-4">
			<?php
				while ($qq=mysqli_fetch_array($query))
				{
			?>

			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">
							<?php echo $qq['Item_name']; ?>
						</h5>
						<h6 class="card-subtitle mb-2 text-muted">
							<?php echo
							$qq['Item_Quantity']; ?>
						</h6>
						<?php
						if($qq['Item_status'] == 0) {
						?>
						<p class="text-info">PENDING</p>

						<?php
						} else if($qq['Item_status'] == 1) {
						?>
						<p class="text-success">BOUGHT</p>

						<?php } else { ?>
						<p class="text-danger">NOT AVAILABLE</p>

						<?php } ?>
<a href="delete.php?id=<?php echo $q['Id']; ?>"class="card-link">Delete</a>
<a href="update.php?id=<?php echo $q['Id']; ?>"class="card-link">Update</a>
					</div>
				</div><br>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</body>

</html>
