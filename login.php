
<?php

session_start();

include 'db.php';

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE username='$username'
         AND password='$password'"
    );
if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    header("Location: dashboard.php");
    exit();
}
   
    else
    {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Boat Management System - Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e')
    no-repeat center center/cover;
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

.login-box{
    position:relative;
    z-index:1;
    width:380px;
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
    margin-bottom:25px;
}

input{
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

p{
    margin-top:20px;
}

a{
    color:white;
    text-decoration:none;
    font-weight:bold;
}

a:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<div class="login-box">

<div class="system-title">
🚤 Boat Management System
</div>

<h2>Login</h2>

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

<button type="submit" name="login">
Login
</button>

<p>
    <a href="signup.php">
        Create New Account
    </a>
</p>

</form>

</div>

</body>
</html>

