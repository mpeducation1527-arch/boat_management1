<?php
include("db.php");

if(!isset($_GET['id']))
{
    die("Crew ID not found.");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM crew WHERE crew_id='$id'");
$row = mysqli_fetch_assoc($result);

if(!$row)
{
    die("Crew Member not found.");
}

if(isset($_POST['update']))
{
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    $assigned_boat = $_POST['assigned_boat'];
    $profit_share = $_POST['profit_share'];
    $phone = $_POST['phone'];
    $license_no = $_POST['license_no'];
    $emergency_contact = $_POST['emergency_contact'];
    $hire_date = $_POST['hire_date'];
    $salary = $_POST['salary'];

    mysqli_query($conn,"
    UPDATE crew SET
    full_name='$full_name',
    role='$role',
    assigned_boat='$assigned_boat',
    profit_share='$profit_share',
    phone='$phone',
    license_no='$license_no',
    emergency_contact='$emergency_contact',
    hire_date='$hire_date',
    salary='$salary'
    WHERE crew_id='$id'
    ");

    echo "<script>
    alert('Crew Updated Successfully');
    window.location='view_crew.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Crew</title>

<style>
body{
    background:#eef5fb;
    font-family:Arial;
}

.container{
    width:850px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
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

.cancel{
    background:#ccc;
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

<h2>✏ Edit Crew Member</h2>

<form method="POST">

<div class="form-row">

<div class="form-group">
<label>Full Name</label>
<input type="text" name="full_name"
value="<?php echo $row['full_name']; ?>" required>
</div>

<div class="form-group">
<label>Role</label>

<select name="role">

<option <?php if($row['role']=="Captain") echo "selected"; ?>>Captain</option>
<option <?php if($row['role']=="Engineer") echo "selected"; ?>>Engineer</option>
<option <?php if($row['role']=="Deckhand") echo "selected"; ?>>Deckhand</option>
<option <?php if($row['role']=="Navigator") echo "selected"; ?>>Navigator</option>
<option <?php if($row['role']=="Cook") echo "selected"; ?>>Cook</option>
<option <?php if($row['role']=="Crew Member") echo "selected"; ?>>Crew Member</option>

</select>

</div>

</div>

<div class="form-row">

<div class="form-group">

<label>Assigned Boat</label>

<select name="assigned_boat">

<?php
$boats=mysqli_query($conn,"SELECT * FROM boats");

while($boat=mysqli_fetch_assoc($boats))
{
?>

<option value="<?php echo $boat['boat_id'];?>"

<?php
if($boat['boat_id']==$row['assigned_boat'])
echo "selected";
?>

>

<?php echo $boat['boat_name'];?>

</option>

<?php
}
?>

</select>

</div>

<div class="form-group">
<label>Profit Share (%)</label>
<input type="number" step="0.01"
name="profit_share"
value="<?php echo $row['profit_share']; ?>">
</div>

</div>

<div class="form-row">

<div class="form-group">
<label>Phone</label>
<input type="text"
name="phone"
value="<?php echo $row['phone']; ?>">
</div>

<div class="form-group">
<label>License No.</label>
<input type="text"
name="license_no"
value="<?php echo $row['license_no']; ?>">
</div>

</div>

<div class="form-row">

<div class="form-group">
<label>Emergency Contact</label>
<input type="text"
name="emergency_contact"
value="<?php echo $row['emergency_contact']; ?>">
</div>

<div class="form-group">
<label>Hire Date</label>
<input type="date"
name="hire_date"
value="<?php echo $row['hire_date']; ?>">
</div>

</div>

<div class="form-row">

<div class="form-group">
<label>Salary (₹)</label>
<input type="number"
step="0.01"
name="salary"
value="<?php echo $row['salary']; ?>">
</div>

</div>

<button type="submit" name="update">
Update Crew
</button>

<a href="view_crew.php" class="cancel">
Cancel
</a>

</form>

</div>

</body>
</html>