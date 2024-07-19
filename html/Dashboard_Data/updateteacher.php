<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Teachers Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addteacher.php" class="btn btn-primary">Add a Teacher</a>
    <a href="viewteacher.php" class="btn btn-primary">See All Teachers</a>
    <a href="deleteteacher.php" class="btn btn-primary">Delete a Teacher</a>
    <a href="updateteacher.php" class="btn btn-primary">Update a Teacher</a>
    <hr>

    <h3>Select a Teacher to Update</h3>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label>Select Teacher:</label>
        <select name="TeacherID" class="form-select">
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

            // Fetch teachers from the database
            $sql = $link->query("SELECT TeacherID, TeacherName FROM Teachers");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['TeacherID']}'>{$row['TeacherName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>New Teacher Name:</label>
        <input type="text" name="newTeacherName" class="form-control">
        <br><br>

        <label>New Teacher Gender:</label>
        <select name="newTeacherGender" class="form-select">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <br><br>

        <label>New Teacher Phone Number:</label>
        <input type="text" name="newTeacherPhone" class="form-control">
        <br><br>

        <input type="submit" name="submit" value="Update Teacher" class="btn btn-primary">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $teacherID = $_POST['TeacherID'];
        $newTeacherName = $_POST['newTeacherName'];
        $newTeacherGender = $_POST['newTeacherGender'];
        $newTeacherPhone = $_POST['newTeacherPhone'];

        // Prepare the SQL Update Query
        $sql = "UPDATE Teachers SET TeacherName = ?, TeacherGender = ?, TeacherPhone = ? WHERE TeacherID = ?";

        // Prepare and bind
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("sssi", $newTeacherName, $newTeacherGender, $newTeacherPhone, $teacherID);

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
