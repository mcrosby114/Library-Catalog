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
      $title = test_input($_POST['title']);

      $bookList = $dao->findBooks($title);
      $book = $bookList[0];
      // if(sizeof($bookList) > 1){
      //   $book = $bookList[0];
      // } else {
      //   $book = $bookList;
      // }

      if(empty($book)){
        $_SESSION['findFault'] = "Sorry, book not found, please try another.";
        header("Location:libloan.php");
      } else {
        $bookID = $book['BookId'];
        $bookTitle = $book['Title'];
        $branchesHaveBook = array();
        $info = array('CardNo' => $borrowerID, 'BookId' => $bookID, 'Title' => $bookTitle);

        $copyList = $dao->getAllCopies($bookID);                      //Get all records of branches with #copies for this book

        foreach($copyList as $copies){                                //For each branch/copy record: 
          $branchID = $copies['BranchId'];
          $copyCount = $copies['NoOfCopies'];

          $loansList = $dao->getBranchBookLoans($branchID, $bookID);  //Get all records of loans for this branch

          $activeCount = 0;
          foreach($loansList as $loan){                               //Isolate the ACTIVE loans for this book at this branch
            $isActive = $dao->checkedOut($loan['BookLoanId']);
            if($isActive === true){
              $activeCount++;
            }
          }
          $availableCount = $copyCount - $activeCount;

          if($availableCount != 0){
            $branchName = $dao->getBranchName($branchID);
            $branchesHaveBook[] = array('branchID' => $branchID, 'branchName' => $branchName, 'availableCount' => $availableCount);
          }
        }

        if(empty($branchesHaveBook)){
          $_SESSION['findFault'] = "Sorry, all copies of this book have been checked out from our branches.";
          header("Location:libloan.php");
        } else {
          $_SESSION['branchesHaveBook'] = $branchesHaveBook;
          $_SESSION['bookRequest'] = $info;
          header("Location:libloan2.php");
        }
      }

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }

    if (isset($_POST["Button_2_Pressed"])) {
    try {
      $dao = new Dao();
      $request = $_SESSION['bookRequest'];
      $borrowerID = $request['CardNo'];
      $borrowerName = $dao->getBorrowerName($borrowerID);
      $bookID = $request['BookId'];
      $bookTitle = $request['Title'];
      $branchID = $_POST['branch'];
      $branchName = $dao->getBranchName($branchID);

      $dueLong = date('F jS Y', strtotime('+10 days'));

      $dao->insertLoan($branchID, $bookID, $borrowerID);

      $_SESSION['successLoan'] = array('borrowerName' => $borrowerName, 'bookTitle' => $bookTitle, 'branchName' => $branchName, 'dueDate' => $dueLong);

      unset($_SESSION['bookRequest']);

      header("Location:success_loan.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }

?>
