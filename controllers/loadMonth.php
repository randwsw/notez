<?php

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
	
	$result = mysqli_query($conn,"SELECT actDate, count(actDate) AS c FROM activity WHERE actDate>='$y-$m-01' AND actDate<='$y-$m-31' GROUP BY actDate;"); // i user;
		while($e=mysqli_fetch_assoc($result))
			$output[]=$e;
	
	print(json_encode($output));

mysqli_close($conn);
?>