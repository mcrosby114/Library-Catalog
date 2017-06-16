<?php
  if(!isset($_SESSION)) session_start();
  require_once ("dao.php");

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if (isset($_POST["Button_1_Pressed"])) {
    try {
      $dao = new Dao();

      $borrowerID = $_POST['borrower'];
      $userLoans = $dao->getActiveUserLoans($borrowerID);

      $bookInfo = array();

      foreach($userLoans as $loan){
        $loanID = $loan['BookLoanId'];
        $bookID = $loan['BookId'];
        $bookName = $dao->getBookName($bookID);
        $branchName = $dao->getBranchName($loan['BranchId']);
        $bookInfo[] = array('loanID' => $loanID, 'bookName' => $bookName, 'branchName' => $branchName);
      }

      $_SESSION['bookInfo'] = $bookInfo;

      header("Location:libreturn2.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }

    if (isset($_POST["Button_2_Pressed"])) {
    try {
      $dao = new Dao();
      $loanID = $_POST['book'];
      $dao->returnLoan($loanID);

      $_SESSION['successReturn'] = 'Thank you. Your return was successful!';

      header("Location:success_return.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }

?>
