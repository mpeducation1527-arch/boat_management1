<?php
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($conn,"DELETE FROM catch_records WHERE catch_id='$id'");

    echo "<script>
    alert('Catch Record Deleted Successfully');
    window.location='view_catch.php';
    </script>";
}
else
{
    echo "Catch ID not found.";
}
?>