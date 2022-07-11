<?php

// Using PDO

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'guestDB';

try {
  // connect to DB
  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);

  // setting error mode
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // creating sql table
  // $sql = "CREATE TABLE MyGuests(
  //   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  //   firstname VARCHAR(30) NOT NULL,
  //   lastname VARCHAR(30) NOT NULL,
  //   email VARCHAR(50),
  //   reg_date TIMESTAMP DEFAULT
  //   CURRENT_TIMESTAMP ON UPDATE
  //   CURRENT_TIMESTAMP 
  // )";

  // Inserting into table
  // $insert = "INSERT INTO MyGuests
  // (firstname, lastname, email)
  // VALUES('Sheriff', 'Dean', 'dean@gmail.com')";

  // $conn->exec($insert);

  // Get last inserted ID
  // $lastID = $conn->lastInsertId();

  // echo "New record created successfully!, and the last inserted element id is $lastID <br>";


  // Inserting multiple values into a table
  // begin transaction
  // $conn->beginTransaction();

  // statements
  // $conn->exec(
  //   "INSERT INTO MyGuests
  //   (firstname, lastname, email)
  //  VALUES('Toba', 'Dean', 'toba@gmail.com')"
  // );
  // $conn->exec(
  //   "INSERT INTO MyGuests
  //   (firstname, lastname, email)
  //  VALUES('Ola', 'Dean', 'ola@gmail.com')"
  // );
  // $conn->exec(
  //   "INSERT INTO MyGuests
  //   (firstname, lastname, email)
  //  VALUES('My', 'Boy', 'boy@gmail.com')"
  // );

  // commit transaction
  // $conn->commit();
  // echo 'Records created <br>';

  // exec() since no value is returned 
  // $conn->exec($sql);

  // Prepared Statements that inserts to a table
  // $stmt = $conn->prepare(
  //   "INSERT INTO MyGuests (firstname, lastname, email)
  //   VALUES(:firstname, :lastname, :email)"
  // );

  // $stmt->bindParam(':firstname', $firstname);
  // $stmt->bindParam(':lastname', $lastname);
  // $stmt->bindParam(':email', $email);

  // $firstname = "Ogundimu";
  // $lastname = "Toba";
  // $email = "test@test.com";
  // $stmt->execute();

  // $firstname = "Sanwo";
  // $lastname = "Jimi";
  // $email = "test2@test.com";
  // $stmt->execute();

  // Prepared Statements that selects to a table
  $stmt = $conn->prepare(
    "SELECT * FROM MyGuests ORDER BY reg_date LIMIT 5"
  );

  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  echo "<pre>";
  var_dump($result);
  echo "</pre>";


  echo "Connection successful <br>";
  // echo 'Records created <br>';
  // echo "Table MyGuest created";
} catch (PDOException $e) {
  // roll back the transaction if failed
  // $conn->rollBack();
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;