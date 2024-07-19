<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
<h1>Teacher Assistants Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addteacherassistant.php" class="btn btn-primary">Add a Teacher Assistant</a>
    <a href="viewteacherassistant.php" class="btn btn-primary">See all Teacher Assistants</a>
    <a href="deleteteacherassistant.php" class="btn btn-primary">Delete a Teacher Assistant</a>
    <a href="updateteacherassistant.php" class="btn btn-primary">Update a Teacher Assistant</a>
    <br><br>

    <h3>Add a new Teacher Assistant</h3>
    <form method="post" action="addteacherassistant.php">
        <label>Assistant Name:</label>
        <input type="text" name="AssistantName" required>
        <label>Gender:</label>
        <input type="text" name="AssistantGender" required>
        <label>Assistant Phone:</label>
        <input type="tel" id="phone" name="AssistantPhoneNumber" pattern="[0-9]{11}" required>
        <br><br>
        <input type="submit" name="submit" value="Add Assistant">
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
    $sql = "CREATE TABLE IF NOT EXISTS TeacherAssistants (
        AssistantID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        AssistantName VARCHAR(50) NOT NULL,
        AssistantGender VARCHAR(50) NOT NULL,
        AssistantPhone VARCHAR(50) NOT NULL
    )";

    if ($link->query($sql) === TRUE)

    // Form submission handling
    if (isset($_POST['submit'])) {
        $AssistantName = $link->real_escape_string($_POST['AssistantName']);
        $AssistantGender = $link->real_escape_string($_POST['AssistantGender']);
        $AssistantPhoneNumber = $link->real_escape_string($_POST['AssistantPhoneNumber']);

        // SQL Insert Query to add a new teacher assistant
        $sql = "INSERT INTO TeacherAssistants (AssistantName, AssistantGender, AssistantPhone) VALUES ('$AssistantName', '$AssistantGender', '$AssistantPhoneNumber')";

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
