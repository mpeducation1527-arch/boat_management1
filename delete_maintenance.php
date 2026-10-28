<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Maintenance ID not found.");
}

$id = $_GET['id'];

$sql = "DELETE FROM maintenance WHERE maintenance_id='$id'";

if(mysqli_query($conn,$sql))
{
    echo "<script>
    alert('Maintenance Record Deleted Successfully');
    window.location='view_maintenance.php';
    </script>";
}
else
{
    echo "Error: ".mysqli_error($conn);
}
?>