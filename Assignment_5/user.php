<?php
session_start();

echo "<h1> Welcome, User" .PHP_EOL. "{$_SESSION['username']} </h1>";

?>
<?php include('header.php'); ?>
<a href="logout.php" class="btn btn-primary " > Logout </a>
<?php include('footer.php'); ?>
