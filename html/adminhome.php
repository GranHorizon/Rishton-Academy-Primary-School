<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<?php
session_start();

if(!isset($_SESSION["username"]))
{
    header("location:login.php");
}
?>

<body>
    <header class="header">
        <a href="#" id="toggle-nav">Rishton Academy Admin Dashboard</a>
        <div class="logout">
        <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </header>
    <div class="content">
        <h1>RISHTON ACADEMY DASHBOARD</h1>
        <p>Please Select any of the Categories below</p>
    </div>
            <a href="Dashboard_Data/viewstudent.php" class="btn btn-primary">Students Database</a>
            <a href="Dashboard_Data/viewparent.php" class="btn btn-primary">Parents Database</a>
            <a href="Dashboard_Data/viewteacher.php" class="btn btn-primary">Teachers Database</a>
            <a href="Dashboard_Data/viewclass.php" class="btn btn-primary">Class Database</a>
            <a href="Dashboard_Data/viewenrollment.php" class="btn btn-primary">Enrollments Database</a>
            <a href="Dashboard_Data/viewteacherassistant.php" class="btn btn-primary">Teacher Assistant Database</a>
    
</body>
</html>