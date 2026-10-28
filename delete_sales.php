<?php
include("admin_auth.php");
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($conn,"DELETE FROM sales WHERE sale_id='$id'");

    echo "<script>
    alert('Sale Deleted Successfully');
    window.location='view_sales.php';
    </script>";
}
else
{
    echo "Sale ID not found.";
}
?>