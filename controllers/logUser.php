<?php

require_once '../htmlpurifier/library/HTMLPurifier.auto.php';

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");

$email = $conn->real_escape_string($_POST['email']);
$email= $purifier->purify($email);

$rememberMe = $conn->real_escape_string($_POST['rememberMe']);
$rememberMe= $purifier->purify($rememberMe);

$password1 = $conn->real_escape_string($_POST['password1']);
$password1= $purifier->purify($password1);

$em = null;
$pw = null;

// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

// if($rememberMe == "true")
// {
	// $result = mysqli_query($conn,"SELECT COUNT(*) AS count FROM remember_me rm, users u WHERE rm.user_id = u.id AND u.email='$email'");
		// while($e = mysqli_fetch_array($result))
		  // {
				// $count= $e['count'];
		  // }
// }

$result = mysqli_query($conn,"SELECT id FROM users WHERE email = '$email'");
		while($e = mysqli_fetch_array($result))
		  {
				$id = $e['id'];
		  }
		  
$result = mysqli_query($conn,"SELECT pw FROM passwords WHERE userId = $id AND pw='$password1'");
		while($e = mysqli_fetch_array($result))
		  {
				$pw = $e['pw'];
		  }
if($pw != null)	 
{
	session_start();
	if(isset($_SESSION['userid']))
  		unset($_SESSION['userid']);
	$_SESSION['userid']=$id;

	
	// if($count == 0)
	// {
		// mysqli_query($conn,"INSERT INTO remember_me (user_id) VALUES ($id)");	
	// }
	
}
else {
	print("Zły login, hasło lub nieaktywne konto");
}
mysqli_close($conn);
?>
