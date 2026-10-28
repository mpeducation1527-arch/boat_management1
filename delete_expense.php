<?php
include("admin_auth.php");
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $sql = "DELETE FROM expenses WHERE expense_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        header("Location: view_expenses.php");
        exit();
    }
    else
    {
        echo "Delete failed: " . mysqli_error($conn);
    }
}
?>