<?php
session_start();


echo "<h1> Welcome, Manager" .PHP_EOL. "{$_SESSION['username']} </h1>";

?>
<?php include('header.php'); ?>
<a href="logout.php" class="btn btn-danger " > Logout </a>
<?php include('footer.php'); ?>