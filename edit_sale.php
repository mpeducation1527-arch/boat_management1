<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Sale ID not found.");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM sales WHERE sale_id='$id'");
$sale = mysqli_fetch_assoc($result);

if(!$sale)
{
    die("Sale not found.");
}

if(isset($_POST['update']))
{
    $sale_date = $_POST['sale_date'];
    $fish_type = $_POST['fish_type'];
    $buyer_name = $_POST['buyer_name'];
    $quantity = $_POST['quantity'];
    $price_per_kg = $_POST['price_per_kg'];
    $payment_status = $_POST['payment_status'];

    $total_amount = $quantity * $price_per_kg;

    mysqli_query($conn,"
    UPDATE sales SET
    sale_date='$sale_date',
    fish_type='$fish_type',
    buyer_name='$buyer_name',
    quantity='$quantity',
    price_per_kg='$price_per_kg',
    total_amount='$total_amount',
    payment_status='$payment_status'
    WHERE sale_id='$id'
    ");

    echo "<script>
    alert('Sale Updated Successfully');
    window.location='view_sales.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Sale</title>

<style>

body{
    background:#eef5fb;
    font-family:Arial,sans-serif;
}

.container{
    width:800px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
    color:#003366;
    margin-bottom:20px;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
}

input,select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

button{
    background:#18c4b8;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
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

<h2>✏ Edit Fish Sale</h2>

<form method="POST">

<div class="form-group">
<label>Sale Date</label>
<input type="date" name="sale_date" value="<?php echo $sale['sale_date']; ?>" required>
</div>

<div class="form-group">
<label>Fish Type</label>
<input type="text" name="fish_type" value="<?php echo $sale['fish_type']; ?>" required>
</div>

<div class="form-group">
<label>Buyer Name</label>
<input type="text" name="buyer_name" value="<?php echo $sale['buyer_name']; ?>" required>
</div>

<div class="form-group">
<label>Quantity (Kg)</label>
<input type="number" step="0.01" id="qty" name="quantity" value="<?php echo $sale['quantity']; ?>" required>
</div>

<div class="form-group">
<label>Price per Kg (₹)</label>
<input type="number" step="0.01" id="price" name="price_per_kg" value="<?php echo $sale['price_per_kg']; ?>" required>
</div>

<div class="form-group">
<label>Total Amount (₹)</label>
<input type="number" id="total" value="<?php echo $sale['total_amount']; ?>" readonly>
</div>

<div class="form-group">
<label>Payment Status</label>

<select name="payment_status">
<option value="Paid" <?php if($sale['payment_status']=="Paid") echo "selected"; ?>>Paid</option>
<option value="Pending" <?php if($sale['payment_status']=="Pending") echo "selected"; ?>>Pending</option>
</select>

</div>

<button type="submit" name="update">Update Sale</button>

<a href="view_sales.php" class="cancel">Cancel</a>

</form>

</div>

<script>

let qty=document.getElementById("qty");
let price=document.getElementById("price");
let total=document.getElementById("total");

function calc(){
    total.value=(Number(qty.value)||0)*(Number(price.value)||0);
}

qty.oninput=calc;
price.oninput=calc;

</script>

</body>
</html>