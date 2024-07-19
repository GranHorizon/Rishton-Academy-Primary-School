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
        <br><br>

        <h3>Select a Class to delete</h3>

        <form method="post" action="deleteclass.php">

        <label>Select Class:</label>
        <select name="classID">
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

            // Fetch classes from the database
            $sql = $link->query("SELECT ClassID, ClassName FROM Classes");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["ClassID"]}'>{$row['ClassName']}</option>";
            }
            $link->close(); // Close the database connection
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Class">
        </form>

        <?php
    // Form submission handling
     if (isset($_POST['submit'])) {
        $ClassID = $_POST['ClassID'];

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // First, delete associated student records
        $delete_students_sql = "DELETE FROM Students WHERE StudentID='$StudentID'";
        if ($link->query($delete_students_sql) === TRUE) {
            // Now, delete the class record
            $delete_class_sql = "DELETE FROM Classes WHERE ClassID='$ClassID'";
            if ($link->query($delete_class_sql) === TRUE) {
                echo "Class and associated student records deleted successfully.<br>";
            } else {
                echo "Error deleting class record: ". $link->error. "<br>";
            }
        } else {
            echo "Error deleting associated student records: ". $link->error. "<br>";
        }
        $link->close(); // Close the database connection
    }
   ?>

        <hr>

    </body>
</html>