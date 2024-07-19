<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>School Management System</title>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Teacher Assistants Database</h1>
        <div class="mb-3">
            <a href="../adminhome.php" class="btn btn-primary">Back to Dashboard</a>
            <a href="addteacherassistant.php" class="btn btn-primary">Add a Teacher Assistant</a>
            <a href="viewteacherassistant.php" class="btn btn-primary">See all Teacher Assistants</a>
            <a href="deleteteacherassistant.php" class="btn btn-primary">Delete a Teacher Assistant</a>
            <a href="updateteacherassistant.php" class="btn btn-primary">Update a Teacher Assistant</a>
        </div>

        <hr>

        <h3>See all Teacher Assistants</h3>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Assistant ID</th>
                    <th scope="col">Assistant Name</th>
                    <th scope="col">Assistant Gender</th>
                    <th scope="col">Assistant Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection details
                $link = mysqli_connect("localhost", "root", "password", "rishton_academy");

                // Check connection
                if ($link === false) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Execute the query
                $sql = mysqli_query($link, "SELECT AssistantID, AssistantName, AssistantGender, AssistantPhone FROM TeacherAssistants");

                // Fetch the data and display in table
                while ($row = $sql->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['AssistantID']}</td>
                            <td>{$row['AssistantName']}</td>
                            <td>{$row['AssistantGender']}</td>
                            <td>{$row['AssistantPhone']}</td>
                          </tr>";
                }

                // Close the database connection
                $link->close();
                ?>
            </tbody>
        </table>

        <hr>
    </div>
</body>
</html>
