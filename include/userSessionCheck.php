<?php
	if(isset($_SESSION["userid"])) {
		
		$id = $_SESSION["userid"];
		$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");

		$em = null;
		
		// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
		if (mysqli_connect_errno())
			{
		 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
		$result = mysqli_query($conn,"SELECT email FROM users WHERE id = $id");
		
		while($e = mysqli_fetch_array($result))
		  {
				$em = $e['email'];
		  }
		mysqli_close($conn);
	} else {
		header("Location: index.php");
	}
?>