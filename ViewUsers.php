<?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "wteeple", "teeplepass91", "wteeple");

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query = "SELECT user_id FROM Users";

  if ($result = $mysqli->query($query)) {
    echo "<table border = '1'>";
    echo "<tr><td>Current User IDs</td></tr>";
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["user_id"] . "</td></tr>";
    }
    echo "</table>";
  }
?>
