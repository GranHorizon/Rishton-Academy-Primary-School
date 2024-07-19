<html>
    <head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>My Back End Development Project</title>
    </head>
    <body>
        <h1>Teachers Database</h1>
        <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    	<a href="addteacher.php" class="btn btn-primary">Add a teacher</a>
    	<a href="viewteacher.php" class="btn btn-primary">See all teachers</a>
    	<a href="deleteteacher.php" class="btn btn-primary">Delete a Teacher</a>
    	<a href="updateteacher.php"class="btn btn-primary">Update a Teacher</a>

        <h3>Select a Teacher to delete</h3>

        <form method="post" action="deleteteacher.php">

        <label>Select Teacher:</label>
        <select name="teacherID">
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

            // Fetch teachers from the database
            $sql = $link->query("SELECT TeacherID, TeacherName FROM Teachers");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["TeacherID"]}'>{$row['TeacherName']}</option>";
            }
            $link->close(); // Close the database connection
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Teacher">
        </form>

        <?php
    // Form submission handling
     if (isset($_POST['submit'])) {
        $TeacherID = $_POST['teacherID']; 

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // Delete the teacher record
        $delete_teacher_sql = "DELETE FROM Teachers WHERE TeacherID='$TeacherID'";
        if ($link->query($delete_teacher_sql) === TRUE) {
            echo "Teacher record deleted successfully.<br>";
        } else {
            echo "Error deleting teacher record: ". $link->error. "<br>";
        }
        $link->close(); // Close the database connection
    }
   ?>

        <hr>

    </body>
</html>