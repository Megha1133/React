<?php
    // Delete Table data
    if (isset($_POST["btnSave"])) {
        // Connect to the database
        require_once "connection.php";

        $pr_name    = $con->real_escape_string($_POST["txtpr_name"]);
        $pr_category   = $con->real_escape_string($_POST["txtpr_category"]);
        $pr_quantity = $con->real_escape_string($_POST["txtpr_quantity"]);

        if ($stmt = $con->prepare("INSERT INTO `Products`(`pr_name`, `pr_category`, `pr_quantity`) VALUES (?, ?, ?)")) {
            $stmt->bind_param("sss", $pr_name, $pr_category, $pr_quantity);
            $stmt->execute();
            $stmt->close();
            $msg = '<div class="msg msg-create">product details saved successfully.</div>';
        } else {
            $msg = '<div class="msg">Prepare() failed: '.htmlspecialchars($con->error).'</div>';
        }

        // Close database connection
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data | Simple CRUD with Search in PHP and MySQL </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if(isset($msg)){ echo $msg; }?>
    <main class="container">
        <div class="wrapper">
            <h1>Simple CRUD with Search in PHP and MySQL</h1>
           
        </div>
        <div class="wrapper">
            <div class="title create">
                <h2>Create New Contact</h2>
                <hr>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="frmCreate">
                <input type="text" name="txtpr_name" placeholder="pr_Name" required>
                <input type="text" name="txtpr_category" placeholder="pr_category" required>
                <input type="number" min="1" name="txtpr_quantity" placeholder="pr_quantity" required>
                <div class="btnWrapper">
                    <button type="submit" name="btnSave" title="Save product details">Save</button>
                    <a href="index.php" class="btnHome" title="Return back to homepage">Home</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
