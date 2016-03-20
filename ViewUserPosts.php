<?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "wteeple", "teeplepass91", "wteeple");
  $curUser = $_POST["user"];

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query = "SELECT Users.user_id, Posts.content, Posts.post_id FROM Users INNER JOIN Posts ON Users.user_id=Posts.author_id ORDER BY Posts.post_id";

  if ($result = $mysqli->query($query)) {
    echo "<table border = '1'>";
    echo "<tr><td>Posts by User</td></tr>";
    echo "<tr><td>User ID</td><td>Post ID</td><td>Post Content</td></tr>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      if ($row["user_id"] == $curUser)
      {
        echo "<tr><td>" . $row["user_id"] . "</td><td>" . $row["post_id"] . "</td><td>" . $row["content"] . "</td></tr>";
      }
    }
    echo "</table>";
  }
?>
