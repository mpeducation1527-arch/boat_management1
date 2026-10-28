<?php
include("admin_auth.php");
include("db.php");

// TOTAL SALES
$sales = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT IFNULL(SUM(total_amount),0) AS total FROM sales"
));
$totalSales = $sales['total'];

// TOTAL EXPENSES
$expenses = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT IFNULL(SUM(amount),0) AS total FROM expenses"
));
$totalExpenses = $expenses['total'];

// PROFIT / LOSS
$profit = $totalSales - $totalExpenses;

// CATEGORY WISE EXPENSE
$expenseCat = mysqli_query($conn,"
SELECT category, SUM(amount) as total 
FROM expenses 
GROUP BY category
");

// SAMPLE REVENUE (if you have fish_sales table)
$revenueCat = mysqli_query($conn,"
SELECT fish_type, SUM(total_amount) as total 
FROM sales 
GROUP BY fish_type
");
?>



<!DOCTYPE html>
<html>
<head>
<title>Profit & Loss</title>

<style>
body{
font-family:Arial;
background:#f4f7fb;
margin:0;
padding:20px;
}

.container{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.flex{
display:flex;
gap:20px;
}

.card{
flex:1;
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

h2{
color:#003366;
}

.green{
color:green;
font-weight:bold;
}

.red{
color:red;
font-weight:bold;
}

.row{
display:flex;
justify-content:space-between;
padding:8px 0;
border-bottom:1px solid #eee;
}

.total{
font-weight:bold;
border-top:2px solid #000;
margin-top:10px;
padding-top:10px;
}
</style>

</head>

<body>

<div class="container">

<h2>📊 Profit & Loss Dashboard</h2>

<div class="flex">

<!-- REVENUE -->
<div class="card">
<h3>💰 Revenue Summary</h3>

<?php
while($r = mysqli_fetch_assoc($revenueCat)) {
echo "<div class='row'>
<span>{$r['fish_type']}</span>
<span class='green'>₹ {$r['total']}</span>
</div>";
}
?>

<div class="total">
TOTAL: ₹ <?php echo $totalSales; ?>
</div>

</div>

<!-- EXPENSE -->
<div class="card">
<h3>💸 Expense Summary</h3>

<?php
while($e = mysqli_fetch_assoc($expenseCat)) {
echo "<div class='row'>
<span>{$e['category']}</span>
<span class='red'>₹ {$e['total']}</span>
</div>";
}
?>

<div class="total">
TOTAL: ₹ <?php echo $totalExpenses; ?>
</div>

</div>

</div>

<!-- PROFIT -->
<div class="card" style="margin-top:20px;text-align:center;">
<h2>
Net Profit:
<span class="<?php echo ($profit >= 0) ? 'green' : 'red'; ?>">
₹ <?php echo $profit; ?>
</span>
</h2>
</div>

</div>

</body>
</html>