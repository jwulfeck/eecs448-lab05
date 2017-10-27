
<?php
$username = $_POST["userNameBox"];
$postContent = $_POST['postText'];
$mysqli = new mysqli("mysql.eecs.ku.edu", "jwulfeck", 'P@$$word123', "jwulfeck");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$canPost = True;
if ($username == ''){
  printf("Username field was left blank.");
  $canPost = False;
}
if ($postContent == ''){
  printf("Post was left blank.");
  $canPost = False;
}

if($canPost){
  $row_cnt = 0;
  $existsQuery = "SELECT user_id FROM Users WHERE user_id='" . $username . "'";
  if ($existsResult = $mysqli->query($existsQuery)){
    $row_cnt = $existsResult->num_rows;
  }
  if ($row_cnt !== 0){
    $postContent = mysqli_real_escape_string($mysqli, $postContent);
    $username = mysqli_real_escape_string($mysqli, $username);
    $query = "INSERT INTO Posts (content, author_id) VALUES ('$postContent', '$username')";
    if ($result = $mysqli->query($query)) {
      printf("Post stored.");
    }
    else{
      echo ($mysqli->error);
    }
  }
  else{
    printf("User does not exist.");
  }
}

/* close connection */
$mysqli->close();
?>
