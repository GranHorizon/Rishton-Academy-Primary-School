<html>
    <head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>My Back End Development Project</title>
    </head>
    <body>
        <h1>Students Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addstudent.php" class="btn btn-primary">Add a student</a>
    <a href="viewstudent.php" class="btn btn-primary">See all students</a>
    <a href="deletestudent.php" class="btn btn-primary">Delete a Student</a>
    <a href="updatestudent.php" class="btn btn-primary">Update a Student</a>

        <h3>Select a Student to delete</h3>

        <form method="post" action="deletestudent.php">

        <label>Select Student:</label>
        <select name="studentID">
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

            // Fetch students from the database
            $sql = $link->query("SELECT StudentID, StudentName FROM Students");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["StudentID"]}'>{$row['StudentName']}</option>";
            }
            $link->close(); // Close the database connection
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Student">
        </form>

        <?php
    // Form submission handling
     if (isset($_POST['submit'])) {
        $StudentID = $_POST['studentID']; 

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // Delete the student record
        $delete_student_sql = "DELETE FROM Students WHERE StudentID='$StudentID'";
        if ($link->query($delete_student_sql) === TRUE) {
            echo "Student record deleted successfully.<br>";
        } else {
            echo "Error deleting student record: ". $link->error. "<br>";
        }
        $link->close(); // Close the database connection
    }
   ?>

        <hr>

    </body>
</html>