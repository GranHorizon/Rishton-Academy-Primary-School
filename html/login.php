<?php

$servername="localhost";
$username="root";
$password="password";
$dbname="rishton_academy";

session_start();

$link = new mysqli($servername,$username,$password,$dbname);
if($link===false)
{
    die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $username=$_POST["username"];
    $password=$_POST["password"];

    $sql="select * from login where username=? AND password=?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    $row=$result->fetch_assoc();

    if($row["usertype"]=="user")
    {   
        
        $_SESSION["username"]=$username;
        header("location:userhome.php");
        exit;
    }

    else if($row["usertype"]=="admin")
    {

        $_SESSION["username"]=$username;
        header("location:adminhome.php");
        exit;
    }

    else
    {
        echo "username or password incorrect";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="css/style.css">
<head>
<header class="header">

<a href="index.php" class="logo"> <i class="fas fa-user-graduate"></i> Rishton Academy </a>

<div id="menu-btn" class="fas fa-bars"></div>

<nav class="navbar">
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="about.php">ABOUT</a></li>
        <li><a href="services.php">SERVICES</a></li>
        <li><a href="login.php">LOGIN</a></li>
    </ul>
</nav>

</header>
    <title>Dashboard Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            width: 500px;
            margin: 40px auto;
            background-color: #ccc;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        input[type="text"], input[type="password"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="submit"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
<body>
    <div class="container">
        <h1>Login Form</h1>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>