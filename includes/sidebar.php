s<div class="sidebar">

<h2>🚢 Boat Management</h2>

<!-- Dashboard -->
<a href="dashboard.php">🏠 Dashboard</a>


<!-- Admin Only -->
<?php if($_SESSION['role']=="admin") { ?>

<a href="view_boats.php">🚤 Boat Management</a>

<a href="view_crew.php">👨‍✈️ Crew Management</a>

<?php } ?>


<!-- Fishing Trips -->
<a href="fishing_trips.php">🎣 Fishing Trips</a>


<!-- Catch Records -->
<a href="view_catch.php">🐟 Catch Records</a>


<!-- Admin Only Modules -->
<?php if($_SESSION['role']=="admin") { ?>

<a href="view_sales.php">💰 Sales</a>

<a href="view_maintenance.php">🛠 Maintenance</a>

<a href="view_expenses.php">💸 Expenses</a>

<a href="profit_loss.php">📊 Finance</a>

<a href="reports.php">📈 Reports</a>

<?php } ?>


<!-- About -->
<a href="about.php">ℹ About</a>

<hr>

<!-- Change Password -->
<a href="change_password.php">🔑 Change Password</a>

<!-- Logout -->
<a href="logout.php">🚪 Logout</a>

</div>