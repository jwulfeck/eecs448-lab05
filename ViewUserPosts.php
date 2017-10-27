<?php
$username = $_POST['userBox'];
$mysqli = new mysqli("mysql.eecs.ku.edu", "jwulfeck", 'P@$$word123', "jwulfeck");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$html = '<table>';
$html .= '<tr>';
$html .= '<th>'. "   " . '</th>';
$html .= '<th>'. "Post Content" . '</th>';
$html .= '</tr>';
$query = "SELECT content FROM Posts WHERE author_id = '$username'";
if ($result = $mysqli->query($query)){
  $count = 0;
  while ( $row=mysqli_fetch_assoc($result)) {
    $content = $row["content"];
    $count = $count+1;
    $html.='<tr>'."<th>$count</th>";
    $html.="<td>$content</td>".'</tr>';
  }
}

$html .='</table>';
echo($html);

?>
