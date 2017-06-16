<?php
  if(!isset($_SESSION)) session_start();
  if(!isset($_SESSION['branchesHaveBook']) || !isset($_SESSION['bookRequest'])){
    header("Location:libloan.php");
  } else {
    $request = $_SESSION['bookRequest'];
    $borrowerID = $request['CardNo'];
    $bookID = $request['BookId'];
    $bookTitle = $request['Title'];
    $branchesHaveBook = $_SESSION['branchesHaveBook'];
    unset($_SESSION['branchesHaveBook']);
    // unset($_SESSION['bookRequest']);
  }
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Loan'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
  <div class="bodysection" id="sec1">
    <h1>Your request matched the following title: <span class='underline'><?=$bookTitle?></span></h1>
    <h3>At least one copy is available for checkout at the branches listed below.</h3>
    <!-- <h4>You may send copies to any of the available library branches listed in the menu below.</h4> -->
  </div>
  <div id="form-wrapper">

      <form class="centerForm" action="handler_loan.php" method="post">

        <h1 class="formTitle">Select Branch</h1>
        <p class="formTitle">(These branches have at least one copy available)</p>

        <fieldset>

            <label class="labelTitle" for="branch">Check out book from:</label>
            <!-- <legend>Check out a book from: </legend> -->
            <?php
              foreach($branchesHaveBook as $br){ ?>
                <input type="radio" id="branch" name="branch" value="<?=$br['branchID']?>" required>
                <strong><?=$br['branchName'].' -- '.$br['availableCount'].' in stock.'?></strong><br />
            <?php } ?>

        </fieldset>

        <button type="submit" name="Button_2_Pressed">Submit</button>

      </form>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>