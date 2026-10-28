<?php
include("admin_auth.php");
include("db.php");

// Summary Statistics

$totalBoats = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM boats"))['total'];

$totalCrew = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM crew"))['total'];

$totalTrips = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM fishing_trips"))['total'];

$totalCatch = mysqli_fetch_assoc(mysqli_query($conn,"SELECT IFNULL(SUM(quantity),0) total FROM catch_records"))['total'];

$totalSales = mysqli_fetch_assoc(mysqli_query($conn,"SELECT IFNULL(SUM(total_amount),0) total FROM sales"))['total'];

$totalExpenses = mysqli_fetch_assoc(mysqli_query($conn,"SELECT IFNULL(SUM(amount),0) total FROM expenses"))['total'];

$profit = $totalSales - $totalExpenses;

$boats = mysqli_query($conn,"SELECT * FROM boats");
?>

<!DOCTYPE html>
<html>

<head>

<title>Reports</title>

<style>

body{
font-family:Arial;
background:#eef5fb;
margin:0;
padding:25px;
}

.container{
width:95%;
margin:auto;
}

.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.header h2{
color:#003366;
margin:0;
}

.export-btn{
background:#2ec4b6;
color:white;
padding:10px 20px;
border-radius:8px;
text-decoration:none;
font-weight:bold;
}

.cards{
display:grid;
grid-template-columns:1fr 1fr;
gap:25px;
}

.card{
background:white;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
padding:25px;
}

.card h3{
margin-top:0;
color:#003366;
}

label{
display:block;
margin-top:15px;
margin-bottom:6px;
font-weight:bold;
}

input,
select{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:8px;
box-sizing:border-box;
}

.row{
display:flex;
gap:15px;
}

button{
margin-top:20px;
background:#2ec4b6;
color:white;
border:none;
padding:12px 25px;
border-radius:8px;
font-size:15px;
cursor:pointer;
}

.summary-table{
width:100%;
border-collapse:collapse;
}

.summary-table td{
padding:12px;
border-bottom:1px solid #eee;
}

.summary-table td:last-child{
text-align:right;
font-weight:bold;
}

.green{
color:#16a34a;
}

.red{
color:#dc2626;
}

.report-box{
margin-top:30px;
background:white;
border-radius:15px;
padding:25px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}
/* Sidebar */

.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:250px;
    height:100%;
    background:#0f172a;
    color:white;
    overflow-y:auto;
    padding:20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    color:#38bdf8;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    margin:5px 0;
    border-radius:8px;
    transition:.3s;
}

.sidebar a:hover{
    background:#1e293b;
}

.dropdown-btn{
    width:100%;
    background:none;
    border:none;
    color:#94a3b8;
    text-align:left;
    padding:12px 15px;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
    border-radius:8px;
}

.dropdown-btn:hover{
    background:#1e293b;
    color:white;
}

.dropdown-container{
    display:none;
    padding-left:15px;
}

.dropdown-container a{
    display:block;
    color:white;
    text-decoration:none;
    padding:10px 15px;
    border-radius:8px;
    margin:3px 0;
}

.dropdown-container a:hover{
    background:#334155;
}

.main-content{
    margin-left:270px;
    padding:25px;
}
</style>

</head>

<body>

<?php include("includes/sidebar.php"); ?>

<div class="main-content">

<div class="container">

<div class="header">

<h2>📊 Reports</h2>

<a href="#" class="export-btn">
Export All
</a>

</div>

<div class="cards">

<div class="card">

<h3>📑 Generate Reports</h3>

<form method="GET">

<label>Report Type</label>

<select name="type">

<option value="boats">Boat Report</option>

<option value="crew">Crew Report</option>

<option value="trips">Trip Summary</option>

<option value="catch">Catch Report</option>

<option value="sales">Sales Report</option>

<option value="expenses">Expense Report</option>

<option value="maintenance">Maintenance Report</option>

<option value="profit">Profit & Loss</option>

</select>

<div class="row">

<div>

<label>From Date</label>

<input type="date" name="from">

</div>

<div>

<label>To Date</label>

<input type="date" name="to">

</div>

</div>

<label>Boat (Optional)</label>

<select name="boat">

<option value="">All Boats</option>

<?php
while($b=mysqli_fetch_assoc($boats))
{
?>

<option value="<?php echo $b['boat_id']; ?>">

<?php echo $b['boat_name']; ?>

</option>

<?php
}
?>

</select>

<button>
Generate Report
</button>

</form>

</div>

<div class="card">

<h3>📈 Summary Statistics</h3>

<table class="summary-table">

<tr>

<td>Total Revenue</td>

<td class="green">
₹ <?php echo number_format($totalSales,2); ?>
</td>

</tr>

<tr>

<td>Total Expenses</td>

<td class="red">
₹ <?php echo number_format($totalExpenses,2); ?>
</td>

</tr>

<tr>

<td>Net Profit</td>

<td class="green">
₹ <?php echo number_format($profit,2); ?>
</td>

</tr>

<tr>

<td>Total Trips</td>

<td><?php echo $totalTrips; ?></td>

</tr>

<tr>

<td>Total Catch</td>

<td><?php echo $totalCatch; ?> Kg</td>

</tr>

<tr>

<td>Total Boats</td>

<td><?php echo $totalBoats; ?></td>

</tr>

<tr>

<td>Total Crew</td>

<td><?php echo $totalCrew; ?></td>

</tr>

</table>

</div>

</div>
<div class="report-box">

<h3>Generated Report</h3>

<?php

if(isset($_GET['type']))
{

$type = $_GET['type'];

switch($type)
{

case "boats":

$sql="SELECT * FROM boats";

$result=mysqli_query($conn,$sql);

echo "<table border='1' width='100%' cellpadding='10'>";

echo "<tr>
<th>ID</th>
<th>Boat Name</th>
<th>Registration</th>
<th>Type</th>
<th>Engine</th>
</tr>";

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['boat_id']."</td>";

echo "<td>".$row['boat_name']."</td>";

echo "<td>".$row['registration_no']."</td>";

echo "<td>".$row['boat_type']."</td>";

echo "<td>".$row['engine_brand']."</td>";

echo "</tr>";

}

echo "</table>";

break;

case "crew":

$sql="SELECT crew.*,boats.boat_name
FROM crew
LEFT JOIN boats
ON crew.assigned_boat=boats.boat_id";

$result=mysqli_query($conn,$sql);

echo "<table border='1' width='100%' cellpadding='10'>";

echo "<tr>

<th>ID</th>

<th>Name</th>

<th>Role</th>

<th>Boat</th>

<th>Phone</th>

</tr>";

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['crew_id']."</td>";

echo "<td>".$row['full_name']."</td>";

echo "<td>".$row['role']."</td>";

echo "<td>".$row['boat_name']."</td>";

echo "<td>".$row['phone']."</td>";

echo "</tr>";

}

echo "</table>";

break;

case "sales":

$sql="SELECT * FROM sales";

$result=mysqli_query($conn,$sql);

echo "<table border='1' width='100%' cellpadding='10'>";

echo "<tr>

<th>Date</th>

<th>Fish</th>

<th>Quantity</th>

<th>Amount</th>

</tr>";

while($row=mysqli_fetch_assoc($result))
{

echo "<tr>";

echo "<td>".$row['sale_date']."</td>";

echo "<td>".$row['fish_type']."</td>";

echo "<td>".$row['quantity']."</td>";

echo "<td>₹ ".$row['total_amount']."</td>";

echo "</tr>";

}

echo "</table>";

break;

default:

echo "<h3>Select a report.</h3>";

}

}

?>

</div>


</div>

</div>

</body>
</html>