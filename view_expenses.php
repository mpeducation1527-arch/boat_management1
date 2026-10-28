<?php
include 'db.php';

$result = mysqli_query($conn,"
SELECT expenses.*, boats.boat_name 
FROM expenses 
LEFT JOIN boats ON expenses.boat_id = boats.boat_id
ORDER BY expense_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>View Expenses</title>

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

h2{
color:#003366;
}

.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:15px;
}

input{
padding:10px;
width:300px;
border:1px solid #ccc;
border-radius:8px;
}

.add-btn{
background:#00b4d8;
color:white;
padding:10px 15px;
text-decoration:none;
border-radius:8px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th{
background:#003366;
color:white;
padding:12px;
}

td{
padding:12px;
border-bottom:1px solid #ddd;
}

tr:hover{
background:#f2f8ff;
}

.badge{
padding:5px 10px;
border-radius:20px;
background:#dbeafe;
color:#1e3a8a;
font-size:12px;
}

.delete-btn{
background:red;
color:white;
padding:6px 10px;
border:none;
border-radius:6px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<div class="top-bar">
<h2>💸 Expenses</h2>

<a class="add-btn" href="add_expense.php">+ Add Expense</a>
</div>

<input type="text" id="search" placeholder="Search expenses...">

<table>

<tr>
<th>Date</th>
<th>Category</th>
<th>Description</th>
<th>Boat</th>
<th>Amount</th>
<th>Receipt</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['expense_date']; ?></td>

<td><span class="badge"><?php echo $row['category']; ?></span></td>

<td><?php echo $row['description']; ?></td>

<td><?php echo $row['boat_name']; ?></td>

<td>₹ <?php echo $row['amount']; ?></td>

<td><?php echo $row['receipt_no']; ?></td>

<td>

<a href="edit_expense.php?id=<?php echo $row['expense_id']; ?>"
style="background:orange;color:white;padding:6px 10px;border-radius:6px;text-decoration:none;margin-right:5px;">
Edit
</a>

<a href="delete_expense.php?id=<?php echo $row['expense_id']; ?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this expense?')">
Delete
</a>

</td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>