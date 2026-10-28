<?php
include("admin_auth.php");
include("db.php");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    mysqli_query($conn,"DELETE FROM crew WHERE crew_id='$id'");

    echo "<script>
    alert('Crew Member Deleted Successfully');
    window.location='view_crew.php';
    </script>";
}
else
{
    echo "Crew ID not found.";
}
?>