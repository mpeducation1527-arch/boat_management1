<?php
include("admin_auth.php");
include("db.php");

if(!isset($_GET['id']))
{
    die("Boat ID not found.");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM boats WHERE boat_id='$id'");

$boat = mysqli_fetch_assoc($result);

if(!$boat)
{
    die("Boat not found.");
}
if(isset($_POST['update']))
{
    $boat_name = $_POST['boat_name'];
    $registration_no = $_POST['registration_no'];
    $boat_type = $_POST['boat_type'];
    $engine_hp = $_POST['engine_hp'];
    $engine_brand = $_POST['engine_brand'];
    $capacity = $_POST['capacity'];
    
    $home_port = $_POST['home_port'];
    
     $notes = $_POST['notes'];

    $update = "UPDATE boats SET
        boat_name='$boat_name',
        registration_no='$registration_no',
        boat_type='$boat_type',
        engine_hp='$engine_hp',
        engine_brand='$engine_brand',
        capacity='$capacity',
       
        home_port='$home_port',
        
        notes='$notes'
        WHERE boat_id='$id'";
         if(mysqli_query($conn, $update))
    {
        echo "<script>
        alert('Boat Updated Successfully');
        window.location='view_boats.php';
        </script>";
    }
}
?>

    
  

<!DOCTYPE html>
<html>
<head>
<title>Edit Boat</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
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
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
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
    color:#3d5f7f;
    margin-bottom:8px;
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
    font-size:16px;
}

button:hover{

    background:#13a89d;
}

</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>✏ Edit Boat</h2>

</div>

<div class="form-area">

<form method="POST">

<div class="form-grid">

<div class="form-group">
<label>Boat Name</label>
<input type="text"
name="boat_name"
value="<?php echo $boat['boat_name']; ?>"
required>
</div>

<div class="form-group">
<label>Registration No.</label>
<input
type="text"
name="registration_no"
value="<?php echo $boat['registration_no']; ?>"
required>
</div>

<div class="form-group">
<label>Boat Type</label>

<select name="boat_type">
    <option value="Motorboat" <?php if($boat['boat_type']=="Motorboat") echo "selected"; ?>>Motorboat</option>

    <option value="Fishing Boat" <?php if($boat['boat_type']=="Fishing Boat") echo "selected"; ?>>Fishing Boat</option>

    <option value="Trawler" <?php if($boat['boat_type']=="Trawler") echo "selected"; ?>>Trawler</option>

    <option value="Speed Boat" <?php if($boat['boat_type']=="Speed Boat") echo "selected"; ?>>Speed Boat</option>
</select>

</div>

<div class="form-group">

<label>Engine Horsepower</label>

<input
type="number"
name="engine_hp"
value="<?php echo $boat['engine_hp']; ?>">

</div>

<div class="form-group">

<label>Engine Brand</label>

<input
type="text"
name="engine_brand"
value="<?php echo $boat['engine_brand']; ?>">

</div>

<div class="form-group">

<label>Capacity (kg)</label>

<input
type="number"
name="capacity"
value="<?php echo $boat['capacity']; ?>">

</div>




</div>

<div class="form-group">

<label>Home Port</label>

<input
type="text"
name="home_port"
value="<?php echo $boat['home_port']; ?>">

</div>



<div class="form-group full">

<label>Notes</label>

<textarea
name="notes"><?php echo $boat['notes']; ?></textarea>

</div>

</div>

<div class="buttons">

<a href="dashboard.php" class="cancel">
Cancel
</a>

<button type="submit" name="update">
Update Boat
</button>

</div>

</form>

</div>

</div>

</body>
</html>
