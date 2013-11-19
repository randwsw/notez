<?php
if(!session_id())
	{
	    session_start();
	} 
if(isset($_SESSION['userid']))
  unset($_SESSION['userid']);
header("Location: ../index.php");
?>