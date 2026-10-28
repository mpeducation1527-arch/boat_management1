<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

include("db.php");

if(isset($_POST['change']))
{
    $username = $_SESSION['username'];

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $check = mysqli_query($conn,
    "SELECT * FROM users
    WHERE username='$username'
    AND password='$old'");

    if(mysqli_num_rows($check)==0)
    {
        echo "<script>alert('Old Password is Incorrect');</script>";
    }
    else if($new != $confirm)
    {
        echo "<script>alert('New Password and Confirm Password do not match');</script>";
    }
    else
    {
        mysqli_query($conn,
        "UPDATE users
        SET password='$new'
        WHERE username='$username'");

        echo "<script>
        alert('Password Changed Successfully');
        window.location='dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Change Password</title>

<style>

body{
    margin:0;
    background:#eef5fb;
    font-family:Arial;
}

.container{
    width:450px;
    margin:60px auto;
    background:white;
    padding:35px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
    color:#003366;
    text-align:center;
    margin-bottom:30px;
}

label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}

input{
    width:100%;
    padding:12px;
    margin-top:8px;
    border:1px solid #ccc;
    border-radius:8px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:12px;
    margin-top:25px;
    background:#0077b6;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#023e8a;
}

.back{
    display:block;
    text-align:center;
    margin-top:20px;
    text-decoration:none;
    color:#003366;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<h2>🔑 Change Password</h2>

<form method="POST">

<label>Old Password</label>
<input
type="password"
name="old_password"
required>

<label>New Password</label>
<input
type="password"
name="new_password"
required
minlength="6">

<label>Confirm Password</label>
<input
type="password"
name="confirm_password"
required
minlength="6">

<button
type="submit"
name="change">
Change Password
</button>

</form>

<a href="dashboard.php" class="back">
⬅ Back to Dashboard
</a>

</div>

</body>
</html>