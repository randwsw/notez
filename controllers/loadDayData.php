<?php

$d=$_POST["dd"];
$m=$_POST["mm"];
$y=$_POST["yy"];

$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");

$act = array();
$output = null;

// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($conn,"SELECT result, count(result) AS c FROM activity_status WHERE id IN (SELECT id FROM activity WHERE actDate='$y-$m-$d' AND userId = 1) GROUP BY result;"); // i user;
		while($e=mysqli_fetch_assoc($result))
			$output[]=$e;
	
	print(json_encode($output));
	
mysqli_close($conn);
?>