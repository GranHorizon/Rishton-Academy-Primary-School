<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get the form data
    $studentID = $_POST['StudentID'];
    $classID = $_POST['ClassID'];

    // Prepare and bind
    $stmt = $link->prepare("INSERT INTO Enrollments (StudentID, ClassID) VALUES (?, ?)");
    $stmt->bind_param("ii", $studentID, $classID);

    // Execute the query
    if ($stmt->execute()) {
        echo "New enrollment added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $link->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
<h1>Enrollments Database</h1>
<a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addenrollment.php" class="btn btn-primary">Add an Enrollment</a>
    <a href="viewenrollment.php" class="btn btn-primary">See all Enrollments</a>
    <a href="deleteenrollment.php" class="btn btn-primary">Delete an Enrollment</a>
    <a href="updateenrollment.php" class="btn btn-primary">Update an Enrollment</a>

<h3>Add a new enrollment</h3>
<form method="post" action="addenrollment.php">
    <label for="StudentID">Student ID:</label>
    <select name="StudentID" id="StudentID">
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

        // Fetch StudentID from the database
        $sql = "SELECT StudentID FROM Students";
        $result = $link->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['StudentID']}'>{$row['StudentID']}</option>";
        }
        ?>
    </select>

    <label for="ClassID">Class ID:</label>
    <select name="ClassID" id="ClassID">
        <?php
        // Fetch ClassID from the database
        $sql = "SELECT ClassID FROM Classes";
        $result = $link->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['ClassID']}'>{$row['ClassID']}</option>";
        }

        // Close the database connection
        $link->close();
        ?>
    </select>
    <br><br>
    <input type="submit" name="submit" value="Add Enrollment" class="btn btn-primary">
</form>
</body>
</html>
