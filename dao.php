<?php
date_default_timezone_set('America/Boise');
class Dao {

  private $host = '127.0.0.1';
  private $port = 3306;
  private $charset = 'utf8';
  private $username = 'crosbyPHP';
  private $password = 'password';
  private $sslCA = '/private/etc/mysql/ssl/mysql-ca.pem';
  private $sslCERT = '/private/etc/mysql/ssl/mysql-server-cert.pem';
  private $sslKEY = '/private/etc/mysql/ssl/mysql-server-key.pem';
  private $dbname = 'Library';

  private function getConnection() {
    try {
      $conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}", "$this->username", "$this->password");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CA, "$this->sslCA");
      // $conn->setAttribute(PDO::MYSQL_ATTR_SSL_CERT, "$this->sslCERT");
      // $conn->setAttribute(PDO::MYSQL_ATTR_SSL_KEY, "$this->sslKEY");
    } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
    }
    return $conn;
  }

  public function getPublishers(){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT PubId, PubName FROM Publisher");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getBranches(){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT BranchId, BranchName FROM Library_Branch");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function bookExists($title, $author){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Book WHERE AuthorName = :author AND Title = :title");
    $stmt->bindParam(":author", $author);
    $stmt->bindParam(":title", $title);
    $stmt->execute();
    if($stmt->fetch())
      return true;
    else
      return false;
  }

  public function addBook($title, $author, $pubID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("INSERT INTO Book (AuthorName, Title, PubId) values (:author, :title, :pubID)");
    $stmt->bindParam(":author", $author);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":pubID", $pubID);
    $stmt->execute();
  }

  public function getBookID($title, $author){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT BookId FROM Book WHERE AuthorName = :author AND Title = :title");
    $stmt->bindParam(":author", $author);
    $stmt->bindParam(":title", $title);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['BookId'];
  }

  public function addBookCopy($copies, $bookID, $branchID){
    $existing = $this->getBranchCopies($bookID, $branchID);
    $conn = $this->getConnection();
    if(empty($existing)){
      $stmt = $conn->prepare("INSERT INTO Book_Copies (NoOfCopies, BookId, BranchId) values (:copies, :bookID, :branchID)");
      $stmt->bindParam(":copies", $copies);
      $stmt->bindParam(":bookID", $bookID);
      $stmt->bindParam(":branchID", $branchID);
      $stmt->execute();
    } else {
      $existingNumCopies = $existing['NoOfCopies'];
      $newCopyCount = $existingNumCopies + $copies;
      $stmt = $conn->prepare("UPDATE Book_Copies SET NoOfCopies = :newCopyCount WHERE BookId = :bookID AND BranchId = :branchID");
      $stmt->bindParam(":newCopyCount", $newCopyCount);
      $stmt->bindParam(":bookID", $bookID);
      $stmt->bindParam(":branchID", $branchID);
      $stmt->execute();
    }
  }

  public function getBranchCopies($bookID, $branchID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Book_Copies WHERE BookId = :bookID AND BranchId = :branchID");
    $stmt->bindParam(":bookID", $bookID);
    $stmt->bindParam(":branchID", $branchID);
    $stmt->execute();
    return $stmt->fetch();
  }

  public function findBooks($query){
    $conn = $this->getConnection();
    // $stmt = $conn->prepare("SELECT * FROM Book WHERE Title LIKE :query OR AuthorName LIKE :query");
    // $stmt->execute(array(':query' => '%'.$query.'%'));
    // // $stmt->bindParam(":query", $query);
    // // $stmt->execute();
    // $row = $stmt->fetchAll();
    // $q ="SELECT * from Book "."WHERE Title LIKE '%".$query."%' OR AuthorName LIKE '%".$query."%'";
    $stmt = $conn->prepare("SELECT * from Book "."WHERE Title LIKE '%".$query."%' OR AuthorName LIKE '%".$query."%'");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function findBranches($bookID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Library_Branch b JOIN Book_Copies c ON b.BranchId = c.BranchId WHERE c.BookId = :bookID");
    $stmt->bindParam(":bookID", $bookID);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getPubName($pubID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT PubName FROM Publisher WHERE PubId = :pubID");
    $stmt->bindParam(":pubID", $pubID);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['PubName'];
  }

  public function getBorrowers(){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT CardNo, Name FROM Borrower");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getAllCopies($bookID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Book_Copies WHERE BookId = :bookID");
    $stmt->bindParam(":bookID", $bookID);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getBranchBookLoans($branchID, $bookID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Book_Loans WHERE BranchId = :branchID AND BookId = :bookID");
    $stmt->bindParam(":branchID", $branchID);
    $stmt->bindParam(":bookID", $bookID);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function checkedOut($loanID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT DateOut, ReturnedDate FROM Book_Loans WHERE BookLoanId = :loanID");
    $stmt->bindParam(":loanID", $loanID);
    $stmt->execute();

    $loan = $stmt->fetch();
    $dateNow = date("Y-m-d");
    $dateOut = $loan['DateOut'];
    $dateRet = $loan['ReturnedDate'];

    if($dateNow >= $dateOut && is_null($dateRet)){
      return true;
    } else {
      return false;
    }
  }

  public function getBranchName($branchID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT BranchName FROM Library_Branch WHERE BranchId = :branchID");
    $stmt->bindParam(":branchID", $branchID);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['BranchName'];
  }

  public function getBorrowerName($borrowerID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT Name FROM Borrower WHERE CardNo = :borrowerID");
    $stmt->bindParam(":borrowerID", $borrowerID);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['Name'];
  }

  public function insertLoan($branchID, $bookID, $borrowerID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("INSERT INTO Book_Loans (DateOut, DueDate, ReturnedDate, BranchID, BookID, CardNo)
      VALUES (CURDATE(), DATE_ADD(CURDATE(), INTERVAL 10 DAY), NULL, :branchID, :bookID, :borrowerID)");
    $stmt->bindParam(':branchID', $branchID);
    $stmt->bindParam(':bookID', $bookID);
    $stmt->bindParam(':borrowerID', $borrowerID);
    $stmt->execute();
  }

  public function getActiveBorrowers(){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT bl.CardNo, b.Name FROM Borrower b JOIN Book_Loans bl ON b.CardNo = bl.CardNo WHERE ReturnedDate IS NULL");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // public function getUserLoans($borrowerID){
  //   $conn = $this->getConnection();
  //   $stmt = $conn->prepare("SELECT * FROM Book_Loans WHERE CardNo = :borrowerID");
  //   $stmt->bindParam(":borrowerID", $borrowerID);
  //   $stmt->execute();
  //   return $stmt->fetchAll();
  // }

  public function getBookName($bookID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT Title FROM Book WHERE BookId = :bookID");
    $stmt->bindParam(":bookID", $bookID);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['Title'];
  }

  public function getBookAuthor($bookID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT AuthorName FROM Book WHERE BookId = :bookID");
    $stmt->bindParam(":bookID", $bookID);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['AuthorName'];
  }

  public function returnLoan($loanID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("UPDATE Book_Loans SET ReturnedDate = CURDATE() WHERE BookLoanId = :loanID");
    $stmt->bindParam(':loanID', $loanID);
    $stmt->execute();
  }

  public function getActiveUserLoans($borrowerID){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Book_Loans WHERE CardNo = :borrowerID AND ReturnedDate IS NULL");
    $stmt->bindParam(":borrowerID", $borrowerID);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $result = array();
    $dateNow = date("Y-m-d");

    foreach($rows as $row){
      $dateOut = $row['DateOut'];
      if($dateNow >= $dateOut){
        $result[] = $row;
      }
    }
    return $result;
  }














  public function emailExists($email) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if($stmt->fetch())
      return true;
    else
      return false;
  }

  public function createUser($username, $email, $password) {
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
    $conn = $this->getConnection();
    $stmt = $conn->prepare("INSERT INTO User (username, email, pass_hash) VALUES (:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashed_pwd);
    $stmt->execute();
  }

  public function validateLogin($email,$password) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch();
    //If fetch did not return false, email exists.
    //Proceed to check password against hash associated with email in database
    if($row){
      $stored_hash = $row['pass_hash'];
      if(password_verify($password, $stored_hash))
        return true;
    } else {
      return false;
    }
  }

  public function getUserName($email) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['username'];
  }

  public function getUserID($email) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM User WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row['id'];
  }

  public function getNextRow($user_id) {
    $conn = $this->getConnection();
    // $stmt = $conn->prepare('CALL userProjectCount(:user_id, @rowCt)');
    // $stmt->bindParam(":user_id", $user_id);
    // $stmt->execute();
    // $stmt->closeCursor();
    // $count = $conn->query("SELECT @rowCt AS rowCt")->fetch(PDO::FETCH_ASSOC);
    // return $count['rowCt'];

    $stmt = $conn->prepare("SELECT MAX(row) FROM Project WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    $highest = $stmt->fetch();
    return $highest[0] + 1;
  }

  public function addProject($row, $title, $user_id, $descrip=NULL, $due_date=NULL, $color=NULL) {
    if(is_null($due_date)){
      $conn = $this->getConnection();
      $stmt = $conn->prepare("INSERT INTO Project (row, color, title, descrip, user_id)
      values (:row, :color, :title, :descrip, :user_id)");
      $stmt->bindParam(':row', $row);
      $stmt->bindParam(':color', $color);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':descrip', $descrip);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
    }else{
      $conn = $this->getConnection();
      $stmt = $conn->prepare("INSERT INTO Project (row, due_date, color, title, descrip, user_id)
      values (:row, :due_date, :color, :title, :descrip, :user_id)");
      $stmt->bindParam(':row', $row);
      $stmt->bindParam(':due_date', $due_date);
      $stmt->bindParam(':color', $color);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':descrip', $descrip);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->execute();
    }
  }

  public function deleteProject($proj_id){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("DELETE FROM Project WHERE id = :proj_id");
    $stmt->bindParam(":proj_id", $proj_id);
    $stmt->execute();

    $stmt2 = $conn->prepare("DELETE FROM Task WHERE proj_id = :proj_id");
    $stmt2->bindParam(":proj_id", $proj_id);
    $stmt2->execute();
  }

  public function getProjects($user_id) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Project WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function addTask($column, $title, $user_id, $proj_id, $descrip=NULL, $due_date=NULL, $color=NULL) {
    if(is_null($due_date)){
      $conn = $this->getConnection();
      $stmt = $conn->prepare("INSERT INTO Task (col, color, title, descrip, user_id, proj_id)
      values (:col, :color, :title, :descrip, :user_id, :proj_id)");
      $stmt->bindParam(':col', $column);
      $stmt->bindParam(':color', $color);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':descrip', $descrip);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':proj_id', $proj_id);
      $stmt->execute();
    }else{
      $conn = $this->getConnection();
      $stmt = $conn->prepare("INSERT INTO Task (col, due_date, color, title, descrip, user_id, proj_id)
      values (:col, :due_date, :color, :title, :descrip, :user_id, :proj_id)");
      $stmt->bindParam(':col', $column);
      $stmt->bindParam(':due_date', $due_date);
      $stmt->bindParam(':color', $color);
      $stmt->bindParam(':title', $title);
      $stmt->bindParam(':descrip', $descrip);
      $stmt->bindParam(':user_id', $user_id);
      $stmt->bindParam(':proj_id', $proj_id);
      $stmt->execute();
    }
  }

  public function deleteTask($task_id){
    $conn = $this->getConnection();
    $stmt = $conn->prepare("DELETE FROM Task WHERE id = :task_id");
    $stmt->bindParam(":task_id", $task_id);
    $stmt->execute();
  }

  public function getTasks($user_id) {
    $conn = $this->getConnection();
    $stmt = $conn->prepare("SELECT * FROM Task WHERE user_id = :user_id");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    return $stmt->fetchAll();
  }


}
?>
