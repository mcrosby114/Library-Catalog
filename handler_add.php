<?php
  // if(!isset($_SESSION)) session_start();
  require_once ("dao.php");

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  $title = test_input($_POST["title"]);
  $author = test_input($_POST["author"]);
  $pubID = $_POST["publisher"];

  $branchID = $_POST["branch"];
  $copies = $_POST["copies"];

  if (isset($_POST["Button_Pressed"])) {
    try {
      $dao = new Dao();
      if($dao->bookExists($title, $author) === false){
        $dao->addBook($title, $author, $pubID);
      }
      $bookID = $dao->getBookID($title, $author);
      $dao->addBookCopy($copies, $bookID, $branchID);

      // $_SESSION["message"] = "Thank you. Your book has been added to the library system.";
      header("Location:success_add.php");

    } catch(Exception $e) {
        var_dump($e);
        echo "I'm a dumb dumb.";
        die;
    }
  }

?>
