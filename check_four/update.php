<?php
    // Connect to the database
    require_once "connection.php";

    // Get contact details
    if (isset($_GET["id"])) {
        $id = preg_replace('/\D/', '', $_GET["id"]); //Accept numbers only
    } else {
        header("Location: index.php?p=update&err=no_id");
    }

    // Update contact details
    if (isset($_POST["btnUpdate"])) {
        $pr_name    = $con->real_escape_string($_POST["txtpr_name"]);
        $pr_category   = $con->real_escape_string($_POST["txtpr_category"]);
        $pr_quantity = $con->real_escape_string($_POST["txtpr_quantity"]);

        if ($stmt = $con->prepare("UPDATE `Products` SET `pr_name`=?, `pr_category`=?, `pr_quantity`=? WHERE `id`=?")) {
            $stmt->bind_param("sssi", $pr_name, $pr_category, $pr_quantity, $id);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-update">product details updated successfully.</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($con->error).'</div>';
        }
    }


    if ($stmt = $con->prepare("SELECT `pr_name`, `pr_category`, `pr_quantity` FROM `Products` WHERE `id`=? LIMIT 1")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($pr_name, $pr_category, $pr_quantity);
        $stmt->fetch();
        $stmt->free_result();
        $stmt->close();
    } else {
        die('prepare() failed: ' . htmlspecialchars($con->error));
    }

    // Close database connection
    $con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data | Simple CRUD with Search in PHP and MySQL</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Simple CRUD with Search in PHP</h1>
           
        </div>
        <div class="wrapper">
            <div class="title update">
                <h2>Update Contact</h2>
                <hr>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']."?id=".$id;?>" method="post" class="frmUpdate">
                <input type="text" name="txtpr_name" placeholder="pr_name" value="<?php echo $pr_name; ?>" required>
                <input type="text" name="txtpr_category" placeholder="pr_category" value="<?php echo $pr_category; ?>" required>
                <input type="number" min="0" name="txtpr_quantity" placeholder="pr_quantity" value="<?php echo $pr_quantity; ?>" required>
                <div class="btnWrapper">
                    <button type="submit" name="btnUpdate" class="btnUpdate" title="Update product details">Update</button>
                    <a href="index.php" class="btnHome" title="Return back to homepage">Home</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
