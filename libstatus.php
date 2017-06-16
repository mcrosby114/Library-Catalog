<?php
  if(!isset($_SESSION)) session_start();
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Status'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
    <div class="bodysection" id="sec1">
      <h1>Retrieve information about a borrower's holdings</h1>
      <!-- <h3>Use this form to add a new book (or more copies of an existing book).</h3> -->
      <!-- <h4>You may send copies to any of the available library branches listed in the menu below.</h4> -->
    </div>

    <div id="form-wrapper">
        <form class="centerForm" action="handler_status.php" method="post">

          <h1 class="formTitle">Borrower Status</h1>
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
          <button type="submit" name="Button_Pressed">Submit</button>
        </form>
    </div>

    <div class="bodysection" id="sec2">

    <?php
        if(isset($_SESSION['checkoutList'])){
          $checkoutList = $_SESSION['checkoutList'];
          unset($_SESSION['checkoutList']);
		?>
					<h3>(Overdue items are highlighted in red)</h3>
          <table>
            <caption>Books Checked Out by Patron: <?=$checkoutList[0]['borrowerName']?></caption>
              <tr>
                <th>Title: </th>
                <th>Author: </th>
                <th>Library Branch: </th>
                <th>Date Out: </th>
                <th>Date Due: </th>
              </tr>

              <?php
              foreach($checkoutList as $bk){
               ?>

                  <tr class="<?=$bk['status']?>">
                    <td><?=$bk['bookName']?></td>
                    <td><?=$bk['bookAuthor']?></td>
                    <td><?=$bk['branchName']?></td>
                    <td><?=$bk['dateOut']?></td>
                    <td><?=$bk['dateDue']?></td>
                  </tr>

             <?php } ?>

          </table>
          <br /> <br />
    <?php } ?>
    </div>
</body>

<?php require_once("php_includes/footer.php"); ?>
