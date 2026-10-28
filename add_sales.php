<?php
include("admin_auth.php");
include("db.php");

if(isset($_POST['submit']))
{
    $sale_date = $_POST['sale_date'];
   $fish_type = $_POST['fish_type'];
    $buyer_name = $_POST['buyer_name'];
    $quantity = $_POST['quantity'];
    $price_per_kg = $_POST['price_per_kg'];

    $total_amount = $quantity * $price_per_kg;

    $payment_status = $_POST['payment_status'];

    $sql = "INSERT INTO sales
    (
        sale_date,
       fish_type,
        buyer_name,
        quantity,
        price_per_kg,
        total_amount,
        payment_status
    )
    VALUES
    (
        '$sale_date',
        '$fish_type',
        '$buyer_name',
        '$quantity',
        '$price_per_kg',
        '$total_amount',
        '$payment_status'
    )";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Sale Recorded Successfully');
        window.location='view_sales.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Sales</title>

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
width:850px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
color:#003366;
margin-bottom:25px;
}

.form-group{
margin-bottom:18px;
}

label{
display:block;
font-weight:bold;
margin-bottom:8px;
}

input,
select{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
font-size:15px;
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

<h2>💰 Record Fish Sale</h2>

<form method="POST">

<div class="form-group">

<label>Sale Date</label>

<input type="date" name="sale_date" required>

</div>
<div class="form-group">

<label>🐟 Fish Type</label>

<input type="text" name="fish_type" required>

</div>



<div class="form-group">

<label>Buyer Name</label>

<input type="text" name="buyer_name" required>

</div>

<div class="form-group">

<label>Quantity (Kg)</label>

<input type="number" step="0.01" id="qty" name="quantity" required>

</div>

<div class="form-group">

<label>Price per Kg (₹)</label>

<input type="number" step="0.01" id="price" name="price_per_kg" required>

</div>

<div class="form-group">

<label>Total Amount (₹)</label>

<input type="number" id="total" readonly>

</div>

<div class="form-group">

<label>Payment Status</label>

<select name="payment_status">

<option value="Paid">Paid</option>

<option value="Pending">Pending</option>

</select>

</div>

<br>

<button type="submit" name="submit">

Save Sale

</button>

<a href="view_sales.php" class="cancel">

Cancel

</a>

</form>

</div>

<script>

let qty=document.getElementById("qty");
let price=document.getElementById("price");
let total=document.getElementById("total");

function calculate()
{
total.value=(Number(qty.value)||0)*(Number(price.value)||0);
}

qty.addEventListener("input",calculate);
price.addEventListener("input",calculate);

</script>

</body>
</html>