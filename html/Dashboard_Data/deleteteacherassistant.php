<html>
<head>
<link rel="stylesheet" href="dashboard.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Teacher Assistants Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addteacherassistant.php" class="btn btn-primary">Add a Teacher Assistant</a>
    <a href="viewteacherassistant.php" class="btn btn-primary">See all Teacher Assistants</a>
    <a href="deleteteacherassistant.php" class="btn btn-primary">Delete a Teacher Assistant</a>
    <a href="updateteacherassistant.php" class="btn btn-primary">Update a Teacher Assistant</a>

    <h3>Select a Teacher Assistant to delete</h3>

    <form method="post" action="deleteteacherassistant.php">
        <label>Select Teacher Assistant:</label>
        <select name="assistantID">
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

            // Fetch teacher assistants from the database
            $sql = $link->query("SELECT AssistantID, AssistantName FROM TeacherAssistants");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["AssistantID"]}'>{$row['AssistantName']}</option>";
            }
            $link->close(); // Close the database connection
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Teacher Assistant">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $AssistantID = $_POST['assistantID']; 

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // Delete the teacher assistant record
        $delete_assistant_sql = "DELETE FROM TeacherAssistants WHERE AssistantID='$AssistantID'";
        if ($link->query($delete_assistant_sql) === TRUE) {
            echo "Teacher Assistant record deleted successfully.<br>";
        } else {
            echo "Error deleting teacher assistant record: ". $link->error. "<br>";
        }
        $link->close(); // Close the database connection
    }
   ?>

    <hr>

</body>
</html>
