<?php
include("db.php");

if(!isset($_GET['id']))
{
    die("Trip ID not found.");
}

$id = isset($_GET['id']) ? $_GET['id'] : 0;

$result = mysqli_query($conn,"SELECT * FROM fishing_trips WHERE trip_id=$id");
$trip = mysqli_fetch_assoc($result);

if(!$trip)
{
    die("Trip not found.");
}

if(isset($_POST['update']))
{
    $boat_id = $_POST['boat_id'];
    $captain_name = $_POST['captain_name'];
    $departure_date = $_POST['departure_date'];
    $return_date = $_POST['return_date'];
    $destination = $_POST['destination'];
    $fuel_used = $_POST['fuel_used'];
    $trip_status = $_POST['trip_status'];
    $remarks = $_POST['remarks'];

    $sql = "UPDATE fishing_trips SET
        boat_id='$boat_id',
        captain_name='$captain_name',
        departure_date='$departure_date',
        return_date='$return_date',
        destination='$destination',
        fuel_used='$fuel_used',
        trip_status='$trip_status',
        remarks='$remarks'
        WHERE trip_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Trip Updated Successfully');
        window.location='view_trips.php';
        </script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Edit Fishing Trip</title>

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
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
    overflow:hidden;
}

.header{
    padding:25px 35px;
    border-bottom:1px solid #ddd;
}

.header h2{
    color:#1b2b45;
}

.form-area{
    padding:30px 35px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.form-group{
    display:flex;
    flex-direction:column;
}

label{
    font-weight:bold;
    margin-bottom:8px;
    color:#3d5f7f;
}

input,
select,
textarea{
    width:100%;
    padding:12px;
    border:1px solid #cfd8e3;
    border-radius:8px;
    font-size:15px;
}

textarea{
    resize:none;
    height:100px;
}

.full{
    grid-column:1/3;
}

.buttons{
    margin-top:25px;
    display:flex;
    justify-content:flex-end;
    gap:15px;
}

.cancel{
    background:#e8eef5;
    color:#222;
    padding:12px 25px;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
}

button{
    background:#18c4b8;
    color:white;
    border:none;
    padding:12px 30px;
    border-radius:8px;
    cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<div class="header">
<h2>✏ Edit Fishing Trip</h2>
</div>

<div class="form-area">

<form method="POST">

<div class="form-grid">

<div class="form-group">

<label>Boat</label>

<select name="boat_id">

<?php

$boats=mysqli_query($conn,"SELECT * FROM boats");

while($boat=mysqli_fetch_assoc($boats))
{
    $selected=($boat['boat_id']==$trip['boat_id'])?"selected":"";

    echo "<option value='".$boat['boat_id']."' $selected>".$boat['boat_name']."</option>";
}

?>

</select>

</div>

<div class="form-group">
<label>Captain Name</label>
<input type="text" name="captain_name" value="<?php echo $trip['captain_name']; ?>" required>
</div>

<div class="form-group">
<label>Departure Date</label>
<input type="date" name="departure_date" value="<?php echo $trip['departure_date']; ?>">
</div>

<div class="form-group">
<label>Return Date</label>
<input type="date" name="return_date" value="<?php echo $trip['return_date']; ?>">
</div>

<div class="form-group">
<label>Destination</label>
<input type="text" name="destination" value="<?php echo $trip['destination']; ?>">
</div>

<div class="form-group">
<label>Fuel Used (L)</label>
<input type="number" step="0.01" name="fuel_used" value="<?php echo $trip['fuel_used']; ?>">
</div>

<div class="form-group">

<label>Status</label>

<select name="trip_status">

<option value="Planned" <?php if($trip['trip_status']=="Planned") echo "selected"; ?>>Planned</option>

<option value="Ongoing" <?php if($trip['trip_status']=="Ongoing") echo "selected"; ?>>Ongoing</option>

<option value="Completed" <?php if($trip['trip_status']=="Completed") echo "selected"; ?>>Completed</option>

<option value="Cancelled" <?php if($trip['trip_status']=="Cancelled") echo "selected"; ?>>Cancelled</option>

</select>

</div>

<div class="form-group full">

<label>Remarks</label>

<textarea name="remarks"><?php echo $trip['remarks']; ?></textarea>

</div>

</div>

<div class="buttons">

<a href="view_trips.php" class="cancel">Cancel</a>

<button type="submit" name="update">Update Trip</button>

</div>

</form>

</div>

</div>

</body>
</html>