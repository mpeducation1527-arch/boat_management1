<?php


session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

include 'db.php';

$boats = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM boats"));
$crew = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM crew"));
$catch = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM catch_records"));
$maintenance = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM maintenance"));

$salesResult = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT IFNULL(SUM(total_amount),0) AS total FROM sales")
);

$totalSales = $salesResult['total'];

$expenseResult = mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT IFNULL(SUM(amount),0) AS total FROM expenses")
);

$totalExpenses = $expenseResult['total'];

$profit = $totalSales - $totalExpenses;
$tripCount = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM fishing_trips"));


?>


<!DOCTYPE html>
<html>
<head>
<title>Boat Management Dashboard</title>

<style>

body{
    margin:0;
    font-family:Arial;
}

.navbar{
    background:#003366;
    color:white;
    padding:20px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.hero{
    height:500px;
    background:url('https://images.unsplash.com/photo-1567899378494-47b22a2ae96a')
    center/cover;
    display:flex;
    justify-content:center;
    align-items:center;
}

.overlay{
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(6px);
    padding:40px;
    border-radius:20px;
}

.overlay h1{
    color:white;
    font-size:50px;
}

.overlay p{
    color:white;
}

.btn{
    background:#00b4d8;
    color:white;
    padding:12px 25px;
    text-decoration:none;
    border-radius:30px;
}
.stats{
    display:flex;
    justify-content:center;
    gap:20px;
    margin:40px;
    flex-wrap:wrap;
}

.stat-card{
    width:220px;
    background:linear-gradient(135deg,#003366,#0066cc);
    color:white;
    text-align:center;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.3);
}

.stat-card h1{
    margin:0;
    font-size:40px;
    color:white;
}

.stat-card p{
    margin-top:10px;
    color:white;
    font-size:18px;
}


.stat-card:hover{
    transform:translateY(-10px);
}

.stat-card h1{
    margin:0;
    font-size:40px;
}

.stat-card p{
    margin-top:10px;
}
.recent-boats{
    width:85%;
    margin:40px auto;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.recent-boats h2{
    color:#003366;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#003366;
    color:white;
    padding:12px;
}

table td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

table tr:hover{
    background:#f2f8ff;
}
.menu a{
    color:white;
    text-decoration:none;
    margin-left:20px;
    font-weight:bold;
}

.menu a:hover{
    color:#00d4ff;
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

.menu-title{
    margin-top:20px;
    margin-bottom:8px;
    font-weight:bold;
    color:#94a3b8;
    font-size:15px;
}

.sidebar hr{
    margin:20px 0;
    border:1px solid #334155;
}

.main-content{
    margin-left:270px;
    padding:25px;
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




</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<?php include("includes/sidebar.php"); ?>

<div class="main-content">
<div style="
display:flex;
justify-content:space-between;
align-items:center;
background:white;
padding:20px 30px;
border-radius:12px;
box-shadow:0 3px 10px rgba(0,0,0,.1);
margin-bottom:25px;">

    <div>
        <h2>🏠 Dashboard</h2>
        <p>Welcome,
            <b><?php echo $_SESSION['username']; ?></b>
        </p>
    </div>

    <div style="font-size:35px;">
        🚢
    </div>




    

</div>
<div style="
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
margin-bottom:25px;">

<h2>🚢 Welcome to Boat Management System</h2>

<p style="margin-top:10px;color:#666;">
Manage boats, crew, fishing trips, maintenance, catch records and sales from one dashboard.
</p>

</div>





<div class="stats">

    <div class="stat-card">
       <h1><?php echo $boats; ?></h1>
        <p>Total Boats</p>
    </div>

    <div class="stat-card">
        <h1><?php echo $crew; ?></h1>
        <p>Total Crew</p>
    </div>

    <div class="stat-card">
        <h1><?php echo $catch; ?></h1>
        <p>Catch Records</p>
    </div>

    <div class="stat-card">
<h1>₹ <?php echo number_format($totalSales,0); ?></h1>
<p>Total Sales</p>
</div>

    <div class="stat-card">
    <h1><?php echo $maintenance; ?></h1>
    <p>Maintenance</p>
</div>

<div class="stat-card">
<h1>₹ <?php echo number_format($totalExpenses,0); ?></h1>
<p>Total Expenses</p>
</div>

<div class="stat-card">
<h1>₹ <?php echo number_format($profit,0); ?></h1>
<p>Net Profit</p>
</div>
</div>

<div class="recent-boats">

<h2>Recent Boats</h2>

<table>

<tr>
    <th>ID</th>
    <th>Boat Name</th>
    <th>Type</th>
    <th>Engine Brand</th>
</tr>

<?php

$recent = mysqli_query($conn,"SELECT * FROM boats ORDER BY boat_id DESC LIMIT 5");

while($row = mysqli_fetch_assoc($recent))
{

echo "<tr>";

echo "<td>".$row['boat_id']."</td>";

echo "<td>".$row['boat_name']."</td>";

echo "<td>".$row['boat_type']."</td>";

echo "<td>".$row['engine_brand']."</td>";

echo "</tr>";

}

?>

</table>

</div>

<div style="display:flex;gap:20px;margin-top:30px;flex-wrap:wrap;">

<div style="background:white;padding:20px;border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.1);width:420px; height:300;">

<h3>📊 Sales vs Expenses</h3>

<canvas id="salesChart"></canvas>

</div>

<div style="background:white;padding:20px;border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.1);width:420px; height:300;">

<h3>🥧 Project Summary</h3>

<canvas id="pieChart"></canvas>

</div>

</div>

<script>

const salesChart = new Chart(document.getElementById('salesChart'), {
    type: 'bar',
    data: {
        labels: ['Sales', 'Expenses', 'Profit'],
        datasets: [{
            label: 'Amount (₹)',
            data: [
                <?php echo $totalSales; ?>,
                <?php echo $totalExpenses; ?>,
                <?php echo $profit; ?>
            ],
            backgroundColor: [
                '#36A2EB',
                '#FF6384',
                '#4BC0C0'
            ]
        }]
    },
    options: {
        responsive: false
    }
});

const pieChart = new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Boats', 'Crew', 'Trips', 'Catch'],
        datasets: [{
            data: [
                <?php echo $boats; ?>,
                <?php echo $crew; ?>,
                <?php echo $tripCount; ?>,
                <?php echo $catch; ?>
            ],
            backgroundColor: [
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#FF6384'
            ]
        }]
    },
    options: {
        responsive: true
    }
});

</script>
       


</body>
</html>