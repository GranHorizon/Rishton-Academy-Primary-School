<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <h1>Teachers Database</h1>
    <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="addteacher.php" class="btn btn-primary">Add a Teacher</a>
    <a href="viewteacher.php" class="btn btn-primary">See all teachers</a>
    <a href="deleteteacher.php" class="btn btn-primary">Delete a Teacher</a>
    <a href="updateteacher.php" class="btn btn-primary">Update a Teacher</a>
    <hr>

    <?php
    // Database connection details
    $link = mysqli_connect("localhost", "root", "password", "rishton_academy");

    // Check connection
    if ($link === false) {
        die("Connection failed: " . mysqli_connect_error());
    }
    ?>

    <h3>See all Teachers</h3>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th scope="col">Teacher ID</th>
                <th scope="col">Teacher Name</th>
                <th scope="col">Teacher Gender</th>
                <th scope="col">Teacher Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Execute the query
            $sql = mysqli_query($link, "SELECT TeacherID, TeacherName, TeacherGender, TeacherPhone FROM Teachers");
            // Fetch the data and display in table
            while ($row = $sql->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['TeacherID']}</td>
                    <td>{$row['TeacherName']}</td>
                    <td>{$row['TeacherGender']}</td>
                    <td>{$row['TeacherPhone']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    // Close the database connection
    $link->close();
    ?>

    <hr>
</body>
</html>
