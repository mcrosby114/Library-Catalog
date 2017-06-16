<?php
	if(!isset($_SESSION)) session_start();
	if(!isset($_SESSION['successReturn'])){
    header("Location:libreturn.php");
  }
	$message = $_SESSION['successReturn'];
	unset($_SESSION['successReturn']);
?>

<?php
	$thisPage = 'Success';
	require_once("php_includes/header.php");
?>

<body>
  <div class="success-pg-background" id="signup-success">
    <p><?=$message?></p>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>