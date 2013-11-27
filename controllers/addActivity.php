<?php
if(!session_id()) { session_start();} 
$ymd = $_POST["ymd"];
$title = $_POST["title"];
$hour = $_POST["hour"];
$maintext = $_POST["maintext"];

require_once '../htmlpurifier/library/HTMLPurifier.auto.php';

$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");
mysqli_set_charset($conn, "utf8");

// Get news /////////////////////////////////////////////////////////////////////////////////////////// //
if (mysqli_connect_errno())
	{
 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
$uid = $_SESSION['userid'];
mysqli_query($conn,"INSERT INTO activity (userId, name, description, actType, actDate, actTime)
VALUES ($uid, '$title ', '$maintext', 1, '$ymd', '$hour')");

$aid = mysqli_insert_id($conn);

mysqli_query($conn,"INSERT INTO activity_status (id, compl, result)
VALUES ($aid, 0, 0)");

print_r("INSERT INTO activity (userId, name, description, actType, actDate, actTime)
VALUES ($uid, '$title ', '$maintext', 1, '$ymd', '$hour')");
?>