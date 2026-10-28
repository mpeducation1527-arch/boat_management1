<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Catch ID not found.");
}

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM catch_records WHERE catch_id='$id'");
$catch = mysqli_fetch_assoc($result);

if(!$catch)
{
    die("Catch Record not found.");
}

if(isset($_POST['update']))
{
    $catch_date = $_POST['catch_date'];
    $trip_id = $_POST['trip_id'];
    $fish_type = $_POST['fish_type'];
    $quantity = $_POST['quantity'];
    $quality_grade = $_POST['quality_grade'];
    $estimated_value = $_POST['estimated_value'];

    $sql = "UPDATE catch_records SET
        catch_date='$catch_date',
        trip_id='$trip_id',
        fish_type='$fish_type',
        quantity='$quantity',
        quality_grade='$quality_grade',
        estimated_value='$estimated_value'
        WHERE catch_id='$id'";

    if(mysqli_query($conn, $sql))
    {
        echo "<script>
        alert('Catch Record Updated Successfully');
        window.location='view_catch.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Catch Record</title>

<style>

body{
    background:#eef5fb;
    font-family:Arial,sans-serif;
}

.container{
    width:850px;
    margin:40px auto;
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
}

button{
    background:#18c4b8;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
}

.cancel{
    background:#ccc;
    color:black;
    text-decoration:none;
    padding:12px 25px;
    border-radius:8px;
    margin-right:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>✏ Edit Catch Record</h2>

<form method="POST">

<div class="form-group">
<label>Catch Date</label>
<input type="date" name="catch_date"
value="<?php echo $catch['catch_date']; ?>" required>
</div>

<div class="form-group">

<label>Trip Reference</label>

<select name="trip_id">

<?php

$trips=mysqli_query($conn,"
SELECT fishing_trips.trip_id,
boats.boat_name
FROM fishing_trips
INNER JOIN boats
ON fishing_trips.boat_id=boats.boat_id");

while($trip=mysqli_fetch_assoc($trips))
{
    $selected=($trip['trip_id']==$catch['trip_id']) ? "selected" : "";

    echo "<option value='".$trip['trip_id']."' $selected>
    Trip ".$trip['trip_id']." - ".$trip['boat_name']."
    </option>";
}

?>

</select>

</div>

<div class="form-group">
<label>Fish Type</label>
<input type="text" name="fish_type"
value="<?php echo $catch['fish_type']; ?>" required>
</div>

<div class="form-group">
<label>Quantity (Kg)</label>
<input type="number" step="0.01" name="quantity"
value="<?php echo $catch['quantity']; ?>" required>
</div>

<div class="form-group">

<label>Quality Grade</label>

<select name="quality_grade">

<option value="A" <?php if($catch['quality_grade']=="A") echo "selected"; ?>>Grade A</option>

<option value="B" <?php if($catch['quality_grade']=="B") echo "selected"; ?>>Grade B</option>

<option value="C" <?php if($catch['quality_grade']=="C") echo "selected"; ?>>Grade C</option>

</select>

</div>

<div class="form-group">
<label>Estimated Value (₹)</label>
<input type="number" step="0.01"
name="estimated_value"
value="<?php echo $catch['estimated_value']; ?>" required>
</div>

<br>

<a href="view_catch.php" class="cancel">Cancel</a>

<button type="submit" name="update">
Update Catch
</button>

</form>

</div>

</body>
</html>