<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Students Database</h1>
        <div class="mb-3">
            <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="addstudent.php" class="btn btn-primary">Add a Student</a>
            <a href="viewstudent.php" class="btn btn-primary">See all Students</a>
            <a href="deletestudent.php" class="btn btn-primary">Delete a Student</a>
            <a href="updatestudent.php" class="btn btn-primary">Update a Student</a>
        </div>

        <?php
        $link = mysqli_connect("localhost", "root", "password", "rishton_academy");
        // Check connection
        if ($link === false) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ?>

        <hr>

        <h3>See all Students</h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Parent ID</th>
                    <th scope="col">Student E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = mysqli_query($link, "SELECT StudentID, StudentName, ParentID, StudentEmailAddress FROM Students");
                while ($row = $sql->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['StudentID']}</td>
                        <td>{$row['StudentName']}</td>
                        <td>{$row['ParentID']}</td>
                        <td>{$row['StudentEmailAddress']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <?php
        $link->close();
        ?>

        <hr>
    </div>
</body>
</html>
