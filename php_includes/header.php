<?php
  if(!isset($_SESSION)) session_start();
  date_default_timezone_set('America/Boise');
?>

<!DOCTYPE html>
<html lang=en>

<head>

  <meta charset="utf-8">
  <title>LibraryDB - <?= $thisPage; ?></title>

  <link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
  <link href="images/squares_16px_16px.png" type="image/png" rel="shortcut icon" />

  <link rel="stylesheet" href="styles/external/normalize.css" type="text/css"/>
  <link rel="stylesheet" href="styles/external/buttons.css" type="text/css"/>
  <link rel="stylesheet" href="styles/forms.css" type="text/css"/>
  <link rel="stylesheet" href="styles/style.css" type="text/css"/>

  <script src="../scripts/external/jquery-2.2.3.js"></script>
  <script src="../scripts/script.js"></script>

</head>

  <nav class="shadownav">
    <a class="banner-logo-container" <?php if ($thisPage == 'Welcome') { echo " id=\"homeclick\" "; } ?> href="index.php">
      <img id="logo" src="images/squares_50px_50px.png" alt="KanbanGrid Logo" title="Welcome"/>
      <span id="logotxt">Library System</span></a>
      <ul id="menubar">
        <li><a class="headlink" <?php if ($thisPage == 'Add') { echo " id=\"on\" "; } ?> href="libadd.php">Add Book</a></li>
        <li><a class="headlink" <?php if ($thisPage == 'Find') { echo " id=\"on\" "; } ?> href="libfind.php">Find Book</a></li>
        <li><a class="headlink" <?php if ($thisPage == 'Loan') { echo " id=\"on\" "; } ?> href="libloan.php">Borrow</a></li>
        <li><a class="headlink" <?php if ($thisPage == 'Return') { echo " id=\"on\" "; } ?> href="libreturn.php">Return</a></li>
        <li><a class="headlink" <?php if ($thisPage == 'Status') { echo " id=\"on\" "; } ?> href="libstatus.php">Borrower Info</a></li>
      </ul>
  </nav>
