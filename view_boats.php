<?php
include("db.php");

// Get all boats
$sql = "SELECT * FROM boats ORDER BY boat_id DESC";
$result = mysqli_query($conn, $sql);

// Count total boats
$total_boats = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>View Boats</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f7fb;
}

.container{
    width:95%;
    margin:30px auto;
}

.page-title{
    font-size:30px;
    font-weight:bold;
    color:#1d3557;
}

.subtitle{
    color:#777;
    margin-top:5px;
}

.cards{
    margin:30px 0;
}

.card{
    width:250px;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    border-left:6px solid #19c37d;
}

.card h3{
    color:#888;
    font-size:15px;
}

.card h1{
    margin-top:10px;
    color:#1d3557;
}

.toolbar{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.left-tools input{
    padding:12px;
    width:250px;
    border:1px solid #ddd;
    border-radius:8px;
}

.btn{
    background:#19c37d;
    color:white;
    text-decoration:none;
    padding:12px 20px;
    border-radius:8px;
    font-weight:bold;
}

table{
    width:100%;
    background:white;
    border-collapse:collapse;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

th{
    background:#f8f9fb;
    padding:18px;
    text-align:left;
}

td{
    padding:18px;
    border-top:1px solid #eee;
}

tr:hover{
    background:#f9fbff;
}

.actions{
    display:flex;
    gap:10px;
}

.edit{
    background:#dbeeff;
    color:#0066cc;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
}

.delete{
    background:#ffe4e4;
    color:#cc0000;
    padding:8px 14px;
    border-radius:6px;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<h1 class="page-title">🚤 Boat Management</h1>
<p class="subtitle">Manage all registered boats</p>

<div class="cards">

<div class="card">
<h3>Total Boats</h3>
<h1><?php echo $total_boats; ?></h1>
</div>

</div>

<div class="toolbar">

<div class="left-tools">

<input
type="text"
id="searchBoat"
placeholder="🔍 Search Boats...">

</div>

<a href="add_boat.php" class="btn">
+ Add Boat
</a>

</div>

<table>

<tr>

<th>Boat Name</th>
<th>Registration No</th>
<th>Boat Type</th>
<th>Engine HP</th>
<th>Engine Brand</th>
<th>Capacity</th>
<th>Home Port</th>
<th>Actions</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['boat_name']."</td>";

echo "<td>".$row['registration_no']."</td>";

echo "<td>".$row['boat_type']."</td>";

echo "<td>".$row['engine_hp']." HP</td>";

echo "<td>".$row['engine_brand']."</td>";

echo "<td>".$row['capacity']." Kg</td>";

echo "<td>".$row['home_port']."</td>";

echo "<td>";

echo "<div class='actions'>";

echo "<a class='edit' href='edit_boat.php?id=".$row['boat_id']."'>✏ Edit</a>";

echo "<a class='delete'
href='delete_boat.php?id=".$row['boat_id']."'
onclick='return confirm(\"Are you sure you want to delete this boat?\")'>
🗑 Delete
</a>";

echo "</div>";

echo "</td>";

echo "</tr>";

}

?>

</table>

</div>

<script>

const searchInput = document.getElementById("searchBoat");

searchInput.addEventListener("keyup", function(){

let value = this.value.toLowerCase();

let rows = document.querySelectorAll("table tr");

rows.forEach(function(row,index){

if(index==0) return;

row.style.display =
row.innerText.toLowerCase().includes(value)
? ""
: "none";

});

});

</script>

</body>
</html>