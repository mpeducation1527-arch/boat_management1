<?php

include("db.php");

if(isset($_GET['id']))
{
    $boat_id = $_GET['id'];

    // Check whether boat is used in expenses
    $check_expenses = mysqli_query(
        $conn,
        "SELECT * FROM expenses WHERE boat_id='$boat_id'"
    );

    if(mysqli_num_rows($check_expenses) > 0)
    {
        echo "<script>
        alert('Cannot delete this boat because expense records are linked to it.');
        window.location='view_boats.php';
        </script>";

        exit();
    }


    // Check whether boat is used in fishing trips
    $check_trips = mysqli_query(
        $conn,
        "SELECT * FROM fishing_trips WHERE boat_id='$boat_id'"
    );

    if(mysqli_num_rows($check_trips) > 0)
    {
        echo "<script>
        alert('Cannot delete this boat because fishing trip records are linked to it.');
        window.location='view_boats.php';
        </script>";

        exit();
    }


    // Check whether boat is assigned to crew
    $check_crew = mysqli_query(
        $conn,
        "SELECT * FROM crew WHERE assigned_boat='$boat_id'"
    );

    if(mysqli_num_rows($check_crew) > 0)
    {
        echo "<script>
        alert('Cannot delete this boat because crew members are assigned to it.');
        window.location='view_boats.php';
        </script>";

        exit();
    }


    // Delete boat
    $sql = "DELETE FROM boats WHERE boat_id='$boat_id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Boat deleted successfully.');
        window.location='view_boats.php';
        </script>";
    }
    else
    {
        echo "<script>
        alert('Error deleting boat: ".mysqli_error($conn)."');
        window.location='view_boats.php';
        </script>";
    }
}

?>