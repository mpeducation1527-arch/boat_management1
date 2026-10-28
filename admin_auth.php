<?php
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

if($_SESSION['role'] != "admin")
{
    echo "<script>
    alert('Access Denied! Only Admin can access this page.');
    window.location='dashboard.php';
    </script>";
    exit();
}
?>