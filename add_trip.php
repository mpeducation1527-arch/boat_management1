<?php

include("db.php");

if(isset($_POST['submit']))
{

    $boat_id = $_POST['boat_id'];
    $captain_name = $_POST['captain_name'];

    $departure_date = $_POST['departure_date'];
    $return_date = !empty($_POST['return_date'])
                    ? $_POST['return_date']
                    : NULL;

    $destination = $_POST['destination'];
    $fuel_used = !empty($_POST['fuel_used'])
                 ? $_POST['fuel_used']
                 : 0;

    $trip_status = $_POST['trip_status'];
    $remarks = $_POST['remarks'];


    $sql = "INSERT INTO fishing_trips
    (
        boat_id,
        captain_name,
        departure_date,
        return_date,
        destination,
        fuel_used,
        trip_status,
        remarks
    )
    VALUES
    (
        '$boat_id',
        '$captain_name',
        '$departure_date',
        " . ($return_date ? "'$return_date'" : "NULL") . ",
        '$destination',
        '$fuel_used',
        '$trip_status',
        '$remarks'
    )";


    if(mysqli_query($conn, $sql))
    {

        echo "<script>

        alert('Fishing Trip Added Successfully');

        window.location='fishing_trips.php';

        </script>";

        exit();

    }
    else
    {

        echo "<h2>Fishing Trip Error</h2>";

        echo "<p style='color:red;'>";
        echo mysqli_error($conn);
        echo "</p>";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Fishing Trip</title>

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
    width:800px;
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
    text-decoration:none;
    padding:12px 25px;
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

<h2>🎣 Add Fishing Trip</h2>

</div>


<div class="form-area">

<form method="POST">

<div class="form-grid">


<!-- BOAT -->

<div class="form-group">

<label>Select Boat *</label>

<select name="boat_id" required>

<option value="">Select Boat</option>

<?php

$boats = mysqli_query(
    $conn,
    "SELECT boat_id, boat_name FROM boats ORDER BY boat_name"
);

while($boat = mysqli_fetch_assoc($boats))
{

?>

<option value="<?php echo $boat['boat_id']; ?>">

<?php echo htmlspecialchars($boat['boat_name']); ?>

</option>

<?php

}

?>

</select>

</div>


<!-- CAPTAIN -->

<div class="form-group">

<label>Captain Name *</label>

<input
type="text"
name="captain_name"
placeholder="Enter captain name"
required>

</div>


<!-- DEPARTURE -->

<div class="form-group">

<label>Departure Date *</label>

<input
type="date"
name="departure_date"
required>

</div>


<!-- RETURN -->

<div class="form-group">

<label>Return Date</label>

<input
type="date"
name="return_date">

</div>


<!-- DESTINATION -->

<div class="form-group">

<label>Destination / Fishing Zone</label>

<input
type="text"
name="destination"
placeholder="Example: Arabian Sea">

</div>


<!-- FUEL -->

<div class="form-group">

<label>Fuel Used (Litres)</label>

<input
type="number"
step="0.01"
name="fuel_used"
placeholder="Example: 80">

</div>


<!-- STATUS -->

<div class="form-group">

<label>Trip Status</label>

<select name="trip_status">

<option value="Planned">Planned</option>

<option value="Ongoing">Ongoing</option>

<option value="Completed">Completed</option>

<option value="Cancelled">Cancelled</option>

</select>

</div>


<!-- REMARKS -->

<div class="form-group full">

<label>Remarks</label>

<textarea
name="remarks"
placeholder="Enter trip remarks"></textarea>

</div>


</div>


<div class="buttons">

<a href="fishing_trips.php" class="cancel">
Cancel
</a>

<button
type="submit"
name="submit">

Save Trip

</button>

</div>


</form>

</div>

</div>

</body>

</html>