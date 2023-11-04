//main system js scripts

//redirects users during login or password setting
function userResponse(response){
	if(response == 1){	
		$("#signin_btn").html('&nbsp; Signing In..');						
		setTimeout(' window.location.href = "users/super_user/dashboard.php"; ', 2000);
	}
	else if(response == 2){	
		$("#signin_btn").html('&nbsp; Signing In..');						
		setTimeout(' window.location.href = "users/admin/dashboard.php"; ', 2000);
	}
	else if(response == 3){	
		$("#signin_btn").html('&nbsp; Signing In..');						
		setTimeout(' window.location.href = "users/staff/dashboard.php"; ', 2000);
	}
	else if(response == 4){	
		$("#signin_btn").html('&nbsp; Signing In..');						
		setTimeout(' window.location.href = "users/member/dashboard.php"; ', 2000);
	}
	else if(response == 5){	
		$("#signin_btn").html('&nbsp; Signing In..');						
		setTimeout(' window.location.href = "users/des/dashboard.php"; ', 2000);
	}
	else if(response == 6){	
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-primary"> Set up your new password!</div>');
			$("#signin_btn").html('&nbsp; Set Password..');
		});								
		setTimeout(' window.location.href = "set-password.php"; ', 2000);
	}
	else if(response == 7) {									
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-danger"> Sorry, your account is deactivated, contact your systems administrator!</div>');
			$("#signin_btn").html('&nbsp; Sign In');
		});
		$("#error").delay(10000).fadeOut(function(){});
	}
	else if(response == 8) {									
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-danger"> Sorry, your account is locked, contact your systems administrator!</div>');
			$("#signin_btn").html('&nbsp; Sign In');
		});
		$("#error").delay(10000).fadeOut(function(){});
	} 
	else if(response == 9) {									
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-danger"> Sorry, your username or password is incorrect!</div>');
			$("#signin_btn").html('&nbsp; Sign In');
		});
		$("#error").delay(6000).fadeOut(function(){});
	}
	else if(response == 10) {									
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-danger"> Sorry, there was an error setting up your password, please try again!</div>');
			$("#signin_btn").html('&nbsp; Sign In');
		});
		$("#error").delay(6000).fadeOut(function(){});
	}

	else if(response == 11) {									
		$("#error").fadeIn(1000, function(){						
			$("#error").html('<div class="alert alert-danger"> Make sure your password includes an uppercase & lowercase letter, a number,and one special character!</div>');
			$("#signin_btn").html('&nbsp; Sign In');
		});
		$("#error").delay(6000).fadeOut(function(){});
	}
}

//login handling script
$("#signin-form").validate({
	rules: {
		password: {
			required: true,
		},
		username: {
			required: true
		},
	},
	messages: {
		password:{
		  required: "Please enter your password"
		 },
		username: {required:"Please enter your username"}
	},
	submitHandler: submitForm	
});	   
/* Handling login functionality */
function submitForm() {		
	var data = $("#signin-form").serialize();				
	$.ajax({				
		type : 'POST',
		url  : 'settings/sql-master.php',
		data : data,
		beforeSend: function(){	
			$("#error").fadeOut();
			$("#signin_btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Checking Details...');
		},
		success : function(response){  //alert(response);						
			userResponse(response);
		}
	});
	return false;
} 
/* end login script */ 

//set new password  script
$("#set-password").validate({
	rules: {
		password: {
			required: true,
			minlength: 8

		},
		re_password: {
			required: true,
			equalTo:"#password"
		},
		pass:{
			required:true
		}
	},
	messages: {
		password:{
		  required: "Please enter your new password"
		 },
		re_password: {
			required:"Please re enter your new password",
			equalTo: "Please confirm your new password"
		},
		pass:"Please enter your password to unlock your account"
	},
	submitHandler: setPassword	
});	   
/* Handling form functionality */
function setPassword() {		
	var data = $("#set-password").serialize();				
	$.ajax({				
		type : 'POST',
		url  : 'settings/sql-master.php',
		data : data,
		beforeSend: function(){	
			$("#error").fadeOut();
			$("#signin_btn").html(' Setting Password...');
		},
		success : function(response){  //alert(response);
			userResponse(response);
		}
	});
	return false;
} 
/* end script */ 

//set new password  script
$("#unlock-account").validate({
	rules: {
		pass:{
			required:true
		}
	},
	messages: {
		pass:"Please enter your password to unlock your account"
	},
	submitHandler: unlockAccount	
});	   
/* Handling form functionality */
function unlockAccount() {		
	var data = $("#unlock-account").serialize();				
	$.ajax({				
		type : 'POST',
		url  : 'settings/sql-master.php',
		data : data,
		beforeSend: function(){	
			$("#error").fadeOut();
			$("#unlock_btn").html(' Unlocking Account...');
		},
		success : function(response){  //alert(response);
			if(response == 1){
				$("#error").fadeIn(1000, function(){						
					$("#error").html('<div class="alert alert-danger"> Sorry the password entered is incorrect!</div>');
					$("#unlock_btn").html('&nbsp; Sign In');
				});
				$("#error").delay(6000).fadeOut(function(){});
			}else{
				$("#unlock_btn").html('<i class="fa fa-spin fa-spinner"></i> &nbsp; Unlocking Account...');
				setTimeout(' window.location.href = "'+response+'"; ',2000);
			}
		}
	});
	return false;
} 
/* end script */ 


