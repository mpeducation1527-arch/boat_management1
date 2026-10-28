<?php

include 'db.php';

if(isset($_POST['register']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    mysqli_query(
        $conn,
        "INSERT INTO users(username,password,role)
         VALUES('$username','$password','$role')"
    );

    echo "<script>alert('Registration Successful');</script>";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Boat Management System - Sign Up</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:url('boat.jpg') no-repeat center center/cover;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

body::before{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

.signup-box{
    position:relative;
    z-index:1;
    width:400px;
    padding:40px;
    border-radius:20px;
    background:rgba(255,255,255,0.15);
    backdrop-filter:blur(10px);
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    text-align:center;
}

.system-title{
    color:white;
    font-size:22px;
    font-weight:bold;
    margin-bottom:15px;
}

h2{
    color:white;
    margin-bottom:20px;
}

input,
select{
    width:100%;
    padding:12px;
    margin-top:15px;
    border:none;
    border-radius:8px;
    outline:none;
    font-size:15px;
}

button{
    width:100%;
    padding:12px;
    margin-top:20px;
    background:#0077b6;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#023e8a;
}

a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

a:hover{
    text-decoration:underline;
}

.login-link{
    margin-top:20px;
}

</style>

</head>

<body>

<div class="signup-box">

<div class="system-title">
🚤 Boat Management System
</div>

<h2>Create Account</h2>

<form method="POST">

<input
type="text"
name="username"
placeholder="Enter Username"
required>

<input
type="password"
name="password"
placeholder="Enter Password"
required>

<select name="role">
    <option value="admin">Admin</option>
    <option value="crew">Crew</option>
</select>

<button type="submit" name="register">
Register
</button>

<div class="login-link">
    <a href="login.php">Already have an account? Login</a>
</div>

</form>

</div>

</body>
</html>