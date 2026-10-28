<?php
include("db.php");

// Summary Cards
$totalSales = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT IFNULL(SUM(total_amount),0) AS total FROM sales"));

$pending = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT IFNULL(SUM(total_amount),0) AS pending
FROM sales
WHERE payment_status='Pending'"));

$average = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT IFNULL(AVG(price_per_kg),0) AS avg_price
FROM sales"));

$result = mysqli_query($conn,
"SELECT * FROM sales ORDER BY sale_id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Fish Sales</title>

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

.search{
width:350px;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
}

.btn{
background:#18c4b8;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:8px;
font-weight:bold;
}

.cards{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin:20px 0;
}

.card{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,.1);
}

.card h4{
color:#666;
margin-bottom:10px;
}

.card h2{
color:#003366;
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

.paid{
background:#d1e7dd;
color:#0f5132;
padding:5px 12px;
border-radius:20px;
}

.pending{
background:#fff3cd;
color:#856404;
padding:5px 12px;
border-radius:20px;
}

.edit{
background:#dff4ff;
padding:6px 12px;
text-decoration:none;
border-radius:6px;
color:#0077b6;
}

.delete{
background:#ffe3e3;
padding:6px 12px;
text-decoration:none;
border-radius:6px;
color:red;
}

</style>

</head>

<body>

<div class="container">

<div class="top">

<h2>💰 Fish Sales</h2>

<a href="add_sales.php" class="btn">
+ Record Sale
</a>

</div>

<input
type="text"
id="search"
class="search"
placeholder="Search sales...">

<div class="cards">

<div class="card">
<h4>Total Sales</h4>
<h2>₹ <?php echo number_format($totalSales['total'],2); ?></h2>
</div>

<div class="card">
<h4>Pending Payments</h4>
<h2>₹ <?php echo number_format($pending['pending'],2); ?></h2>
</div>

<div class="card">
<h4>Average Price / Kg</h4>
<h2>₹ <?php echo number_format($average['avg_price'],2); ?></h2>
</div>

</div>

<table id="salesTable">

<tr>
<th>ID</th>
<th>Date</th>
<th>Fish Type</th>
<th>Buyer</th>
<th>Qty (Kg)</th>
<th>Price/Kg</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result))
{

$status=strtolower($row['payment_status']);

echo "<tr>";

echo "<td>SL".$row['sale_id']."</td>";
echo "<td>".$row['sale_date']."</td>";
echo "<td>".$row['fish_type']."</td>";
echo "<td>".$row['buyer_name']."</td>";
echo "<td>".$row['quantity']."</td>";
echo "<td>₹ ".$row['price_per_kg']."</td>";
echo "<td>₹ ".$row['total_amount']."</td>";

echo "<td>";

echo "<span class='$status'>".$row['payment_status']."</span>";

echo "</td>";

echo "<td>

<a class='edit'
href='edit_sale.php?id=".$row['sale_id']."'>
Edit
</a>

<a class='delete'
href='delete_sales.php?id=".$row['sale_id']."'
onclick='return confirm(\"Delete this sale?\")'>
Delete
</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>

<script>

let input=document.getElementById("search");

input.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let rows=document.querySelectorAll("#salesTable tr");

rows.forEach(function(row,index){

if(index==0) return;

row.style.display=row.innerText.toLowerCase().includes(value)?"":"none";

});

});

</script>

</body>
</html>