<?php
$conn = mysqli_connect("localhost", "root", "", "election");
if (isset($_POST['id'])) {
	$id = $_POST['id'];
    $sql = "UPDATE candidates SET counter=counter + 1 WHERE id=".$id;
	if(mysqli_query($conn, $sql)){
	    echo "Voted successfully.";
	} else {
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	}
	 
	// Close connection
	mysqli_close($conn);
 }
exit();