<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
<h1>Teachers Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addteacher.php" class="btn btn-primary">Add a teacher</a>
    <a href="viewteacher.php" class="btn btn-primary">See all teachers</a>
    <a href="deleteteacher.php" class="btn btn-primary">Delete a teacher</a>
    <a href="updateteacher.php" class="btn btn-primary">Update a teacher</a>
    <br><br>

    <h3>Add a new teacher</h3>
    <form method="post" action="addteacher.php">
        <label>Teacher Name:</label>
        <input type="text" name="TeacherName" required>
        <label>Teacher Phone:</label>
        <input type="tel" id="phone" name="TeacherPhoneNumber" pattern="[0-9]{11}" required>
        <div class="mb-3">
            <label for="teacherGender" class="form-label">Gender:</label>
            <select id="teacherGender" name="TeacherGender" class="form-select" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        <br><br>
        <input type="submit" name="submit" value="Add Teacher">
    </form>

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

    // SQL to create tables if they do not exist
    $sql = "CREATE TABLE IF NOT EXISTS Teachers (
        TeacherID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        TeacherName VARCHAR(50) NOT NULL,
        TeacherGender VARCHAR(50) NOT NULL,
        TeacherPhone VARCHAR(50) NOT NULL
    )";

    if ($link->query($sql) === TRUE)

    // Form submission handling
    if (isset($_POST['submit'])) {
        $TeacherName = $link->real_escape_string($_POST['TeacherName']);
        $TeacherGender = $link->real_escape_string($_POST['TeacherGender']);
        $TeacherPhoneNumber = $link->real_escape_string($_POST['TeacherPhoneNumber']);

        // SQL Insert Query to add a new teacher
        $sql = "INSERT INTO Teachers (TeacherName, TeacherGender, TeacherPhone) VALUES ('$TeacherName', '$TeacherGender', '$TeacherPhoneNumber')";

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
