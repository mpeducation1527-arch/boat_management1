<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Expense ID not found");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM expenses WHERE expense_id='$id'");
$data = mysqli_fetch_assoc($result);

if(!$data)
{
    die("Expense not found");
}

if(isset($_POST['update']))
{
    $expense_date = $_POST['expense_date'];
    $category = $_POST['category'];
    $boat_id = $_POST['boat_id'];
    $amount = $_POST['amount'];
    $receipt_no = $_POST['receipt_no'];
    $description = $_POST['description'];

    $sql = "UPDATE expenses SET 
        expense_date='$expense_date',
        category='$category',
        boat_id='$boat_id',
        amount='$amount',
        receipt_no='$receipt_no',
        description='$description'
        WHERE expense_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Expense Updated Successfully');
        window.location='view_expenses.php';
        </script>";
    }
    else
    {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Expense</title>

<style>

body{
font-family:Arial;
background:#eef5fb;
padding:30px;
}

.container{
width:750px;
margin:auto;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

label{
font-weight:bold;
display:block;
margin:10px 0 5px;
}

input,select,textarea{
width:100%;
padding:10px;
border:1px solid #ccc;
border-radius:8px;
margin-bottom:10px;
}

button{
background:#003366;
color:white;
padding:10px 15px;
border:none;
border-radius:8px;
cursor:pointer;
}

.cancel{
background:#ccc;
padding:10px 15px;
text-decoration:none;
color:black;
border-radius:8px;
margin-left:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>✏ Edit Expense</h2>

<form method="POST">

<label>Expense Date</label>
<input type="date" name="expense_date" value="<?php echo $data['expense_date']; ?>" required>

<label>Category</label>
<input type="text" name="category" value="<?php echo $data['category']; ?>" required>

<label>Boat ID</label>
<input type="number" name="boat_id" value="<?php echo $data['boat_id']; ?>" required>

<label>Amount (₹)</label>
<input type="number" step="0.01" name="amount" value="<?php echo $data['amount']; ?>" required>

<label>Receipt No</label>
<input type="text" name="receipt_no" value="<?php echo $data['receipt_no']; ?>">

<label>Description</label>
<textarea name="description"><?php echo $data['description']; ?></textarea>

<br>

<button type="submit" name="update">Update Expense</button>

<a href="view_expenses.php" class="cancel">Cancel</a>

</form>

</div>

</body>
</html>