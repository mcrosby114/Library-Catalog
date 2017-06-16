<?php
  if(!isset($_SESSION)) session_start();
  require_once ("dao.php");

  if (isset($_POST['Button_Pressed'])) {
    try {
      $dao = new Dao();

      $borrowerID = $_POST['borrower'];
      $userLoans = $dao->getActiveUserLoans($borrowerID);

      $bookInfo = array();

      foreach($userLoans as $loan){
        $borrowerName = $dao->getBorrowerName($borrowerID);
        $bookID = $loan['BookId'];
        $bookName = $dao->getBookName($bookID);
        $bookAuthor = $dao->getBookAuthor($bookID);
        $branchName = $dao->getBranchName($loan['BranchId']);
        $dateOut = $loan['DateOut'];
        $dateDue = $loan['DueDate'];
        $dateNow = date("Y-m-d");
        $status = '';
        if($dateNow > $dateDue){
          $status = 'OVERDUE';
        }
        $bookInfo[] = array('borrowerName' => $borrowerName, 'bookName' => $bookName, 
          'bookAuthor' => $bookAuthor, 'branchName' => $branchName, 'dateOut' => $dateOut, 
          'dateDue' => $dateDue, 'status' => $status);
      }

      $_SESSION['checkoutList'] = $bookInfo;

      header("Location:libstatus.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }
?>
