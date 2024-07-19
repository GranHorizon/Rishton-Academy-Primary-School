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

    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <h3>Select Teacher Assistant to update:</h3>

    <label>Select Teacher Assistant: </label>
    <select name="AssistantID">
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

        //Fetch teacher assistants from the database
        $sql = $link->query("SELECT AssistantID, AssistantName FROM TeacherAssistants");
        while ($row = $sql->fetch_assoc()) {
            echo "<option value='{$row['AssistantID']}'>{$row['AssistantName']}</option>";
        }
        ?>
    </select>
    <br><br>

    <label>New Assistant Name:</label>
    <input type="text" name="newAssistantName">
    <br><br>
    
    <label>New Assistant Gender:</label>
    <input type="text" name="newAssistantGender">
    <br><br>
    
    <label>New Assistant Phone:</label>
    <input type="tel" name="newAssistantPhone">
    <br><br>
    
    <input type="submit" name="submit" value="Update Teacher Assistant">
    </form>

    <?php
    // Form submission handling
    if (isset($_POST['submit'])) {
        $assistantID = $_POST['AssistantID'];
        $newAssistantName = $_POST['newAssistantName'];
        $newAssistantGender = $_POST['newAssistantGender'];
        $newAssistantPhone = $_POST['newAssistantPhone'];

        // SQL Update Query to update the selected teacher assistant's details
        $sql = "UPDATE TeacherAssistants SET AssistantName = '$newAssistantName', AssistantGender = '$newAssistantGender', AssistantPhone = '$newAssistantPhone' WHERE AssistantID = '$assistantID'";

        if ($link->query($sql) === TRUE) {
            echo "Record updated successfully.<br>";
        } else {
            echo "Error updating record: ". $link->error. "<br>";
        }
    }
    // Close the database connection
    $link->close();
    ?>

</body>
</html>
