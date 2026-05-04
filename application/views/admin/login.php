 
 <?php
    //Login 

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
        <script src="<?php echo base_url(); ?>scripts/plugins.js"></script>
        <script src="<?php echo base_url();?>scripts/jquery.validate.js" type="text/javascript"></script>
        
        
        
<!--    <script>
			
			$(function() {
				$('input, textarea').placeholder();
				var html;
				if ($.fn.placeholder.input && $.fn.placeholder.textarea) {
					html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> and <code>textarea</code> elements.</strong> The plugin won’t run in this case, since it’s not needed. If you want to test the plugin, use an older browser ;)';
				} else if ($.fn.placeholder.input) {
					html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> elements, but not for <code>textarea</code> elements.</strong> The plugin will only do its thang on the <code>textarea</code>s.';
				}
				if (html) {
					$('<p class="note">' + html + '</p>').insertAfter('form');
				}
			});
		</script>-->

    
            <script language="javascript">
	$(document).ready(function(){
		$("#login").validate({
			rules : {
							
				email        : {
					required : true,
					email  : true
				},
				password: 'required'
			
						
			},
			messages : {
				
				password         : 'Please enter Password',
				email            : 'Please enter a valid Email'
				
			}
		}); 
		
	$('body').jpreLoader({
		splashID: "#jSplash",
		showSplash: true,
		showPercentage: false,
		autoClose: true,
		splashFunction: function() {
			$('#circle').delay(250).animate({'opacity' : 1}, 500, 'linear');
		}
	});
	}); 
			/* $(function() {
				$('input, textarea').placeholder();
				var html;
				if ($.fn.placeholder.input && $.fn.placeholder.textarea) {
					html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> and <code>textarea</code> elements.</strong> The plugin won’t run in this case, since it’s not needed. If you want to test the plugin, use an older browser ;)';
				} else if ($.fn.placeholder.input) {
					html = '<strong>Your current browser natively supports <code>placeholder</code> for <code>input</code> elements, but not for <code>textarea</code> elements.</strong> The plugin will only do its thang on the <code>textarea</code>s.';
				}
				if (html) {
					$('<p class="note">' + html + '</p>').insertAfter('form');
				}
			}); */



		</script>  
    </head>    
    <body>
    <div class="ole panel">
<section id="jSplash" class="panel-body">
<!--<h1 class="nmm" data-content="Hummous">Hummous</h1>
<div id="inTurnBlurringTextG">
<div id="inTurnBlurringTextG_1" class="inTurnBlurringTextG">
<h1>H</h1></div>
<div id="inTurnBlurringTextG_2" class="inTurnBlurringTextG">
<h1>U</h1></div>
<div id="inTurnBlurringTextG_3" class="inTurnBlurringTextG">
<h1>M</h1></div>
<div id="inTurnBlurringTextG_4" class="inTurnBlurringTextG">
<h1>M</h1></div>
<div id="inTurnBlurringTextG_5" class="inTurnBlurringTextG">
<h1>O</h1></div>
<div id="inTurnBlurringTextG_6" class="inTurnBlurringTextG">
<h1>U</h1></div>
<div id="inTurnBlurringTextG_7" class="inTurnBlurringTextG">
<h1>S</h1></div>
</div>
<!--	<div id="circle"></div>-->
</section>
</div>
 
        <div class="container">
        <?php 
   //echo validation_errors(); 
   	$attributes = array('id' => 'login');
	
		echo form_open(base_url().ADMIN, $attributes); 
	?>
            <div id="icdev-login-wrap">
			
			
			<div class="raw align-center logoadmin"><img src="<?php echo base_url();?>images/logo.png" /></div>
            <div id="icdev-login">
            <h3>Welcome, Please Login</h3>
			<?php if ( isset ($haserror ) ) {?><div class="alert alert-danger"><?php echo $errormsg; ?></div><?php  } ?>
           

			
                <div class="mar2_bttm input-group-lg"><input type="text" class="form-control loginput" placeholder="Email" name="email"></div>
                
                <div class="mar2_bttm input-group-lg"><input type="password" class="form-control loginput" placeholder="Password" name="password"></div>
                <div ><input type="submit" class="btn btn-default btn-lg btn-block cus-log-in" value="Login" /></div>
				<div class="row align-center forgotfix">
               	<a href="<? echo base_url().ADMIN.'/forgotpassword'; ?>"  class="btn-link">Forgot Password ?</a>
				  <input type="hidden" name="Login" value="1">
                </div>
				</div>
				
            </div>
            </div>
            </form>
            <div class="coprgt">
						<p>Copyright &copy; <? echo date('Y'); ?> lessnerplumbing.com, All Rights Reserved.<p>
            </div>
            <div class="text-center pt20">
					 <a href="http://consult-ic.com/" target="_blank"><img src="<?php echo base_url();?>images/powrdby.png"/></a>
            </div>
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