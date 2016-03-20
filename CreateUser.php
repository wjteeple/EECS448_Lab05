<?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "wteeple", "teeplepass91", "wteeple");
  $userid = $_POST["user"]; //the user id to be added
  $inDatabase = false; //true if the user id is already in the database, false otherwise

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query = "SELECT user_id FROM Users";

  if ($result = $mysqli->query($query)) {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      //check if the user id is in the database
      if ($row["user_id"] == $userid) {
        $inDatabase = true;
      }
    }

    if (strlen($userid) < 1 || strlen($userid) > 15) { //check if string is proper length
      printf("User ID must be at least 1 character in length (15 maximum).");
    }
    else if (!($inDatabase)) { //if the user id is not in the database
      $mysqli->query("INSERT INTO Users (user_id) VALUES ('$userid')");
      printf("The username '$userid' has been successfully added.");
    }
    else {
      printf("The username '$userid' is already used.");
    }
    /* free result set */
    $result->free();
  }
  /* close connection */
  $mysqli->close();
?>
