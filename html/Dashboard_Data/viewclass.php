<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Class Database</h1>
        <div class="mb-3">
            <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="addclass.php" class="btn btn-primary">Add a Class</a>
            <a href="viewclass.php" class="btn btn-primary">See all Classes</a>
            <a href="deleteclass.php" class="btn btn-primary">Delete a Class</a>
            <a href="updateclass.php" class="btn btn-primary">Update a Class</a>
        </div>

        <hr>

        <h3>See all Classes</h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Class ID</th>
                    <th scope="col">Class Name</th>
                    <th scope="col">Teacher ID</th>
                    <th scope="col">Assistant ID</th>
                    <th scope="col">Class Capacity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $link = mysqli_connect("localhost", "root", "password", "rishton_academy");

                // Check connection
                if ($link === false) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = mysqli_query($link, "SELECT ClassID, ClassName, TeacherID, AssistantID, ClassCapacity FROM Classes");
                while ($row = $sql->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['ClassID']}</td>
                            <td>{$row['ClassName']}</td>
                            <td>{$row['TeacherID']}</td>
                            <td>{$row['AssistantID']}</td>
                            <td>{$row['ClassCapacity']}</td>
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
