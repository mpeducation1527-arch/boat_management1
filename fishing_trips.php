<?php

include("db.php");

$sql = "SELECT fishing_trips.*, boats.boat_name
        FROM fishing_trips
        JOIN boats ON fishing_trips.boat_id = boats.boat_id
        ORDER BY trip_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Fishing Trips</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#eef5fb;
    padding:30px;
}

.container{
    width:95%;
    margin:auto;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.top-bar h2{
    color:#1d3557;
}

.search-area{
    margin-bottom:20px;
}

.search-area input{
    width:350px;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

.btn{
    background:#18c4b8;
    color:white;
    padding:12px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:15px;
}

.btn:hover{
    background:#13a89d;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.1);
}

th{
    background:#f5f7fa;
    padding:15px;
    text-align:left;
}

td{
    padding:15px;
    border-top:1px solid #eee;
}

.active{
    background:#dff8e8;
    color:green;
    padding:5px 12px;
    border-radius:20px;
}

.completed{
    background:#dff6ff;
    color:#0077cc;
    padding:5px 12px;
    border-radius:20px;
}

.cancelled{
    background:#ffe3e3;
    color:red;
    padding:5px 12px;
    border-radius:20px;
}

.edit,
.delete{
    padding:7px 12px;
    text-decoration:none;
    border-radius:6px;
}

.edit{
    background:#dff1ff;
    color:#0066cc;
}

.delete{
    background:#ffe4e4;
    color:red;
}

.modal{
    display:none;
    position:fixed;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.45);
    justify-content:center;
    align-items:center;
}

.modal-content{
    background:white;
    width:700px;
    border-radius:15px;
    padding:25px;
}

.modal-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.close{
    font-size:30px;
    cursor:pointer;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.grid input,
.grid select,
.grid textarea{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
}

.grid label{
    display:block;
    margin-bottom:6px;
}

.full{
    grid-column:1/3;
}

.buttons{
    margin-top:20px;
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

.cancel{
    padding:10px 20px;
    background:#ddd;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

</style>

</head>


<body>


<div class="container">


<div class="top-bar">

<h2>🎣 Fishing Trips</h2>

<button class="btn" id="openModal">
+ Log Trip
</button>

</div>


<div class="search-area">

<input
type="text"
id="searchTrip"
placeholder="Search trips...">

</div>


<table id="tripTable">

<tr>

<th>Trip ID</th>
<th>Departure Date</th>
<th>Return Date</th>
<th>Boat</th>
<th>Captain</th>
<th>Destination</th>
<th>Fuel Used</th>
<th>Status</th>
<th>Actions</th>

</tr>


<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td>
TR<?php echo $row['trip_id']; ?>
</td>

<td>
<?php echo $row['departure_date']; ?>
</td>

<td>
<?php echo $row['return_date'] ? $row['return_date'] : '-'; ?>
</td>

<td>
<?php echo htmlspecialchars($row['boat_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['captain_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($row['destination']); ?>
</td>

<td>
<?php echo number_format($row['fuel_used'],2); ?> L
</td>

<td>

<?php

$status = strtolower($row['trip_status']);

if($status == "planned" || $status == "ongoing")
{

    echo "<span class='active'>".$row['trip_status']."</span>";

}
elseif($status == "completed")
{

    echo "<span class='completed'>Completed</span>";

}
else
{

    echo "<span class='cancelled'>".$row['trip_status']."</span>";

}

?>

</td>


<td>

<a
class="edit"
href="edit_trip.php?id=<?php echo $row['trip_id']; ?>">

✏

</a>

<a
class="delete"
href="delete_trip.php?id=<?php echo $row['trip_id']; ?>"
onclick="return confirm('Delete this trip?')">

🗑

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>



<!-- LOG TRIP POPUP -->

<div id="tripModal" class="modal">


<div class="modal-content">


<div class="modal-header">

<h2>🎣 Log Fishing Trip</h2>

<span class="close">&times;</span>

</div>


<form action="add_trip.php" method="POST">


<div class="grid">


<!-- Departure Date -->

<div>

<label>Departure Date *</label>

<input
type="date"
name="departure_date"
required>

</div>


<!-- Return Date -->

<div>

<label>Return Date</label>

<input
type="date"
name="return_date">

</div>


<!-- Boat -->

<div>

<label>Boat *</label>

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


<!-- Captain -->

<div>

<label>Captain *</label>

<input
type="text"
name="captain_name"
placeholder="Enter captain name"
required>

</div>


<!-- Destination -->

<div>

<label>Destination / Fishing Zone</label>

<input
type="text"
name="destination"
placeholder="Example: Arabian Sea">

</div>


<!-- Fuel -->

<div>

<label>Fuel Used (Litres)</label>

<input
type="number"
step="0.01"
name="fuel_used"
placeholder="Example: 80">

</div>


<!-- Status -->

<div>

<label>Status</label>

<select name="trip_status">

<option value="Planned">
Planned
</option>

<option value="Ongoing">
Ongoing
</option>

<option value="Completed">
Completed
</option>

<option value="Cancelled">
Cancelled
</option>

</select>

</div>


<!-- Remarks -->

<div class="full">

<label>Remarks</label>

<textarea
name="remarks"
rows="4"
placeholder="Enter trip remarks"></textarea>

</div>


</div>


<div class="buttons">


<button
type="button"
class="cancel"
id="closeModal">

Cancel

</button>


<button
type="submit"
name="submit"
class="btn">

Save Trip

</button>


</div>


</form>


</div>

</div>



<script>

const modal = document.getElementById("tripModal");

const openModal = document.getElementById("openModal");

const closeModal = document.querySelector(".close");

const cancelModal = document.getElementById("closeModal");


openModal.onclick = function()
{
    modal.style.display = "flex";
};


closeModal.onclick = function()
{
    modal.style.display = "none";
};


cancelModal.onclick = function()
{
    modal.style.display = "none";
};


window.onclick = function(event)
{

    if(event.target == modal)
    {
        modal.style.display = "none";
    }

};


document.getElementById("searchTrip")
.addEventListener("keyup", function()
{

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll("#tripTable tr");

    rows.forEach(function(row,index)
    {

        if(index == 0)
        {
            return;
        }

        row.style.display =
        row.innerText.toLowerCase().includes(value)
        ? ""
        : "none";

    });

});

</script>


</body>

</html>