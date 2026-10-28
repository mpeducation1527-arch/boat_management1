<?php
include 'db.php';

$result = mysqli_query($conn,"
SELECT maintenance.*, boats.boat_name
FROM maintenance
LEFT JOIN boats ON maintenance.boat_id = boats.boat_id
ORDER BY maintenance_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Maintenance</title>

<style>

body{
    font-family:Arial;
    background:#eef5fb;
    padding:20px;
}

.container{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

h2{
    color:#003366;
}

.add-btn{
    background:#00b4d8;
    color:white;
    padding:10px 18px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

.add-btn:hover{
    background:#0096c7;
}

.search{
    width:300px;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#003366;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f5fbff;
}

.type{
    background:#dbeafe;
    color:#1e40af;
    padding:5px 12px;
    border-radius:20px;
    font-size:13px;
}

.cost{
    color:red;
    font-weight:bold;
}

.edit{
    background:#28a745;
    color:white;
    padding:7px 12px;
    border-radius:6px;
    text-decoration:none;
    margin-right:5px;
}

.delete{
    background:#dc3545;
    color:white;
    padding:7px 12px;
    border-radius:6px;
    text-decoration:none;
}

</style>

</head>

<body>

<div class="container">

<div class="top-bar">

<h2>🔧 Maintenance Records</h2>

<a href="add_maintenance.php" class="add-btn">
+ Add Maintenance
</a>

</div>

<input
type="text"
class="search"
id="search"
placeholder="Search maintenance...">

<table id="maintenanceTable">

<tr>
<th>Date</th>
<th>Boat</th>
<th>Type</th>
<th>Cost</th>
<th>Mechanic</th>
<th>Next Service</th>
<th>Actions</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['maintenance_date']; ?></td>

<td><?php echo $row['boat_name']; ?></td>

<td>
<span class="type">
<?php echo $row['service_type']; ?>
</span>
</td>

<td class="cost">
₹ <?php echo number_format($row['cost'],2); ?>
</td>

<td><?php echo $row['mechanic']; ?></td>

<td><?php echo $row['next_service']; ?></td>

<td>

<a class="edit"
href="edit_maintenance.php?id=<?php echo $row['maintenance_id']; ?>">
Edit
</a>

<a class="delete"
onclick="return confirm('Delete this maintenance record?')"
href="delete_maintenance.php?id=<?php echo $row['maintenance_id']; ?>">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<script>

document.getElementById("search").addEventListener("keyup", function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll("#maintenanceTable tr");

for(let i=1;i<rows.length;i++)
{
let text=rows[i].innerText.toLowerCase();

rows[i].style.display=text.includes(value)?"":"none";
}

});

</script>

</body>
</html>