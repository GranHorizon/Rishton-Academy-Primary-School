<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>

<body>
    <h1>Students Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addstudent.php" class="btn btn-primary">Add a student</a>
    <a href="viewstudent.php" class="btn btn-primary">See all students</a>
    <a href="deletestudent.php" class="btn btn-primary">Delete a Student</a>
    <a href="updatestudent.php" class="btn btn-primary">Update a Student</a>


    <h3>Add a new student</h3>
    <form method="post" action="addstudent.php">
        <label>Student Name:</label>
        <input type="text" name="StudentName">
        <label for="email">Enter your email:</label>
        <input type="email" id="e-mail" name="StudentEmailAddress">
        <br><br>

        <label>Select Parent:</label>
        <select name="ParentID">

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
            } else {
                echo "Connected successfully.<br>";
            }

            // Create database if not exists
            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            if ($link->query($sql) === TRUE) {
                echo "Database created successfully or already exists.<br>";
            } else {
                echo "Error creating database: " . $link->error . "<br>";
            }

            // Select the database
            $link->select_db($dbname);

            // SQL to create tables if they do not exist
            $sql = "CREATE TABLE IF NOT EXISTS Parents (
                ParentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                ParentName VARCHAR(50) NOT NULL,
                ParentPhoneNumber VARCHAR(12) NOT NULL,
                ParentEmailAddress VARCHAR(50) NOT NULL
            )";

            if ($link->query($sql) === TRUE) {
                echo "Table Parents created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }

            $sql = "CREATE TABLE IF NOT EXISTS Students (
                StudentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                StudentName VARCHAR(50) NOT NULL,
                ParentID INT(6) UNSIGNED,
                StudentEmailAddress VARCHAR(50) NOT NULL,
                FOREIGN KEY (ParentID) REFERENCES Parents(ParentID)

            )";

            if ($link->query($sql) === TRUE) {
                echo "Table Students created successfully or already exists.<br>";
            } else {
                echo "Error creating table: " . $link->error . "<br>";
            }

            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['ParentID']}'>{$row['ParentName']}</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Add Student">
    </form>


    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $StudentName = $_POST['StudentName'];
        $ParentID = $_POST['ParentID'];
        $StudentEmailAddress = $_POST['StudentEmailAddress'];
        // Debug: Display input values
        //echo "StudentName: $StudentName<br>";
        //echo "ParentID: $ParentID<br>";
    
        // SQL Insert Query to add a new student
        $sql = "INSERT INTO Students (StudentName, ParentID, StudentEmailAddress) VALUES ('$StudentName',
         '$ParentID', '$StudentEmailAddress')";

        // Debug: Display SQL query
        //echo "SQL Query: $sql<br>";
        if ($link->query($sql) === TRUE) {
            echo "New record created successfully.<br>";
        } else {
            echo "Error adding record: " . $link->error . "<br>";
        }
    }
    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>