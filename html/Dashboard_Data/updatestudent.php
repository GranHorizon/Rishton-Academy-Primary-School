<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Students Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addstudent.php" class="btn btn-primary">Add a Student</a>
    <a href="viewstudent.php" class="btn btn-primary">See All Students</a>
    <a href="deletestudent.php" class="btn btn-primary">Delete a Student</a>
    <a href="updatestudent.php" class="btn btn-primary">Update a Student</a>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h3>Select Student to Update:</h3>

        <label>Select Student</label>
        <select name="StudentID" class="form-select">
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

            // Fetch students from the database
            $sql = $link->query("SELECT StudentID, StudentName FROM Students");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['StudentID']}'>{$row['StudentName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>New Student Name:</label>
        <input type="text" name="newStudentName" class="form-control">
        <br><br>

        <label>New Student Email:</label>
        <input type="email" name="newStudentEmail" class="form-control">
        <br><br>

        <input type="submit" name="submit" value="Update Student" class="btn btn-primary">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $studentID = $_POST['StudentID'];
        $newStudentName = $_POST['newStudentName'];
        $newStudentEmail = $_POST['newStudentEmail'];

        // Update query to update the selected student's name and email
        $sql = "UPDATE Students SET StudentName = ?, StudentEmailAddress = ? WHERE StudentID = ?";

        // Prepare and bind
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("ssi", $newStudentName, $newStudentEmail, $studentID);

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
