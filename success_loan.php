<?php
	if(!isset($_SESSION)) session_start();
	if(!isset($_SESSION['successLoan'])){
    header("Location:libloan.php");
  }
	$message = $_SESSION['successLoan'];
	unset($_SESSION['successLoan']);
?>

<?php
	$thisPage = 'Success';
	require_once("php_includes/header.php");
?>

<body>
  <div class="success-pg-background" id="signup-success">
    <p>Success! "<span class='underline'><?=$message['bookTitle']?></span>" has been checked out by <span class='underline'><?=$message['borrowerName']?></span>.</p>
    <p>Your book is due on <span class='underline'><?=$message['dueDate']?></span> at branch location: <span class='underline'><?=$message['branchName']?></span>.</p>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>