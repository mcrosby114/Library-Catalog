<?php
  if(!isset($_SESSION)) session_start();
  if(!isset($_SESSION['bookInfo'])){
    header("Location:libreturn.php");
  } else {
    $bookInfo = $_SESSION['bookInfo'];
    unset($_SESSION['bookInfo']);
  }
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Return'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
  <div class="bodysection" id="sec1">
    <h1>Which book(s) would you like to return?</h1>
    <h3>According to our records, you've checked out the following books at the given branches.</h3>
  </div>
  <div id="form-wrapper">

      <form class="centerForm" action="handler_return.php" method="post">

        <h1 class="formTitle">Select Item(s) to Return</h1>

        <fieldset>

            <label class="labelTitle" for="book">Return:</label>
            <!-- <legend>Check out a book from: </legend> -->
            <?php
              foreach($bookInfo as $bk){ ?>
                <input type="checkbox" id="book" name="book" value="<?=$bk['loanID']?>"><strong><?=$bk['bookName']?></strong>
                <small><?=' -- (via '.$bk['branchName'].')'?></small><br />
            <?php } ?>

        </fieldset>

        <button type="submit" name="Button_2_Pressed">Submit</button>

      </form>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>