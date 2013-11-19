<?php if(!session_id()) { session_start();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Witaj w notez</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>

<link rel="stylesheet" href="css/main.css" />

    
</head>

<body>
<?php include 'include/userSessionCheck.php'; ?>
	<div class="topbarcontainer">
		<div class="topbar">
			<img src="img/note.png" alt="notez" height="200" width="200"/>
			<a>KONTAKT</a>
			<a>O PROJEKCIE</a>
			<a href='main.php'>MÓJ KALENDARZ</a>
			<a href='index.php'>STRONA GŁÓWNA</a>
		</div>
		<div class="botline">		
		</div>
	</div>
	<div class="daycontainer">
		<div class="menu">
			<div class="menuitem">
				DODAJ
			</div>
			<div class="menuitem">
				USUŃ
			</div>
			<div class="menuitem">
				EDYTUJ
			</div>
		</div>
		<div class="list">
			<?php
			$userid = $_SESSION['userid'];
			$d = $_GET['d'];
			$m = $_GET['m'];
			$y = $_GET['y'];
			$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");
			mysqli_set_charset($conn,'utf8');

			if (mysqli_connect_errno()) {
			 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			$result = mysqli_query($conn,"SELECT a.name, a.actTime, a.description, as.status FROM activity a, activity_status as WHERE actDate ='$y-$m-$d' AND userid = '$userid' ORDER BY actTime");
				
			while($e = mysqli_fetch_array($result)) { ?>
						<div class="activityContainer">
							<div class="activity">
								<div class="actTop">
									<div class="title">
									<?php echo($e['name']); ?>
									</div>
									<div class="time">
									<?php echo($e['actTime']); ?>
									</div>
								</div>
								
								<div class="description">
									<?php echo($e['description']); ?>
								</div>
								<div class="actmenu">
									<p>edytuj</p>
									<p>usuń</p>
								</div>
							</div>
							<div class="note">
								Lorem ipsum dolor sit amet, consectetur 
								adipiscing elit. Praesent auctor eleifend pulvinar.
								 Quisque ut vehicula nisl. Vivamus tristique sed elit id malesuada. 
								 Nullam iaculis placerat felis, in vulputate ipsum. Aliquam sodales e
								 uismod ligula. Maecenas porta, nulla ac eleifend accumsan, urna lorem 
								 lobortis augue, nec mattis nunc dui id lorem. Vivamus feugiat 
								 dolor ut nibh v
							</div>
						</div>
			<?php	 
			}
			?>
		</div>
	</div>
	
</body>
</html>