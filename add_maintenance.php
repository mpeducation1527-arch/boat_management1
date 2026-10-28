<?php
include("admin_auth.php");
include("db.php");

if(isset($_POST['save']))
{
    $date = $_POST['maintenance_date'];
    $boat = $_POST['boat_id'];
    $type = $_POST['service_type'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $mechanic = $_POST['mechanic'];
    $next = $_POST['next_service'];

    mysqli_query($conn,"INSERT INTO maintenance
    (maintenance_date,boat_id,service_type,cost,description,mechanic,next_service)
    VALUES
    ('$date','$boat','$type','$cost','$description','$mechanic','$next')");

    header("Location:view_maintenance.php");
    exit();
}

$boats = mysqli_query($conn,"SELECT * FROM boats");
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Maintenance</title>

<style>

body{
    background:#eef4fb;
    font-family:Arial;
}

.container{
    width:700px;
    margin:40px auto;
    background:#fff;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.header{
    padding:20px 30px;
    border-bottom:1px solid #eee;
}

.header h2{
    margin:0;
    color:#1f2937;
}

.form{
    padding:30px;
}

.row{
    display:flex;
    gap:20px;
    margin-bottom:20px;
}

.col{
    flex:1;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:bold;
    color:#4b5563;
}

input,
select,
textarea{
    width:100%;
    padding:12px;
    border:1px solid #cbd5e1;
    border-radius:8px;
    font-size:15px;
    box-sizing:border-box;
}

textarea{
    height:100px;
    resize:none;
}

.buttons{
    text-align:right;
    margin-top:25px;
}

.save{
    background:#2ec4b6;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}

.save:hover{
    background:#24b2a5;
}

</style>

</head>

<body>

<div class="container">

<div class="header">
<h2>🔧 Log Maintenance</h2>
</div>

<form method="POST" class="form">

<div class="row">

<div class="col">
<label>Date</label>
<input type="date" name="maintenance_date" required>
</div>

<div class="col">
<label>Boat</label>

<select name="boat_id" required>

<option value="">Select Boat</option>

<?php
while($b=mysqli_fetch_assoc($boats))
{
echo "<option value='".$b['boat_id']."'>".$b['boat_name']."</option>";
}
?>

</select>

</div>

</div>

<div class="row">

<div class="col">

<label>Type</label>

<select name="service_type">

<option>Routine Service</option>
<option>Engine Repair</option>
<option>Oil Change</option>
<option>Hull Repair</option>
<option>Electrical</option>
<option>Painting</option>

</select>

</div>

<div class="col">

<label>Cost</label>

<input type="number" step="0.01" name="cost">

</div>

</div>

<label>Description</label>

<textarea name="description"></textarea>

<div class="row">

<div class="col">
<label>Mechanic / Shop</label>
<input type="text" name="mechanic">
</div>

<div class="col">
<label>Next Service Due</label>
<input type="date" name="next_service">
</div>

</div>

<div class="buttons">

<button class="save" name="save">
Save Record
</button>

</div>

</form>

</div>

</body>
</html>