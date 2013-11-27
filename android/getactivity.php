<?php 

$dt = $_POST['date'];
$id = $_POST['id'];

      $conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");

      if (mysqli_connect_errno())
		{
	 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

      $q=mysqli_query($conn, "SELECT id, name, description, actTime  FROM activity WHERE actDate= '$dt' AND userId= '$id' ORDER BY actTime ASC ");

      while($e=mysql_fetch_assoc($q)) {
      	$output[]=$e;
      }

              
	 	

           print(json_encode($output));
     
    mysqli_close($conn);
?>