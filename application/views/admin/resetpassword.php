<?php
    /* Login Page */
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title?></title>
        <noscript><meta http-equiv="refresh" content="1;url=<?php echo base_url('scripterror')?>"></noscript>
        <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/bootstrap-theme.min.css" />
         <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/custom.css" />
         <link rel="icon" href="<?php echo base_url();?>img/lp_favicn.png" type="image/png" sizes="16x16"/>
        <script src="<?php echo base_url(); ?>scripts/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>scripts/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>scripts/jquery.validate.js" type="text/javascript"></script>
    </head>    
    <body>
    <script language="javascript">
	$(document).ready(function() {

   
   $('#recover').validate({
    // rules
    rules: {
        newpassword: {
            required: true,
            minlength: 3
        },
        repassword: {
            required: true,
            minlength: 3,
            equalTo: "#password" // set this on the field you're trying to match
        }
    },
 
    // messages
    messages: {
        newpassword: {
            required: "Please enter your new Password",
            minlength: "Your password must contain more than 3 characters"
        },
        repassword: {
            required: "Please confirm your new Password",
            minlength: "Your password must contain more than 3 characters",
            equalTo: "Your passwords do not match. Please check and try again." // custom message for mismatched passwords
        }
    }
});//end validate
});

  </script>   
        <div class="container">
        <?php 
   //echo validation_errors(); 
   	$attributes = array('id' => 'recover');
	
		echo form_open(base_url().ADMIN.'/resetpassword/'.$recoverKey, $attributes); 
	?>
            <div id="icdev-login-wrap">
             <?php if ( isset ($haserror ) ) {?><div class="alert alert-danger"><?php echo $errormsg; ?></div><?php  } ?>
            <?php if ( isset ($hasSucess ) ) {?><div class="alert alert-success"><?php echo $Sucessmsg; ?></div><?php  } ?>
            
            
            <div class="raw align-center logoadmin"><img src="<?php echo base_url();?>images/logo.png" /></div>
            
            <div id="icdev-login">
               
                <h3>Reset Password</h3>
                    <div class="mar2_bttm input-group-lg">
                        <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> -->
                        <input type="password" class="form-control" placeholder="Enter your new Password" name="newpassword" id="password" autocomplete="off">
                        
                 	 </div>
                     
                <div class="mar2_bttm input-group-lg">
                  <input type="password" class="form-control" placeholder="Confirm your new Password" name="repassword" id="repassword" autocomplete="off">
                  
                </div>
                
                     <div>
                         <input type="hidden" name="reset" value="1">
                        <input type="submit" class="btn btn-default btn-lg btn-block cus-log-in" value="Reset" />
                    </div>
                </div>
               <div class="row align-center forgotfix"> <a href="<? echo base_url().ADMIN; ?>" class="btn-link">Back to Login</a></div></div>
            </div>
            
            </form>
        </div>
        <noscript><meta http-equiv="refresh" content="1;url=<?php echo base_url('scripterror')?>"></noscript>
        
        <script>
$('[placeholder]').focus(function() {
	var input = $(this);
	/*if( input.attr('type') == 'password' ){
		return false;
	}*/
	
	
	if (input.val() == input.attr('placeholder')) {
	input.val('');
	input.removeClass('placeholder');
}
}).blur(function() {
	var input = $(this);
	/*if( input.attr('type') == 'password' ){
		return false;
	}*/
	
	if (input.val() == '' || input.val() == input.attr('placeholder')) {
	input.addClass('placeholder');
	input.val(input.attr('placeholder'));
}
}).blur();

</script>
    </body>
</html>