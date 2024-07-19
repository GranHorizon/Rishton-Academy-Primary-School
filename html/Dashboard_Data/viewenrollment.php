<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Enrollments Database</h1>
        <div class="mb-3">
            <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="addenrollment.php" class="btn btn-primary">Add an Enrollment</a>
            <a href="viewenrollment.php" class="btn btn-primary">See all Enrollments</a>
            <a href="deleteenrollment.php" class="btn btn-primary">Delete an Enrollment</a>
            <a href="updateenrollment.php" class="btn btn-primary">Update an Enrollment</a>
        </div>

        <hr>

        <h3>See all Enrollments</h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Enrollment ID</th>
                    <th scope="col">Class ID</th>
                    <th scope="col">Student ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $link = mysqli_connect("localhost", "root", "password", "rishton_academy");

                // Check connection
                if ($link === false) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = mysqli_query($link, "SELECT EnrollmentID, ClassID, StudentID FROM Enrollments");
                while ($row = $sql->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['EnrollmentID']}</td>
                            <td>{$row['ClassID']}</td>
                            <td>{$row['StudentID']}</td>
                          </tr>";
                }
                $link->close();
                ?>
            </tbody>
        </table>

        <hr>
    </div>
</body>
</html>
