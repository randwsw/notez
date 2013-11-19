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
	<div class="indexcontainer">
		<div class="logcontainer">
			<form method="post" id="logform">
			<div class="login">
				<h2>Logowanie</h2>
				<div class ="formdiv">
						<p>Adres email</p>
						<input type='text' class="form-text-input" id="emailinput" name="emailinput"/>
						<div class="errordiv" id="emailinput_label"></div>						
				</div>
				<div class ="formdiv">
						<p>Hasło</p>
						<input type='password' class="form-text-input" id="passinput" name="passinput"/>
						<div class="errordiv" id="passinput_label"></div>						
				</div>
				<div class ="formdiv">
						<div class ="formdivcolumn">
							<input class="form-button" type="submit" value="Zaloguj się" />
						</div>
						<div class ="formdivcolumn" id="logpcheckbox">
							<p> Zapamiętaj mnie</p>
						</div>
						<div class ="formdivcolumn" id="logcheckbox">
							<input type="checkbox" name="rememberMe" id="rememberMe" ></input>
						</div>
				</div>
			</div>
			</form>
			<div class="loginshadow">
				
			</div>
		</div>
	</div>
</body>
</html>
<script>
$('#emailinput').watermark("Wpisz swój adres email");
$('#passinput').watermark("Wpisz swoje hasło");

jQuery.validator.addMethod("customEmail", function(value, element) {
        return this.optional(element) || value.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    }, "Zły format adresu email!")
		
var validate = $("#logform").validate({
	errorPlacement: function(error, element) {
	    var l = element.attr("name");
	    l='#'+l+"_label";
	    $(l).html( error );
	        
	},
	success: function(label) {
		
	    // var l = label.attr("for");
	    // l='#'+l;
	    // l=l+"_label";
	    // $(l).html( "Ok" );    
	    
	},
	submitHandler: function(){
        $.post("controllers/logUser.php", 
        { email: $("#emailinput").val(), password1: $("#passinput").val(), rememberMe: $("#rememberMe").prop('checked') })
		.done(function(data) {
			if(data!='')
			{
				alert(data);
			}else {
					window.location.href = "main.php";			
			}
		});
    },
	rules: {
		emailinput: {
			required: true,
			customEmail: true
		},
		passinput: {
			required: true,
			minlength: 8
		}
	},
	 messages: {
		emailinput: {
			required: "Pole email jest puste !"
		},
		passinput: {
			required: "Pole hasło jest puste !",
			minlength: jQuery.format("Minimum {0} znaków !")
		}
	}
});
</script>