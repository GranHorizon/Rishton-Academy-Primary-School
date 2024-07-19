<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Back End Development Project</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Parents Database</h1>
        <div class="mb-3">
            <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="addparent.php" class="btn btn-primary">Add a Parent</a>
            <a href="viewparent.php" class="btn btn-primary">See all Parents</a>
            <a href="deleteparent.php" class="btn btn-primary">Delete a Parent</a>
            <a href="updateparent.php" class="btn btn-primary">Update a Parent</a>
        </div>

        <?php
        // Database connection details
        $link = mysqli_connect("localhost", "root", "password", "rishton_academy");

        // Check connection
        if ($link === false) {
            die("Connection failed: " . mysqli_connect_error());
        }
        ?>

        <hr>

        <h3>See all Parents</h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Parent ID</th>
                    <th scope="col">Parent Name</th>
                    <th scope="col">Parent Phone No.</th>
                    <th scope="col">Parent E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Execute the query
                $sql = mysqli_query($link, "SELECT ParentID, ParentName, ParentPhoneNumber, ParentEmailAddress FROM Parents");
                // Fetch the data and display in table
                while ($row = $sql->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['ParentID']}</td>
                        <td>{$row['ParentName']}</td>
                        <td>{$row['ParentPhoneNumber']}</td>
                        <td>{$row['ParentEmailAddress']}</td>
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
    </div>
</body>
</html>
