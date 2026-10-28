<?php

include("db.php");

if(isset($_POST['submit']))
{

    $catch_date = $_POST['catch_date'];
    $trip_id = $_POST['trip_id'];
    $fish_type = $_POST['fish_type'];
    $quantity = $_POST['quantity'];
    $quality_grade = $_POST['quality_grade'];
    $estimated_value = $_POST['estimated_value'];


    $sql = "INSERT INTO catch_records
    (
        catch_date,
        trip_id,
        fish_type,
        quantity,
        quality_grade,
        estimated_value
    )
    VALUES
    (
        '$catch_date',
        '$trip_id',
        '$fish_type',
        '$quantity',
        '$quality_grade',
        '$estimated_value'
    )";


    if(mysqli_query($conn,$sql))
    {

        echo "<script>

        alert('Catch Record Added Successfully');

        window.location='view_catch.php';

        </script>";

        exit();

    }
    else
    {

        echo "<h2>Error</h2>";

        echo "<p style='color:red;'>";
        echo mysqli_error($conn);
        echo "</p>";

    }

}

?>


<!DOCTYPE html>
<html>

<head>

<title>Add Catch Record</title>

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
    width:650px;
    margin:auto;
    background:white;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
    padding:35px;
}

h2{
    color:#1d3557;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    font-weight:bold;
    margin-bottom:8px;
    color:#3d5f7f;
}

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

.buttons{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
    gap:12px;
}

.cancel{
    padding:12px 25px;
    background:#ddd;
    color:#222;
    text-decoration:none;
    border-radius:8px;
}

button{
    padding:12px 25px;
    background:#18c4b8;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:hover{
    background:#13a89d;
}

</style>

</head>

<body>


<div class="container">

<h2>🐟 Add Catch Record</h2>


<form method="POST">


<div class="form-group">

<label>Catch Date *</label>

<input
type="date"
name="catch_date"
required>

</div>


<div class="form-group">

<label>Fishing Trip *</label>

<select name="trip_id" required>

<option value="">
Select Fishing Trip
</option>


<?php

$trips = mysqli_query(
    $conn,
    "SELECT trip_id, departure_date, boat_id
     FROM fishing_trips
     ORDER BY trip_id DESC"
);

while($trip = mysqli_fetch_assoc($trips))
{

?>

<option value="<?php echo $trip['trip_id']; ?>">

TR<?php echo $trip['trip_id']; ?>

</option>

<?php

}

?>

</select>

</div>


<div class="form-group">

<label>Fish Type *</label>

<input
type="text"
name="fish_type"
placeholder="Example: Tuna"
required>

</div>


<div class="form-group">

<label>Quantity (kg) *</label>

<input
type="number"
step="0.01"
name="quantity"
placeholder="Example: 150"
required>

</div>


<div class="form-group">

<label>Quality Grade *</label>

<select name="quality_grade" required>

<option value="">
Select Quality
</option>

<option value="A">
A - Excellent
</option>

<option value="B">
B - Good
</option>

<option value="C">
C - Average
</option>

</select>

</div>


<div class="form-group">

<label>Estimated Value (₹) *</label>

<input
type="number"
step="0.01"
name="estimated_value"
placeholder="Example: 45000"
required>

</div>


<div class="buttons">

<a href="view_catch.php" class="cancel">
Cancel
</a>

<button type="submit" name="submit">
Save Catch
</button>

</div>


</form>

</div>

</body>

</html>