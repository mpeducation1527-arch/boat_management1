<?php
include("admin_auth.php");
include("db.php");

if(isset($_POST['submit']))
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

    $sql = "INSERT INTO crew
    (
        full_name,
        role,
        assigned_boat,
        profit_share,
        phone,
        license_no,
        emergency_contact,
        hire_date,
        salary
    )
    VALUES
    (
        '$full_name',
        '$role',
        '$assigned_boat',
        '$profit_share',
        '$phone',
        '$license_no',
        '$emergency_contact',
        '$hire_date',
        '$salary'
    )";
if(mysqli_query($conn,$sql))
{
    echo "<script>
    alert('Crew Member Added Successfully');
    window.location='view_crew.php';
    </script>";
}
else
{
    echo "<script>
    alert('Error: ".mysqli_error($conn)."');
    </script>";
}
   
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Add Crew Member</title>

<style>

body{
    margin:0;
    padding:40px;
    background:#eef5fb;
    font-family:Arial,sans-serif;
}

.container{
    width:900px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

h2{
    color:#003366;
    margin-bottom:30px;
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

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

button{
    background:#18c4b8;
    color:white;
    border:none;
    padding:12px 25px;
    border-radius:8px;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#13a89d;
}

.cancel{
    background:#ddd;
    color:black;
    padding:12px 25px;
    text-decoration:none;
    border-radius:8px;
    margin-left:10px;
}

</style>
</head>

<body>

<div class="container">

<h2>👥 Add Crew Member</h2>

<form method="POST">

<div class="form-row">

<div class="form-group">
<label>👤 Full Name</label>
<input
type="text"
name="full_name"
required
pattern="[A-Za-z ]+"
title="Only alphabets and spaces are allowed">
</div>

<div class="form-group">
<label>👨‍✈️ Role</label>

<select name="role" required>
<option value="">Select Role</option>
<option>Captain</option>
<option>Engineer</option>
<option>Deckhand</option>
<option>Navigator</option>
<option>Cook</option>
<option>Crew Member</option>
</select>

</div>

</div>



<div class="form-row">

<div class="form-group">

<label>🚢 Assigned Boat</label>

<select name="assigned_boat">

<option value="">Select Boat</option>

<?php

$boats=mysqli_query($conn,"SELECT * FROM boats ORDER BY boat_name");

while($boat=mysqli_fetch_assoc($boats))
{
?>

<option value="<?php echo $boat['boat_id']; ?>">
<?php echo $boat['boat_name']; ?>
</option>

<?php
}
?>

</select>

</div>

<div class="form-group">

<label>💰 Profit Share (%)</label>

<input
type="number"
name="profit_share"
step="0.01"
min="0"
max="100"
placeholder="0 - 100"
required>

</div>

</div>



<div class="form-row">

<div class="form-group">

<label>📞 Phone</label>
<input
type="tel"
name="phone"
required
pattern="[0-9]{10}"
maxlength="10"
placeholder="9876543210"
title="Enter a valid 10-digit phone number">


</div>

<div class="form-group">

<label>🪪 License No.</label>

<input
type="text"
name="license_no"
maxlength="20"
placeholder="LIC12345"
required>

</div>

</div>



<div class="form-row">

<div class="form-group">

<label>🚨 Emergency Contact</label>

<input
type="tel"
name="emergency_contact"
required
pattern="[0-9]{10}"
maxlength="10"
placeholder="9876543210"
title="Enter a valid 10-digit emergency contact">

</div>

<div class="form-group">

<label>📅 Hire Date</label>

<input
type="date"
name="hire_date"
required
max="<?php echo date('Y-m-d'); ?>">

</div>

</div>



<div class="form-row">

<div class="form-group">

<label>💵 Salary (₹)</label>

<input
type="number"
step="0.01"
name="salary"
required
min="0"
placeholder="Enter salary">

</div>

</div>

<br>

<button type="submit" name="submit">
Save Crew Member
</button>

<a href="view_crew.php" class="cancel">
Cancel
</a>

</form>

</div>
<script>

document.querySelector("form").addEventListener("submit",function(e){

let phone=document.getElementsByName("phone")[0].value;

let emergency=document.getElementsByName("emergency_contact")[0].value;

if(phone.length!=10){

alert("Phone number must be exactly 10 digits.");

e.preventDefault();

return;

}

if(emergency.length!=10){

alert("Emergency Contact must be exactly 10 digits.");

e.preventDefault();

return;

}

});

</script>

</body>
</html>