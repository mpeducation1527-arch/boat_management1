<?php
include("db.php");

$sql = "SELECT fishing_trips.*, boats.boat_name
FROM fishing_trips
INNER JOIN boats
ON fishing_trips.boat_id = boats.boat_id
ORDER BY trip_id DESC";

$result = mysqli_query($conn, $sql);

if(!$result)
{
    die(mysqli_error($conn));
}

echo "Rows Found: ".mysqli_num_rows($result)."<br><br>";
?>

<!DOCTYPE html>
<html>
<head>
<title>View Fishing Trips</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#eef5fb;
    padding:30px;
}

.container{
    width:95%;
    margin:auto;
}

.top{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.top h2{
    color:#1d3557;
}

.search{
    padding:10px;
    width:250px;
    border:1px solid #ccc;
    border-radius:6px;
}

.btn{
    background:#18c4b8;
    color:white;
    padding:10px 20px;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
}

table{
    width:100%;
    background:white;
    border-collapse:collapse;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

th{
    background:#f4f6f9;
    padding:15px;
}

td{
    padding:15px;
    border-top:1px solid #eee;
}

tr:hover{
    background:#f9fbfd;
}

.edit{
    background:#dff4ff;
    color:#0077b6;
    text-decoration:none;
    padding:7px 12px;
    border-radius:5px;
}

.delete{
    background:#ffe3e3;
    color:red;
    text-decoration:none;
    padding:7px 12px;
    border-radius:5px;
}

.planned{
    background:#fff3cd;
    color:#856404;
    padding:5px 12px;
    border-radius:20px;
}

.ongoing{
    background:#cfe2ff;
    color:#084298;
    padding:5px 12px;
    border-radius:20px;
}

.completed{
    background:#d1e7dd;
    color:#0f5132;
    padding:5px 12px;
    border-radius:20px;
}

.cancelled{
    background:#f8d7da;
    color:#842029;
    padding:5px 12px;
    border-radius:20px;
}

</style>

</head>

<body>

<div class="container">

<div class="top">

<h2>Fishing Trips</h2>

<div>

<input
type="text"
id="searchTrip"
class="search"
placeholder="Search Trip...">

<a href="add_trip.php" class="btn">
+ Add Trip
</a>

</div>

</div>

<table id="tripTable">

<tr>
<th>Boat</th>
<th>Captain</th>
<th>Departure</th>
<th>Return</th>
<th>Destination</th>
<th>Fuel</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

$status=strtolower($row['trip_status']);

echo "<tr>";

echo "<td>".$row['boat_name']."</td>";
echo "<td>".$row['captain_name']."</td>";
echo "<td>".$row['departure_date']."</td>";
echo "<td>".$row['return_date']."</td>";
echo "<td>".$row['destination']."</td>";
echo "<td>".$row['fuel_used']." L</td>";

echo "<td>";

echo "<span class='$status'>".$row['trip_status']."</span>";

echo "</td>";

echo "<td>

<a class='edit' href='edit_trip.php?id=".$row['trip_id']."'>Edit</a>

<a class='delete' href='delete_trip.php?id=".$row['trip_id']."'>Delete</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>

<script>

const input=document.getElementById("searchTrip");

input.addEventListener("keyup",function(){

let filter=input.value.toLowerCase();

let rows=document.querySelectorAll("#tripTable tr");

rows.forEach(function(row,index){

if(index==0) return;

row.style.display=row.innerText.toLowerCase().includes(filter)?"":"none";

});

});

</script>

</body>
</html>