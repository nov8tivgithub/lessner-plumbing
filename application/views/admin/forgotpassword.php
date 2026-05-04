<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title?></title>
        
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
	
	$(document).ready(function(){
		$("#forgot").validate({
			rules : {
				 email: {
                    required: true,
                    email: true,
                    remote: "<?php  echo base_url().'admin/admin/checkeligible'; ?>"
                },			
				
				captcha_code:'required'
					
			},
			messages : {
				email: {
                    required: "Please enter Email",
                    email: "Please enter a valid email",
                    remote: "Your email address is invalid or inactive"

                },
				
				captcha_code:'Please enter Security Code'
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
			});  */
			


		</script>   
        <div class="container">
        <?php 
   //echo validation_errors(); 
   	$attributes = array('id' => 'forgot');
	
		echo form_open(base_url().ADMIN.'/forgotpassword', $attributes); 
	?>
            <div id="icdev-login-wrap">
            
            	<div class="raw align-center logoadmin"><img src="<?php echo base_url();?>images/logo.png" ></div>
                <div id="icdev-login">
            <h3>Forgot Your Password?</h3>
             <?php if ( isset ($haserror ) ) {?><div class="alert alert-danger"><?php echo $errormsg; ?></div><?php  } ?>
            <?php if ( isset ($hasSucess ) ) {?><div class="alert alert-success"><?php echo $Sucessmsg; ?></div><?php  } ?>
                <div class="mar2_bttm input-group-lg">
                   
                  <input type="text" class="form-control loginput" placeholder="Email" name="email" autocomplete="off">
                  <?php /*?><label class="error"><?php echo form_error('email'); ?></label><?php */?>
                </div>
                <div class="chdac">
                    <span id="recaptcha_image" class="cappic"><img id="captcha" src="<?php echo base_url();?>assets/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" alt="CAPTCHA Image" width="220" height="43" /> </span> 
					
						 <p class="capcht">Please enter the text in the same order as shown in the Image above.XX </p>
						 
					<div class="clear"></div>
					</div>
					
            <div class="chdac">
				<input type="text" class="form-control loginput" placeholder="Security Code"  name="captcha_code"  id="captcha_code" value="" autocomplete="off">
				
				<p>
                    <a class="rlink" onClick="document.getElementById('captcha').src = '<?php echo base_url();?>assets/securimage/securimage_show.php?' + Math.random(); return false" style="padding-right:4px;">Reset</a>|
                   <a class="rlink opnS1" id="hlptxt" style="position:relative;">Help
                    <span class="caphelp">Please enter the text you see in the  same order.
                       Doing so helps prevent automated programs from abusing this form.</span>
                   </a>
				  
			<div class="clear"></div>
			</div>
                
                 <input type="hidden" name="fogot" value="1">
                <input type="submit" class="btn btn-default btn-lg btn-block cus-log-in" value="Recover" />
                </div>
                <div class="row align-center forgotfix">
                <a href="<?php  echo base_url().ADMIN; ?>">Back to Login</a></div>
            </div>
            
            
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