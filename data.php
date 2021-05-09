<?php
$conn = mysqli_connect("localhost", "root", "", "election");
$result = mysqli_query($conn, "select a.id,a.user_id,a.counter,b.username from candidates as a join users as b on a.user_id = b.id");
 
$data = array();
while ($row = mysqli_fetch_object($result))
{
    array_push($data, $row);
}
 
echo json_encode($data);
exit();