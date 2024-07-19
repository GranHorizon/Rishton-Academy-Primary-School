<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <h1>Parents Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addparent.php" class="btn btn-primary">Add a parent</a>
    <a href="viewparent.php" class="btn btn-primary">See all parents</a>
    <a href="deleteparent.php" class="btn btn-primary">Delete a Parent</a>
    <a href="updateparent.php" class="btn btn-primary">Update a Parent</a>
    <hr>

    <h3>Add a new parent</h3>
    <form method="post" action="addparent.php">
        <label>Parent Name:</label>
        <input type="text" name="ParentName">
        <label for="Parent phone number">Enter your phone number:</label>
        <input type="tel" id="phone" name="ParentPhoneNumber" pattern="[0-9]{11}">
        <label for="email">Enter your email:</label>
        <input type="email" id="e-mail" name="ParentEmailAddress">
        <br><br>
        <input type="submit" name="submit">
    </form>



    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "rishton_academy";

    // Create connection
    $link = new mysqli($servername, $username, $password);

    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

	

    // Create database if it does not exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($link->query($sql) === TRUE)

    // Select the database
    $link->select_db($dbname);

    // SQL to create the Parents table if it does not exist
    $sql = "CREATE TABLE IF NOT EXISTS Parents (
        ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ParentName VARCHAR(50) NOT NULL,
        ParentPhoneNumber VARCHAR(12) NOT NULL,
        ParentEmailAddress VARCHAR(50) NOT NULL
    )";

    if ($link->query($sql) === TRUE)



    // Handle form submission for adding a new parent
    if (isset($_POST['submit'])) {

        $ParentName = $_POST['ParentName'];
        $ParentPhoneNumber = $_POST['ParentPhoneNumber'];
        $ParentEmailAddress = $_POST['ParentEmailAddress'];

        echo $ParentEmailAddress;


        // SQL Insert Query to add a new parent
        $sql = "INSERT INTO Parents (ParentName, ParentPhoneNumber, ParentEmailAddress) VALUES ('$ParentName', '$ParentPhoneNumber', '$ParentEmailAddress')";
        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
    } 
}

    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
