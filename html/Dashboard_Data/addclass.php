<?php 
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

$sqlTeachers = "SELECT * FROM Teachers";
$teachers = mysqli_query($link, $sqlTeachers);

$sqlAssistants = "SELECT * FROM TeacherAssistants";
$assistants = mysqli_query($link, $sqlAssistants);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <h1>Class Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addclass.php" class="btn btn-primary">Add a class</a>
    <a href="viewclass.php" class="btn btn-primary">See all classes</a>
    <a href="deleteclass.php" class="btn btn-primary">Delete a Class</a>
    <a href="updateclass.php" class="btn btn-primary">Update a Class</a>
    <hr>

    <h3>Add a new class</h3>
    <form method="post" action="addclass.php">
        <label>Class Name:</label>
        <input type="text" name="ClassName">
        <label for="Class capacity">Enter your class capacity:</label>
        <input type="number" id="capacity" name="ClassCapacity">
        <br><br>
        <label>Select Teacher:</label>
        <select class="form-select" id="teacher" name="TeacherID">
            <option value="" disabled selected>Select a teacher</option>
            <?php while($teacher = $teachers->fetch_assoc()){ ?>
            <option value="<?php echo $teacher['TeacherID'];?>"><?php echo $teacher['TeacherName'];?></option>
            <?php } ?>
        </select>
        <br><br>
        <label>Select Assistant:</label>
        <select class="form-select" id="assistant" name="AssistantID">
            <option value="" disabled selected>Select an assistant</option>
            <?php while($assistant = $assistants->fetch_assoc()){ ?>
            <option value="<?php echo $assistant['AssistantID'];?>"><?php echo $assistant['AssistantName'];?></option>
            <?php } ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Add Class">
    </form>

    <?php
    // Create database if it does not exist
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($link->query($sql) === TRUE)

    // Select the database
    $link->select_db($dbname);

    // Teachers table creation if it does not exist
    $sqlTeachersTable = "CREATE TABLE IF NOT EXISTS Teachers (
        TeacherID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        TeacherName VARCHAR(50) NOT NULL,
        TeacherGender VARCHAR(50) NOT NULL,
        TeacherPhone VARCHAR(50) NOT NULL
    )";

    if ($link->query($sqlTeachersTable) === TRUE)

    // Teacher Assistants table creation if it does not exist
    $sqlAssistantsTable = "CREATE TABLE IF NOT EXISTS TeacherAssistants (
        AssistantID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        AssistantName VARCHAR(50) NOT NULL,
        AssistantGender VARCHAR(50) NOT NULL,
        AssistantPhone VARCHAR(50) NOT NULL
    )";

    if ($link->query($sqlAssistantsTable) === TRUE)

    // Classes table creation if it does not exist
    $sqlClassesTable = "CREATE TABLE IF NOT EXISTS Classes (
        ClassID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        TeacherID INT(6) UNSIGNED,
        AssistantID INT(6) UNSIGNED,
        ClassName VARCHAR(50) NOT NULL,
        ClassCapacity VARCHAR(50) NOT NULL,
        FOREIGN KEY (TeacherID) REFERENCES Teachers(TeacherID),
        FOREIGN KEY (AssistantID) REFERENCES TeacherAssistants(AssistantID)
    )";

    if ($link->query($sqlClassesTable) === TRUE)

    // Handle form submission for adding a new class
    if (isset($_POST['submit'])) {
        $ClassName = $_POST['ClassName'];
        $TeacherID = $_POST['TeacherID'];
        $AssistantID = $_POST['AssistantID'];
        $ClassCapacity = $_POST['ClassCapacity'];

        // SQL Insert Query to add a new class
        $sqlInsertClass = "INSERT INTO Classes (ClassName, TeacherID, AssistantID, ClassCapacity) VALUES ('$ClassName', '$TeacherID', '$AssistantID', '$ClassCapacity')";
        if (mysqli_query($link, $sqlInsertClass)) {
            echo "New record created successfully";
        } else {
            echo "Error adding record: " . mysqli_error($link);
        }
    }

    // Close the database connection
    $link->close();
    ?>

    <hr>

</body>

</html>
