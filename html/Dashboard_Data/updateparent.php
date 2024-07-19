<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Parents Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addparent.php" class="btn btn-primary">Add a Parent</a>
    <a href="viewparent.php" class="btn btn-primary">See All Parents</a>
    <a href="deleteparent.php" class="btn btn-primary">Delete a Parent</a>
    <a href="updateparent.php" class="btn btn-primary">Update a Parent</a>
    <hr>

    <h3>Select a Parent to Update</h3>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Select Parent:</label>
        <select name="parentID" class="form-select">
            <?php
            // Database connection details
            $servername = "localhost";
            $username = "root";
            $password = "password";
            $dbname = "rishton_academy";

            // Create connection
            $link = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($link->connect_error) {
                die("Connection failed: " . $link->connect_error);
            }

            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>New Parent Name:</label>
        <input type="text" name="newParentName" class="form-control">
        <br><br>

        <label>New Parent Phone Number:</label>
        <input type="text" name="newParentPhone" class="form-control">
        <br><br>

        <label>New Parent Email:</label>
        <input type="email" name="newParentEmail" class="form-control">
        <br><br>

        <input type="submit" name="submit" value="Update Parent" class="btn btn-primary">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $parentID = $_POST['parentID'];
        $newParentName = $_POST['newParentName'];
        $newParentPhone = $_POST['newParentPhone'];
        $newParentEmail = $_POST['newParentEmail'];

        // Prepare the SQL Update Query
        $sql = "UPDATE Parents SET ParentName = ?, ParentPhoneNumber = ?, ParentEmailAddress = ? WHERE ParentID = ?";

        // Prepare and bind
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("sssi", $newParentName, $newParentPhone, $newParentEmail, $parentID);

            if ($stmt->execute()) {
                echo "Record updated successfully.<br>";
            } else {
                echo "Error updating record: " . $stmt->error . "<br>";
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $link->error . "<br>";
        }
    }

    // Close the database connection
    $link->close();
    ?>
</body>
</html>
