<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Maintenance ID not found.");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM maintenance WHERE maintenance_id='$id'");
$data = mysqli_fetch_assoc($result);

if(!$data)
{
    die("Record not found.");
}

if(isset($_POST['update']))
{
    $maintenance_date = $_POST['maintenance_date'];
    $boat_id = $_POST['boat_id'];
    $service_type = $_POST['service_type'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    $mechanic = $_POST['mechanic'];
    $next_service = $_POST['next_service'];

    $sql = "UPDATE maintenance SET
            maintenance_date='$maintenance_date',
            boat_id='$boat_id',
            service_type='$service_type',
            cost='$cost',
            description='$description',
            mechanic='$mechanic',
            next_service='$next_service'
            WHERE maintenance_id='$id'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Maintenance Updated Successfully');
        window.location='view_maintenance.php';
        </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Maintenance</title>

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
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
    color:#003366;
    margin-bottom:20px;
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
    font-weight:bold;
    margin-bottom:8px;
}

input,
select,
textarea{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    box-sizing:border-box;
}

textarea{
    height:100px;
    resize:none;
}

button{
    background:#28a745;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

.cancel{
    background:#ccc;
    color:black;
    padding:12px 20px;
    border-radius:8px;
    text-decoration:none;
    margin-left:10px;
}

</style>

</head>

<body>

<div class="container">

<h2>✏️ Edit Maintenance</h2>

<form method="POST">

<div class="form-row">

<div class="form-group">
<label>Date</label>
<input type="date" name="maintenance_date"
value="<?php echo $data['maintenance_date']; ?>" required>
</div>

<div class="form-group">
<label>Boat</label>

<select name="boat_id" required>

<?php

$boats=mysqli_query($conn,"SELECT * FROM boats");

while($boat=mysqli_fetch_assoc($boats))
{
?>

<option value="<?php echo $boat['boat_id']; ?>"
<?php if($boat['boat_id']==$data['boat_id']) echo "selected"; ?>>

<?php echo $boat['boat_name']; ?>

</option>

<?php
}
?>

</select>

</div>

</div>

<div class="form-row">

<div class="form-group">

<label>Service Type</label>

<input type="text"
name="service_type"
value="<?php echo $data['service_type']; ?>">

</div>

<div class="form-group">

<label>Cost</label>

<input type="number"
step="0.01"
name="cost"
value="<?php echo $data['cost']; ?>">

</div>

</div>

<label>Description</label>

<textarea name="description"><?php echo $data['description']; ?></textarea>

<div class="form-row">

<div class="form-group">

<label>Mechanic</label>

<input type="text"
name="mechanic"
value="<?php echo $data['mechanic']; ?>">

</div>

<div class="form-group">

<label>Next Service</label>

<input type="date"
name="next_service"
value="<?php echo $data['next_service']; ?>">

</div>

</div>

<br>

<button type="submit" name="update">
Update Maintenance
</button>

<a href="view_maintenance.php" class="cancel">
Cancel
</a>

</form>

</div>

</body>
</html>