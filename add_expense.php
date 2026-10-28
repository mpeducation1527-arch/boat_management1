<?php
include("admin_auth.php");
include("db.php");

if(isset($_POST['submit']))
{
    $expense_date = $_POST['expense_date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $boat_id = $_POST['boat_id'];
    $amount = $_POST['amount'];
    $receipt_no = $_POST['receipt_no'];

    $sql = "INSERT INTO expenses
    (
        expense_date,
        category,
        description,
        boat_id,
        amount,
        receipt_no
    )
    VALUES
    (
        '$expense_date',
        '$category',
        '$description',
        '$boat_id',
        '$amount',
        '$receipt_no'
    )";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Expense Added Successfully');
        window.location='view_expenses.php';
        </script>";
    }
    else
    {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Expense</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#eef5fb;
padding:40px;
}

.container{
width:900px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
color:#003366;
margin-bottom:30px;
}

.form-row{
display:flex;
gap:20px;
margin-bottom:20px;
}

.form-group{
flex:1;
}

label{
display:block;
margin-bottom:8px;
font-weight:bold;
}

input,
select,
textarea{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;
}

textarea{
resize:none;
height:100px;
}

button{
background:#18c4b8;
color:white;
border:none;
padding:12px 25px;
border-radius:8px;
cursor:pointer;
font-size:16px;
}

button:hover{
background:#13a89d;
}

.cancel{
background:#ddd;
padding:12px 25px;
text-decoration:none;
color:black;
border-radius:8px;
margin-left:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>💸 Add Expense</h2>

<form method="POST">

<div class="form-row">

<div class="form-group">
<label>📅 Expense Date</label>
<input type="date" name="expense_date" required>
</div>

<div class="form-group">
<label>📂 Category</label>

<select name="category" required>

<option value="">Select Category</option>

<option>Fuel</option>
<option>Maintenance</option>
<option>Food</option>
<option>Ice</option>
<option>Fishing Gear</option>
<option>Salary</option>
<option>Insurance</option>
<option>Other</option>

</select>

</div>

</div>

<div class="form-row">

<div class="form-group">

<label>🚤 Boat</label>

<select name="boat_id" required>

<option value="">Select Boat</option>

<?php

$boats=mysqli_query($conn,"SELECT * FROM boats ORDER BY boat_name");

while($boat=mysqli_fetch_assoc($boats))
{
?>

<option value="<?php echo $boat['boat_id']; ?>">

<?php echo $boat['boat_name']; ?>

</option>

<?php
}
?>

</select>

</div>

<div class="form-group">

<label>💰 Amount (₹)</label>

<input
type="number"
step="0.01"
name="amount"
required>

</div>

</div>

<div class="form-row">

<div class="form-group">

<label>🧾 Receipt Number</label>

<input
type="text"
name="receipt_no">

</div>

</div>

<div class="form-row">

<div class="form-group">

<label>📝 Description</label>

<textarea
name="description"
required></textarea>

</div>

</div>

<br>

<button type="submit" name="submit">
Save Expense
</button>

<a href="view_expenses.php" class="cancel">
Cancel
</a>

</form>

</div>

</body>
</html>