<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Enrollments Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addenrollment.php" class="btn btn-primary">Add an Enrollment</a>
    <a href="viewenrollment.php" class="btn btn-primary">See All Enrollments</a>
    <a href="deleteenrollment.php" class="btn btn-primary">Delete an Enrollment</a>
    <a href="updateenrollment.php" class="btn btn-primary">Update an Enrollment</a>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h3>Select Enrollment to Update:</h3>

        <label>Select Enrollment</label>
        <select name="EnrollmentID" class="form-select">
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

            // Fetch enrollments from the database
            $sql = $link->query("SELECT EnrollmentID FROM Enrollments");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row['EnrollmentID']}'>{$row['EnrollmentID']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>Select New Class ID:</label>
        <select name="NewClassID" class="form-select">
            <?php
            // Fetch class IDs from the database
            $sql_classes = $link->query("SELECT ClassID, ClassName FROM Classes");
            while ($row = $sql_classes->fetch_assoc()) {
                echo "<option value='{$row['ClassID']}'>{$row['ClassName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <label>Select New Student ID:</label>
        <select name="NewStudentID" class="form-select">
            <?php
            // Fetch student IDs from the database
            $sql_students = $link->query("SELECT StudentID, StudentName FROM Students");
            while ($row = $sql_students->fetch_assoc()) {
                echo "<option value='{$row['StudentID']}'>{$row['StudentName']}</option>";
            }
            ?>
        </select>
        <br><br>

        <input type="submit" name="submit" value="Update Enrollment" class="btn btn-primary">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $enrollmentID = $_POST['EnrollmentID'];
        $newClassID = $_POST['NewClassID'];
        $newStudentID = $_POST['NewStudentID'];

        // Update query to update the selected enrollment's class ID and student ID
        $sql = "UPDATE Enrollments SET ClassID = ?, StudentID = ? WHERE EnrollmentID = ?";

        // Prepare and bind
        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("iii", $newClassID, $newStudentID, $enrollmentID);

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
