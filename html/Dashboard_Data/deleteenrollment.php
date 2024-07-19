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
    <a href="viewenrollment.php" class="btn btn-primary">See all Enrollments</a>
    <a href="deleteenrollment.php" class="btn btn-primary">Delete an Enrollment</a>
    <a href="updateenrollment.php" class="btn btn-primary">Update an Enrollment</a>
    <br><br>

    <h3>Select an Enrollment to delete</h3>

    <form method="post" action="deleteenrollment.php">
        <label>Select Enrollment:</label>
        <select name="enrollmentID">
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
                die("Connection failed: ". $link->connect_error);
            }

            // Fetch enrollments from the database
            $sql = $link->query("SELECT EnrollmentID, CONCAT(StudentID, ' - ', ClassID) AS EnrollmentDetails FROM Enrollments");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["EnrollmentID"]}'>{$row['EnrollmentDetails']}</option>";
            }
            $link->close(); // Close the database connection
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Enrollment">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $EnrollmentID = $_POST['enrollmentID'];

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // Use prepared statement to avoid SQL injection
        $stmt = $link->prepare("DELETE FROM Enrollments WHERE EnrollmentID = ?");
        $stmt->bind_param("i", $EnrollmentID);

        if ($stmt->execute()) {
            echo "Enrollment record deleted successfully.<br>";
        } else {
            echo "Error deleting enrollment record: ". $stmt->error. "<br>";
        }
        $stmt->close();
        $link->close(); // Close the database connection
    }
    ?>

    <hr>
</body>
</html>

