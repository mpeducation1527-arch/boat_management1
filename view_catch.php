<?php

include("db.php");

$sql = "SELECT catch_records.*, fishing_trips.trip_id
        FROM catch_records
        JOIN fishing_trips
        ON catch_records.trip_id = fishing_trips.trip_id
        ORDER BY catch_id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

<title>Catch Records</title>

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

h2{
    color:#1d3557;
}

.btn{
    background:#18c4b8;
    color:white;
    padding:12px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    text-decoration:none;
    font-size:15px;
}

.btn:hover{
    background:#13a89d;
}

.search{
    margin-bottom:20px;
}

.search input{
    width:350px;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
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

</style>

</head>

<body>


<div class="container">


<div class="top-bar">

<h2>🐟 Catch Records</h2>

<a href="add_catch.php" class="btn">
+ Add Catch
</a>

</div>


<div class="search">

<input
type="text"
id="search"
placeholder="Search catch records...">

</div>


<table id="catchTable">

<tr>

<th>ID</th>
<th>Date</th>
<th>Trip</th>
<th>Fish Type</th>
<th>Quantity (kg)</th>
<th>Quality</th>
<th>Estimated Value (₹)</th>
<th>Actions</th>

</tr>


<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td>
CR<?php echo $row['catch_id']; ?>
</td>

<td>
<?php echo $row['catch_date']; ?>
</td>

<td>
TR<?php echo $row['trip_id']; ?>
</td>

<td>
<?php echo htmlspecialchars($row['fish_type']); ?>
</td>

<td>
<?php echo number_format($row['quantity'],2); ?>
</td>

<td>
<?php echo htmlspecialchars($row['quality_grade']); ?>
</td>

<td>
₹ <?php echo number_format($row['estimated_value'],2); ?>
</td>

<td>

<a
class="edit"
href="edit_catch.php?id=<?php echo $row['catch_id']; ?>">

✏

</a>

<a
class="delete"
href="delete_catch.php?id=<?php echo $row['catch_id']; ?>"
onclick="return confirm('Delete this catch record?')">

🗑

</a>

</td>

</tr>

<?php

}

?>

</table>

</div>


<script>

document.getElementById("search")
.addEventListener("keyup", function()
{

    let value = this.value.toLowerCase();

    let rows =
    document.querySelectorAll("#catchTable tr");

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