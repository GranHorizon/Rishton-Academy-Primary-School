<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
<h1>Class Database</h1>
<a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
<a href="addclass.php" class="btn btn-primary">Add a class</a>
<a href="viewclass.php" class="btn btn-primary">See all classes</a>
<a href="deleteclass.php" class="btn btn-primary">Delete a Class</a>
<a href="updateclass.php" class="btn btn-primary">Update a Class</a>
<hr>

<h3>Select a Class to update</h3>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <label>Select Class:</label>
    <select name="ClassID">
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

        // Fetch classes from the database
        $sql = $link->query("SELECT ClassID, ClassName FROM Classes");
        while ($row = $sql->fetch_assoc()) {
            echo "<option value='{$row['ClassID']}'>{$row['ClassName']}</option>";
        }
        ?>
    </select>
    <br><br>

    <label>New Class Name:</label>
    <input type="text" name="NewClassName">
    <br><br>

    <label>New Class Capacity:</label>
    <input type="number" name="NewClassCapacity" min="1">
    <br><br>

    <label>Select New Assistant ID:</label>
    <select name="NewAssistantID">
        <?php
        // Fetch assistant IDs from the database
        $sql_assistants = $link->query("SELECT AssistantID, AssistantName FROM TeacherAssistants");
        while ($row = $sql_assistants->fetch_assoc()) {
            echo "<option value='{$row['AssistantID']}'>{$row['AssistantName']}</option>";
        }
        ?>
    </select>
    <br><br>

    <label>Select New Teacher ID:</label>
    <select name="NewTeacherID">
        <?php
        // Fetch teacher IDs from the database
        $sql_teachers = $link->query("SELECT TeacherID, TeacherName FROM Teachers");
        while ($row = $sql_teachers->fetch_assoc()) {
            echo "<option value='{$row['TeacherID']}'>{$row['TeacherName']}</option>";
        }
        ?>
    </select>
    <br><br>

    <input type="submit" name="submit" value="Update Class">
</form>

<?php
// Form submission handling
if (isset($_POST['submit'])) {
    $ClassID = $_POST['ClassID'];
    $NewClassName = $_POST['NewClassName'];
    $NewClassCapacity = $_POST['NewClassCapacity'];
    $NewAssistantID = $_POST['NewAssistantID'];
    $NewTeacherID = $_POST['NewTeacherID'];

    // SQL Update Query to update the selected class's details
    $sql = "UPDATE Classes 
            SET ClassName = '$NewClassName', ClassCapacity = '$NewClassCapacity', AssistantID = '$NewAssistantID', TeacherID = '$NewTeacherID'
            WHERE ClassID = '$ClassID'";

    if ($link->query($sql) === TRUE) {
        echo "Record updated successfully.<br>";
    } else {
        echo "Error updating record: " . $link->error . "<br>";
    }
}
// Close the database connection
$link->close();
?>

</body>
</html>
