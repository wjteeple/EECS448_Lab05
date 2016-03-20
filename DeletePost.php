<?php
  $mysqli = new mysqli("mysql.eecs.ku.edu", "wteeple", "teeplepass91", "wteeple");
  $postidChecked = array();

  /* check connection */
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
  }

  $query = "SELECT Users.user_id, Posts.content, Posts.post_id FROM Users INNER JOIN Posts ON Users.user_id=Posts.author_id ORDER BY Posts.post_id";

  if ($result = $mysqli->query($query)) {
    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
      $post = $row["post_id"];
      if (isset($_POST["$post"]))
      {
        $delete = "DELETE FROM Posts WHERE post_id='$post'";
        $mysqli->query($delete);
        $postidChecked[] = $post;
      }
    }
    printf("The following Post IDs have been deleted: ");
    foreach ($postidChecked as $i) {
      printf($i);
      printf(" ");
    }
  }
?>
