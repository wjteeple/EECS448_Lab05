<?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "wteeple", "teeplepass91", "wteeple");
  $userid = $_POST["userid"]; //the user id to be added
  $post = $_POST["post"]; //the post to be added
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

    if (strlen($post) < 1 || strlen($post) > 511) { //check if string is proper length
      printf("Your post must be at least 1 character in length.");
    }
    else if ($inDatabase) { //if the user id is not in the database
      $mysqli->query("INSERT INTO Posts (content, author_id) VALUES ('$post', '$userid')");
      printf("The post from '$userid' has been successfully added.");
    }
    else {
      printf("'$userid' is not an existing user. Post not added.");
    }
    /* free result set */
    $result->free();
  }
  /* close connection */
  $mysqli->close();
?>
