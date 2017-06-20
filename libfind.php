<?php
  if(!isset($_SESSION)) session_start();
  require_once "dao.php";
  $dao = new Dao();
?>

<?php $thisPage = 'Find'; ?>

<?php require_once("php_includes/header.php"); ?>

<body>
    <div class="bodysection" id="sec1">
      <h1>Search our Collection</h1>
      <!-- <h3>Use this form to add a new book (or more copies of an existing book).</h3> -->
      <!-- <h4>You may send copies to any of the available library branches listed in the menu below.</h4> -->
    </div>

    <div id="form-wrapper">
        <form class="centerForm" action="handler_find.php" method="post">

          <h1 class="formTitle">Find a Book</h1>
          <p class="formTitle">(Leave field blank to retrieve all book records)</p>

          <?php
            if(isset($_SESSION['findFault'])) {
              echo "<div id='error_msg'>" . $_SESSION['findFault'] . "<span class='close-box'>&#10006</span>" . "</div>";
              $nameHighlight = "redHighlight";
              unset($_SESSION['findFault']);
            }
          ?>

          <fieldset>

            <label class="labelTitle" for="query">Title or Author:</label>
            <input type="text" id="title" name="query" autofocus maxlength="255">

          </fieldset>
          <button type="submit" name="Button_Pressed">Submit</button>
        </form>
    </div>

    <div class="bodysection" id="sec2">

    <?php
        if(isset($_SESSION['bookList'])){
          $bookList = $_SESSION['bookList'];
          unset($_SESSION['bookList']);

          foreach($bookList as $bk){ ?>

          <table>
            <caption>Information for Book: <?=$bk['Title']?></caption>
              <tr>
                <th>Title: </th>
                <th>Author: </th>
                <th>Publisher: </th>
                <th>Library Branch: </th>
                <th>Copies: </th>
              </tr>

              <?php
                $branchList = $dao->findBranches($bk['BookId']);
                $pubName = $dao->getPubName($bk['PubId']);

                foreach($branchList as $br){
                  $tempRow = $dao->getBranchCopies($bk['BookId'], $br['BranchId']);
                  $quantity = $tempRow['NoOfCopies'];
               ?>

                  <tr>
                    <td><?=$bk['Title']?></td>
                    <td><?=$bk['AuthorName']?></td>
                    <td><?=$pubName?></td>
                    <td><?=$br['BranchName']?></td>
                    <td><?=$quantity?></td>
                  </tr>

             <?php } ?>

          </table>
          <br /> <br />
    <?php }
        } ?>
    </div>
</body>

<?php require_once("php_includes/footer.php"); ?>
