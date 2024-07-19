<html>
    <head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>My Back End Development Project</title>
    </head>
    <body>
        <h1>Parents Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addparent.php" class="btn btn-primary">Add a parent</a>
    <a href="viewparent.php" class="btn btn-primary">See all parents</a>
    <a href="deleteparent.php" class="btn btn-primary">Delete a Parent</a>
    <a href="updateparent.php" class="btn btn-primary">Update a Parent</a>
        <br><br>

        <h3>Select a Parent to delete</h3>

        <form method="post" action="deleteparent.php">

        <label>Select Parent:</label>
        <select name="parentID">
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

            // Fetch parents from the database
            $sql = $link->query("SELECT ParentID, ParentName FROM Parents");
            while ($row = $sql->fetch_assoc()) {
                echo "<option value='{$row["ParentID"]}'>{$row['ParentName']}</option>";
            }
            $link->close(); // Close the database connection
           ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="Delete Parent">
        </form>

        <?php
    // Form submission handling
     if (isset($_POST['submit'])) {
        $ParentID = $_POST['parentID']; // Fix: Use 'parentID' instead of 'ParentID'

        // Create connection
        $link = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($link->connect_error) {
            die("Connection failed: ". $link->connect_error);
        }

        // First, delete associated student records
        $delete_students_sql = "DELETE FROM Students WHERE ParentID='$ParentID'";
        if ($link->query($delete_students_sql) === TRUE) {
            // Now, delete the parent record
            $delete_parent_sql = "DELETE FROM Parents WHERE ParentID='$ParentID'";
            if ($link->query($delete_parent_sql) === TRUE) {
                echo "Parent and associated student records deleted successfully.<br>";
            } else {
                echo "Error deleting parent record: ". $link->error. "<br>";
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