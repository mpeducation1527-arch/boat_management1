<?php

$conn = mysqli_connect("localhost","root","","boat_management1");

if($conn)
{
    echo "Connected";
}
else
{
    echo mysqli_connect_error();
}

?>