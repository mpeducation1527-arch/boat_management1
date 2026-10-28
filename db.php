<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "boat_management1",
    3307
);

if(!$conn)
{
    die("Connection Failed: " . mysqli_connect_error());
}

?>