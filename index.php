<?php
	//Redirect if user IS logged in
  if(!isset($_SESSION)) session_start();
  if(isset($_SESSION['access_granted']) && $_SESSION['access_granted']) {
    header("Location: grid.php");
    die;
  }
?>

<?php $thisPage = 'Welcome'; ?>

<?php require_once("php_includes/header.php"); ?>

  <body>
      <div class="bodysection" id="sec1">
        <h1>Welcome to the Library Information System</h1>
        <h2>Use the navigation menu above to: </h2>
        <ul>
          <li>Add a book</li>
          <li>Find a book</li>
          <li>Check out a book</li>
          <li>Return a book</li>
          <li>Inquire about a borrower's status</li>
        </ul>
        <h4>Click an item above to begin.</h4>
      </div>
    </body>

  <?php require_once("php_includes/footer.php"); ?>
