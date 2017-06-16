<?php
  if(!isset($_SESSION)) session_start();
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Loan'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
  <div class="bodysection" id="sec1">
    <h1>Check Out an Available Book</h1>
    <!-- <h3>Use this form to add a new book (or more copies of an existing book).</h3> -->
    <!-- <h4>You may send copies to any of the available library branches listed in the menu below.</h4> -->
  </div>
  <div id="form-wrapper">

      <form class="centerForm" action="handler_loan.php" method="post">

        <h1 class="formTitle">Select Borrower & Book</h1>

        <?php
          if(isset($_SESSION['findFault'])) {
            echo "<div id='error_msg'>" . $_SESSION['findFault'] . "<span class='close-box'>&#10006</span>" . "</div>";
            $nameHighlight = "redHighlight";
            unset($_SESSION['findFault']);
          }
        ?>

        <fieldset>

            <label class="labelTitle" for="borrower">Select a Library Patron:</label>
            <select id="dayPicker" name="borrower" required>
            <?php
              $borrowers = $dao->getBorrowers();
              foreach($borrowers as $b){ ?>
                  <option value="<?=$b["CardNo"]?>"><?=$b["Name"]?></option>;
            <?php } ?>
            </select>

            <label class="labelTitle" for="title">Request a Title:</label>
            <input type="text" id="title" name="title" required autofocus maxlength="255">

        </fieldset>

        <button type="submit" name="Button_1_Pressed">Next</button>

      </form>
  </div>
</body>

<?php require_once("php_includes/footer.php"); ?>
