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
	<?php
			$m = date('m')-3;
			$y = date('Y');
			if(isset($_GET["m"])) {
				$m = $_GET["m"]-3;
			}
			if(isset($_GET["y"])) {
				$y = $_GET["y"];
			}
			
			$firstmonth = $m+3;
			$firstyear = $y;
			
			$mnames = array("styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień");
			$years = array();
			for($z=0;$z<7;$z++){
				if($m+$z+3<=3) {
					array_push($years, $y-1);
				} else if($m+$z+3>15) {
					array_push($years, $y+1);
				} else {
					array_push($years, $y);
				}					
			}
			if($m<=0){
				$m=$m+12;
				$y--;
			}
			
			$k=0;
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
	<div class="toolscontainer">
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
				<?php echo($mnames[($m+2)%12]." ".$y);?>
			</p>
		</div>
	</div>
	<div class="midcontainer">
		<div class="monthnav">
			<div class="nav" id="minus3" name="<?php echo($years[0]); ?>"><?php echo($mnames[$m-1]);?></div>
			<div class="nav" id="minus2" name="<?php echo($years[1]); ?>"><?php echo($mnames[($m)%12]);?></div>
			<div class="nav" id="minus1" name="<?php echo($years[2]); ?>"><?php echo($mnames[($m+1)%12]);?></div>
			<div class="nav" id="current" name="<?php echo($years[3]); ?>"><?php echo($mnames[($m+2)%12]);?></div>
			<div class="nav" id="plus1" name="<?php echo($years[4]); ?>"><?php echo($mnames[($m+3)%12]);?></div>
			<div class="nav" id="plus2" name="<?php echo($years[5]); ?>"><?php echo($mnames[($m+4)%12]);?></div>
			<div class="nav" id="plus3" name="<?php echo($years[6]); ?>"><?php echo($mnames[($m+5)%12]);?></div>
		</div>
		<div class="daystop">
			<div class="daycolumn">
				<p>Poniedziałek</p>
			</div>
			<div class="daycolumn">
				<p>Wtorek</p>
			</div>
			<div class="daycolumn">
				<p>Środa</p>
			</div>
			<div class="daycolumn">
				<p>Czwartek</p>
			</div>
			<div class="daycolumn">
				<p>Piątek</p>
			</div>
			<div class="daycolumn">
				<p>Sobota</p>
			</div>
			<div class="daycolumn">
				<p>Niedziela</p>
			</div>
		</div>
		<div class='months'>
			
			<?php
			// echo($m);
			// $conn=mysqli_connect("serwer1309748.home.pl", "12526875_notez","heyah123","12526875_notez");
// 			
			// if (mysqli_connect_errno())
			// {
		 		// echo "Failed to connect to MySQL: " . mysqli_connect_error();
			// }

			
			// echo($count);
			for($j=0;$j<7;$j=$j+1){
				echo("<div class='days' id=month_".($j-3).">");
				$num = cal_days_in_month(CAL_GREGORIAN, $m, $y); 
				$firstday = date('N',mktime(0, 0, 0, $m, 1, $y));
				$d=1;
				$sum=$num+$firstday-1;
				while($sum%7!=0){
					$sum++;
				}
				for($i=1;$i<$sum+1;$i=$i+1)
				{
					$count = 0;
				// if($m==$firstmonth){
					// $date = $y."-".($m%13)."-".$d;
					// $result = mysqli_query($conn,"SELECT count(*) AS c FROM activity WHERE userId=$id and actDate='$date'");
					// while($e = mysqli_fetch_array($result))
					  // {
							// $count = $e['c'];
					  // }
				// }
				
				
				echo("<div class='daywrapper'>");
					if(($i>=$firstday)&&($d<=$num)) {
						echo("<div class='daycolumn'>");													
						echo("<p class='dn'>".$d."</p>");
						echo("<p class='actcount'></p>");
						echo("<p class='actdes'></p>");
						
												
						echo("</div>");
						if($i==1) {
							echo("<div class='daycolumnbig' id='topleft'>");	
						} else if($i==7) {
							echo("<div class='daycolumnbig' id='topright'>");	
						} else if($i==$sum) {
							echo("<div class='daycolumnbig' id='botright'>");	
						} else if(($i%7==1)&&($i+7>$sum)) {
							echo("<div class='daycolumnbig' id='botleft'>");	
						} else if($i<=7) {
							echo("<div class='daycolumnbig' id='top'>");	
						} else if($i%7==1) {
							echo("<div class='daycolumnbig' id='left'>");	
						} else if($i%7==0) {
							echo("<div class='daycolumnbig' id='right'>");	
						}else if($i+7>$sum) {
							echo("<div class='daycolumnbig' id='bot'>");	
						} else {
							echo("<div class='daycolumnbig' id='middle'>");
						}
						echo("<div class=info><p class='infop'>".$d."/".$m."/".$y."</p></div>");
						echo("
						<div class='columnwrapper'>
							<div class=bar id=und>0</div>
							<div class=bar id=neg>0</div>
							<div class=bar id=pos>0</div>
						</div>
						<div class='gotoday'>
							<a href='day.php?d=$d&m=$m&y=$y'>przejdź do dnia</a>
						</div>
						");
						echo("</div>");
						$d++;
					} else {
						echo("<div class='daycolumn' id='empty'>");										
						echo("</div>");
					}
				echo("</div>");
				}
				if(($m<=12)&&($m>=1)){
					$m = $m+1;
				}
				if($m>12){
					$m=1;
					$y = $y+1;
				}
			echo("</div>");
			}
			// mysqli_close($conn);
			?>
		</div>
	</div>
</body>
</html>
<script>
	$.urlParam = function(name){
	    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
	    if (results==null){
	       return null;
	    }
	    else{
	       return results[1] || 0;
	    }
	}
	
	var montharray = ["styczeń", "luty", "marzec", "kwiecień", "maj", "czerwiec", "lipiec", "sierpień", "wrzesień", "październik", "listopad", "grudzień"];
	
	$(".nav").click(function(){
		
		var m = $(this).html();
		var y = $(this).attr("name");
		
		
		var monthi = jQuery.inArray( m, montharray );
		monthi+=1;
		
		
		 $.ajax({ 
		    type: 'POST', 
		    url: 'controllers/loadMonth.php', 
		    dataType: 'json',
		    data: {mm: monthi, yy: y},
		    error: function (data) {
		    	 alert("error");
		    },
		    success: function (data) {
		    	if(data!=null) {
		    		$( ".dn" ).next().html("");
		    		$.each(data,function(i,row){
		    		var day = row.actDate;
		    		var z = day.substring(8,10); 
		    		var dayInt = parseInt(z);
		    		$( ".dn" ).each(function( index ) {
		    			 var dday = $(this).html()
						if(dayInt==dday){
							$(this).next().html(row.c);
							
						}
					});
		    	})
		    	} else {
		    		$( ".dn" ).next().html("");
		    	}
		    	
		    }
		 });
		$(".days").css("display","none");
		$(".nav").css("color","black");
		$(".nav").css("font-family","'OpenSansRegular', Arial");
		$(this).css("color","#3B83DB");
		$(this).css("font-family","'OpenSansBold'");
		var nav = $(this).attr("id");
		switch (nav) {
		    case "minus3": {$("#month_-3").css("display","block");break;}
		    case "minus2": {$("#month_-2").css("display","block");break;}
		    case "minus1": {$("#month_-1").css("display","block");break;}
		    case "current": {$("#month_0").css("display","block");break;}
		    case "plus1": {$("#month_1").css("display","block");break;}
		    case "plus2": {$("#month_2").css("display","block");break;}
		    case "plus3": {$("#month_3").css("display","block");break;}
		}
		$(".dateinfop").html(m+" "+y);
	});
	
	$(document).ready(function(){
		var mmm = $.urlParam('m');
		var yyy= $.urlParam('y');
		if(mmm == null) {
			var mmm = <?php echo($firstmonth); ?>
		}
		if(yyy == null) {
			var yyy = <?php echo($firstyear); ?>
		}
		$.ajax({ 
		    type: 'POST', 
		    url: 'controllers/loadMonth.php', 
		    dataType: 'json',
		    data: {mm: mmm, yy: yyy},
		    error: function (data) {
		    	 alert("errorREADY");
		    },
		    success: function (data) {
		    	if(data!=null) {
		    		$( ".dn" ).next().html("");
		    		$.each(data,function(i,row){
		    		var day = row.actDate;
		    		var z = day.substring(8,10); 
		    		var dayInt = parseInt(z);
		    		$( ".dn" ).each(function( index ) {
		    			 var dday = $(this).html()
						if(dayInt==dday){
							$(this).next().html(row.c);
							
						}
					});
		    	})
		    	} else {
		    		$( ".dn" ).next().html("");
		    	}
		    	
		    }
		 });
		 
	
	// alert("asdd");
	$( ".daycolumnbig" ).mouseover(function() {
		var bd = $(this);
		var date = $(this).find(".infop").html();
		//alert(date);
		var datearray = [];
		datearray[0] = '';
		datearray[1] = '';
		datearray[2] = '';
		
		var j = 0;
		for (var i=0; i < date.length; i++) {
			if(date.charAt(i)!='/') {
				datearray[j]+=date.charAt(i);
			} else {
				j++;
			}
		}
		// alert(datearray[0]+datearray[1]+datearray[2]);
		$.ajax({ 
		    type: 'POST', 
		    url: 'controllers/loadDayData.php', 
		    dataType: 'json',
		    data: {dd: datearray[0], mm: datearray[1], yy: datearray[2]},
		    error: function (data) {
		    	 // alert("errorMOUSEOVER");
		    },
		    success: function (data) {
		    	$.each(data,function(i,row){
		    		var c = row.c;
					var r = row.result;
					 // alert(r+c);
					var x = 20+(c*10);
					var xm = 125-(c*10);
					if(r==0) {
						bd.find("#und").html(c);
						bd.find("#und").css("height", x+"px");
						bd.find("#und").css("margin-top", xm+"px");  
					} else if(r==1) {
						bd.find("#pos").html(c);
						// var x = 20+(c*10);
						// var xm = 125-(c*10);
						bd.find("#pos").css("height", x+"px");
						bd.find("#pos").css("margin-top", xm+"px");  
					} else if(r==2) {
						bd.find("#neg").html(c);
						// var x = 20+(c*10);
						// var xm = 125-(c*10);
						bd.find("#neg").css("height", x+"px");
						bd.find("#neg").css("margin-top", xm+"px");  
					}					 		
		    	});		    	
		    }
		 });
	});
});
	// // alert("asdd2");
	
</script>