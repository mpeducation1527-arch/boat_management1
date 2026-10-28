
<?php
include("admin_auth.php");
include("db.php");

if(isset($_POST['submit']))
{

    $boat_name = $_POST['boat_name'];
    $registration_no = $_POST['registration_no'];
    $boat_type = $_POST['boat_type'];
    $engine_hp = $_POST['engine_hp'];
    $engine_brand = $_POST['engine_brand'];
    $capacity = $_POST['capacity'];
    
   
    $home_port = $_POST['home_port'];
    
    $notes = $_POST['notes'];

    $sql = "INSERT INTO boats
(
    boat_name,
    registration_no,
    boat_type,
    engine_hp,
    engine_brand,
    capacity,
    home_port,
    notes
)

VALUES
(
    '$boat_name',
    '$registration_no',
    '$boat_type',
    '$engine_hp',
    '$engine_brand',
    '$capacity',
    '$home_port',
    '$notes'
)";
    if(mysqli_query($conn,$sql))
    {
        echo "<script>
        alert('Boat Added Successfully');
        window.location='view_boats.php';
        </script>";
    }
    else
    {
        echo "Error : ".mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Boat</title>

<style>

**{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f4f7fc;
    padding:40px;
}

.container{
    max-width:1000px;
    margin:auto;
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.header{
    background:linear-gradient(135deg,#0066cc,#00aaff);
    color:white;
    padding:30px;
}

.header h2{
    font-size:32px;
}

.header p{
    margin-top:8px;
    opacity:0.9;
}

.form-area{
    padding:35px;
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
    margin-bottom:8px;
    font-weight:600;
    color:#333;
}

input,
select,
textarea{
    padding:12px;
    border:2px solid #e0e6ed;
    border-radius:10px;
    font-size:15px;
}

input:focus,
select:focus,
textarea:focus{
    outline:none;
    border-color:#0066cc;
}

textarea{
    height:120px;
    resize:none;
}

.full{
    grid-column:1/3;
}

.buttons{
    margin-top:30px;
    display:flex;
    justify-content:flex-end;
    gap:15px;
}

.cancel{
    padding:12px 25px;
    background:#e9ecef;
    color:#333;
    text-decoration:none;
    border-radius:10px;
    font-weight:bold;
}

button{
    padding:12px 30px;
    border:none;
    border-radius:10px;
    background:#0066cc;
    color:white;
    font-size:16px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#0052a3;
}
    


  



</style>

</head>

<body>

<div class="container">

<div class="header">

<h2>🚤 Boat Management System</h2>
<p style="color:white;margin-top:10px;">
Add New Boat Details
</p>

</div>

<div class="form-area">

<form method="POST">

<div class="form-grid">

<div class="form-group">
<label>Boat Name</label>
<input type="text" name="boat_name" placeholder="e.g. Blue Horizon" required>
</div>

<div class="form-group">
<label>Registration No.</label>
<input type="text" name="registration_no" placeholder="e.g. MFV-2024-001" required>
</div>

<div class="form-group">
<label>Boat Type</label>

<select name="boat_type">

<option>Motorboat</option>
<option>Fishing Boat</option>
<option>Trawler</option>
<option>Speed Boat</option>

</select>

</div>

<div class="form-group">

<label>Engine Horsepower</label>

<input type="number"
name="engine_hp"
placeholder="150">

</div>

<div class="form-group">

<label>Engine Brand</label>

<input type="text"
name="engine_brand"
placeholder="e.g. Yamaha">

</div>

<div class="form-group">

<label>Capacity (kg)</label>

<input type="number"
name="capacity"
placeholder="2000">

</div>





<div class="form-group">

<label>Home Port</label>

<input
type="text"
name="home_port"
placeholder="e.g. Mangalore Harbour">

</div>



<div class="form-group full">

<label>Notes</label>

<textarea
name="notes"
placeholder="Additional information..."></textarea>

</div>

</div>

<div class="buttons">

<a href="dashboard.php" class="cancel">
Cancel
</a>

<button type="submit" name="submit">
Save Boat
</button>

</div>

</form>

</div>

</div>

</body>
</html>
