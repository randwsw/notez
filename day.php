<?php if(!session_id()) { session_start();} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Witaj w notez</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.watermark.min.js"></script>

<link rel="stylesheet" href="css/main.css" />

    
</head>

<body>
<div id="activityNewBg"></div>
<?php include 'include/userSessionCheck.php'; ?>
<?php 	$userid = $_SESSION['userid'];
			$d = $_GET['d'];
			$m = $_GET['m'];
			$y = $_GET['y'];
?>
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
	<div class="toolscontainer" id="daytools">
		<div class="userinfo">
			<p>
			Zalogowany jako: <?php echo($em);?>
			</p>
		</div>
		<div class="userinfo">
			<p id="logout">
				<a href="controllers/logoutUser.php">wyloguj się</a>
			</p>
		</div>
		<div class="dateinfo">
			<p class="dateinfop">
				<?php echo($d.'/'.$m.'/'.$y);?>
			</p>
		</div>
	</div>
	<div class="daycontainer">
		<div class="menu">
			<div class="menuitem" id="addDay">
				DODAJ
			</div>
			<!-- <div class="menuitem">
				USUŃ
			</div>
			<div class="menuitem">
				EDYTUJ
			</div> -->
		</div>
		<div class="list">
			
			<form id="addActForm">
			<div class='activity' id="activityNew">							
				<div class="actTop">
					<div class="title">
						<p class="addActp">TYTUŁ</p>
						<input name='titleinput' type="text"/>
					</div>
					<div class="time">
						<p class="addActp">GODZINA</p>
						<input name='timeinput' type="text"/>
					</div>
				</div>							
				<div class="description">
					<p class="addActp">OPIS</p>
					<textarea name="newDesc" rows="5" cols="44"></textarea> 
				</div>
				<div class="actmenu" id="actmenuAdd">
					<p id="cancel">anuluj</p>
					<p id="add" onclick="$('#addActForm').submit();">dodaj</p>
				</div>
			</div>
			</form>
			<?php
		
			$conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");
			mysqli_set_charset($conn,'utf8');

			if (mysqli_connect_errno()) {
			 		echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			$result = mysqli_query($conn,"SELECT a.name, a.actTime, a.description, aas.result FROM activity a, activity_status aas WHERE aas.id = a.id AND actDate ='$y-$m-$d' AND userid = '$userid' ORDER BY actTime");
				
			while($e = mysqli_fetch_array($result)) { ?>
				<?php $newdesc = nl2br($e['description'], false); ?>
						<div class="activityContainer">
							<?php if($e['result']==0) { ?>
								<div class='activity'>								
							<?php } else if($e['result']==1) { ?>
								<div class='activity_green'>		
							<?php } else if($e['result']==2) { ?>
								<div class='activity_red'>	
							<?php } ?>							
								<div class="actTop">
									<div class="title">
									<?php echo($e['name']); ?>
									</div>
									<div class="time">
									<?php echo($e['actTime']); ?>
									</div>
								</div>
								
								<div class="description">
									<?php echo($newdesc); ?>
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
	<?php include('include/footer.php');?>
</body>
</html>
<script type="text/javascript">

	$(".time input[type='text']").watermark("np. 13:37");
	$(".title input[type='text']").watermark("Tytuł wydarzenia (max. 60 znaków)");
	$(".description textarea").watermark("Opis nowego wydarzenia... (max. 255 znaków)");

	
	
	jQuery.validator.addMethod("mytext", function(value, element) {
        return this.optional(element) || value.match(/^[A-ZŻŹĆĄŚĘŁÓŃa-zżźćńółęąś0-9\-\,.!?@#$& (\n):]+$/);
    }, "Tylko litery i cyfry !")
    
    jQuery.validator.addMethod("hour", function(value, element) {
        return this.optional(element) || value.match(/^([0-1]?[0-9]|2[0-3]):([0-5][0-9])(:[0-5][0-9])?$/);
    }, "Tylko litery i cyfry !")
	
	var ymd = '<?php echo($y."-".$m."-".$d); ?>';
	
	
	var validate = $("#addActForm").validate({
		errorPlacement: function (error, element) {
       },
		submitHandler: function(){
			var timepost = $(".time input[type='text']").val();
			var titlepost = $(".title input[type='text']").val();
			var maintextpost = $(".description textarea").val();
			
	        $.post("controllers/addActivity.php", 
	        { title: titlepost, hour: timepost, maintext: maintextpost, ymd: ymd })
			.done(function(data) {
				window.location.href="day.php?<?php echo("d=".$d."&"."m=".$m."&"."y=".$y); ?>"
				// alert(data);
			});
			
	    },
		rules: {
			titleinput: {
				required: true,
				mytext:  true
			},
			timeinput: {
				required: true,
				hour: true
			},
			newDesc: {
				required: true,
				mytext:  true
			}
		}
	});
	
	$("#addDay").click(function(){
		$("#activityNew").css("display", "block");
		$("#activityNewBg").css("display", "block");
	});
	$("#activityNewBg, .actmenu #cancel").click(function(){
		validate.resetForm();
		
		$("#activityNew").css("display", "none");
		$("#activityNewBg").css("display", "none");
		
		$(".time input[type='text']").val("");
		$(".title input[type='text']").val("");
		$(".description textarea").val("");
		$(".time input[type='text']").attr("class", "");
		$(".title input[type='text']").attr("class", "");
		$(".description textarea").attr("class", "");
		
		
	});
</script>

