<?php
  if(!isset($_SESSION)) session_start();
  require_once ("dao.php");

  if (isset($_POST['Button_Pressed'])) {
    try {
      $dao = new Dao();
      $bookList = $dao->findBooks($_POST['query']);
      if(empty($bookList)){
        $_SESSION['findFault'] = "Sorry, book not found, please try another.";
      } else {
        $_SESSION['bookList'] = $bookList;
      }
      header("Location:libfind.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }
?>
