<?php

session_start();

include 'db.php';

$result = mysqli_query($conn,"
SELECT crew.*, boats.boat_name
FROM crew
LEFT JOIN boats
ON crew.assigned_boat = boats.boat_id
ORDER BY crew_id DESC
");

?>

<!DOCTYPE html>
<html>
<head>

<title>View Crew</title>

<style>

body{
    font-family:Arial;
    background:#eaf4ff;
    padding:30px;
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.top-bar h2{
    margin:0;
}

.add-btn{
    background:#0077b6;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.add-btn:hover{
    background:#023e8a;
}

table{
    width:100%;
    background:white;
    border-collapse:collapse;
}

th{
    background:#003366;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border:1px solid #ddd;
}

tr:hover{
    background:#f2f8ff;
}

.edit-btn{
    color:#0077b6;
    text-decoration:none;
    font-weight:bold;
}

.delete-btn{
    color:red;
    text-decoration:none;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="top-bar">

    <h2>👨‍✈️ Crew List</h2>

    <?php if($_SESSION['role'] == "admin") { ?>

        <a href="add_crew.php" class="add-btn">
            + Add Crew
        </a>

    <?php } ?>

</div>


<table>

<tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Role</th>
    <th>Boat</th>
    <th>Profit %</th>
    <th>Phone</th>
    <th>License No.</th>
    <th>Emergency Contact</th>
    <th>Hire Date</th>
    <th>Salary (₹)</th>
    <th>Action</th>
</tr>


<?php

while($row = mysqli_fetch_assoc($result))
{

?>

<tr>

<td>
    <?php echo $row['crew_id']; ?>
</td>

<td>
    <?php echo $row['full_name']; ?>
</td>

<td>
    <?php echo $row['role']; ?>
</td>

<td>
    <?php echo $row['boat_name']; ?>
</td>

<td>
    <?php echo $row['profit_share']; ?>%
</td>

<td>
    <?php echo $row['phone']; ?>
</td>

<td>
    <?php echo $row['license_no']; ?>
</td>

<td>
    <?php echo $row['emergency_contact']; ?>
</td>

<td>
    <?php echo $row['hire_date']; ?>
</td>

<td>
    ₹ <?php echo number_format($row['salary'],2); ?>
</td>

<td>

    <?php if($_SESSION['role'] == "admin") { ?>

        <a
        href="edit_crew.php?id=<?php echo $row['crew_id']; ?>"
        class="edit-btn">
        ✏ Edit
        </a>

        |

        <a
        href="delete_crew.php?id=<?php echo $row['crew_id']; ?>"
        class="delete-btn"
        onclick="return confirm('Delete this crew member?')">
        🗑 Delete
        </a>

    <?php } else { ?>

        View Only

    <?php } ?>

</td>

</tr>

<?php

}

?>

</table>

</body>
</html>