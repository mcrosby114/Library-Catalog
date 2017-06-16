<?php
  if(!isset($_SESSION)) session_start();
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Return'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
  <div class="bodysection" id="sec1">
    <h1>Return a Checked-out Book</h1>
    <!-- <h3>Use this form to add a new book (or more copies of an existing book).</h3> -->
    <!-- <h4>You may send copies to any of the available library branches listed in the menu below.</h4> -->
  </div>
  <div id="form-wrapper">

      <form class="centerForm" action="handler_return.php" method="post">

        <h1 class="formTitle">Select a Borrower</h1>
        <p class="formTitle">(The following shows only those with active loans)</p>

        <fieldset>

            <label class="labelTitle" for="borrower">Library Patron:</label>
            <select id="dayPicker" name="borrower" required>
            <?php
              $borrowers = $dao->getActiveBorrowers();
              foreach($borrowers as $b){ ?>
                  <option value="<?=$b["CardNo"]?>"><?=$b["Name"]?></option>;
            <?php } ?>
            </select>

        </fieldset>

        <button type="submit" name="Button_1_Pressed">Next</button>

      </form>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>