<script language="javascript">
 $(document).ready(function () {

        $("#contactus").validate({

            rules: {
                firstname: 'required',
                lastname: 'required',
                message: 'required',
                captchacode: 'required',
				
                phone: {
                    required: true,
                    phoneUS: true
                },

                email: {
                    required: true,
                    email: true                    
                }


            },
            messages: {
                firstname: 'Please enter First Name',
                lastname: 'Please enter Last Name',
                message: 'Please enter Message',
                captchacode: 'Please enter Captcha Code',
                phone:{ 
					required:"Please enter Phone#",
					phoneUS	:"Please enter a valid Phone#"
					},
                email: {
                    required: "Please enter Email",
                    email: "Please enter a valid email address"

                }

            },
            errorPlacement: function (error, element) {

                error.insertAfter(element);

            }

        });

        jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        });
        });


</script>

	<?php if($haserror): ?>
  	<script> $(document).ready(function () { showerror(); });</script>
    <?php endif; ?>
    <?php if($hasSucess): ?>
  	<script> 
	$(document).ready(function () { 
	   showsuccess(); 
	   $("#firstname").val('');
	   $("#lastname").val('');
	   $("#email").val('');
	   $("#phone").val('');
	   $("#message").val('');
	   $("#captchacode").val('')
	});
    </script>
    <?php endif; ?>
  
  	<div class="mainerror"> 
   		<?php if($haserror): echo $errormsg; endif; ?>
  	</div> 
    
	<div class="mainsuccess">
 		<?php if($hasSucess):  echo $Sucessmsg; endif; ?>
	</div> 
    

 <div id="banepic">
    	<div class="topbanr"></div>
            <h3 class="greshblu PTB20 bgadj fadeInRight wow">Contact Us</h3>
        <div class="grbgcon">
        	<?php /*<p class="contp fadeInLeft wow">Thank you for visiting our website. Please fill out the following form to request information about our services or to provide feedback about our site.<!-- When you are finished, click the ‘SEND’ button to send us your message. You will see a confirmation below.-->
</p> */?>

<p class="contp fadeInLeft wow">
  Thank you for visiting our website. Please fill out the following form to get in touch with our certified staff and request additional information about our services.
</p>
        <div class="statbx_contnr fadeInRight wow"> 
        	
            	<!--mobile-->
                	<div class="mob_onl">
                    	<!--<div class="echbx FL" data-target="#mail"><span class="md_ad"></span></div>-->
                        <div class="echbx" data-target="#adres"><span class="md_loc"></span></div>
                        <div class="echbx FR" data-target="#phon"><a href="tel:410-746-8415"><span class="md_phon"></span></a></div>
                    <div class="clear"></div>	
                    </div>
                    
                	<!--<div id="mail" class="slyd_mail target">adam@lessnerplumbing.com</div>-->
                    <div id="adres" class="slyd_mail target">Lessner Services<br />
												PO Box 272<br />
												Glyndon, MD 21071-0272</div>
                   <a href="tel:410-746-8415"><div id="phon" class="slyd_mail target"><span>410-</span> <span>746</span>–8415</div></a>
                   
                <!--mobile-->
           
            <!--<div class="statbx FL">
            	<span class="icnspnmail botomout"></span>
              	<p class="spntxt">adam@lessnerplumbing.com</p>  
            </div>-->
            <div class="statbx FL">
            	<span class="icnspnadd botomout"></span>
              	<p class="spntxt"> Lessner Services<br />
					PO Box 272<br />
					Glyndon, MD 21071-0272
                </p>  
            </div>
			<div class="statbx FL">
            	<span class="icnspnadd botomout"></span>
              	<p class="spntxt"> Lessner Services<br />
					4605 Pleasant Grove Road<br />
					Reisterstown, MD 21136
                </p>  
            </div>
           <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?> <a href="tel:410-746-8415" class="statbx FR">
            		 <span class="icnspnphon botomout"></span>
             	 <p class="spntxt"> 410&shy;-746-8415 </p>  
            </a><?php  } else {?> 
				<div class="statbx FL">	<span class="icnspnphon botomout"></span>
			<p class="spntxt"> 410&shy;-746-8415 </p> </div> <?php  } ?>
				 
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
        </div>

<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'contactus');
   echo form_open(base_url('contactus'), $attributes); 
   ?>			
        <div class="fombx">
        <div class="midfrmr"> 
        	<div class="frmrw">
                    <div class="hfrw FL">
                        <p>First Name</p>
                        <input type="text" class="required" id="firstname" name="firstname" value="<?php  echo htmlspecialchars( $this->input->post('firstname')); ?>"/>
                    </div>
                    
                    <div class="hfrw FR">
                        <p>Last Name</p>
                        <input type="text" class="required" id="lastname" name="lastname" value="<?php  echo  htmlspecialchars($this->input->post('lastname')); ?>"/>
                    </div>
            <div class="clear"></div>
            </div>
            
            <div class="frmrw">
                    <div class="hfrw FL">
                        <p>Email</p>
                        <input type="email" class="required" id="email" name="email" value="<?php  echo  $this->input->post('email'); ?>"/>
                    </div>
                    
                    <div class="hfrw FR">
                        <p>Phone</p>
                        <input type="text" class="required" id="phone" name="phone" value="<?php  echo  $this->input->post('phone'); ?>"/>
                    </div>
            <div class="clear"></div>
            </div>
            
            <div class="frmrw">
                    <div class="hfrw FL msgadj">
                        <p>Message</p>
                        <textarea name="message" class="required" id="message" value="<?php  echo  $this->input->post('message'); ?>"><?php  echo  htmlspecialchars($this->input->post('message')); ?></textarea>
                    </div>
                    
                    <div class="hfrw FR">
                        <p>Please enter the text in the same order as shown in the Image below.</p>
                        <div class="cpatchbx"><img id="captcha" src="<?php echo base_url();?>assets/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" alt="CAPTCHA Image" />
                        	<div class="rytpat">                   
								<a title="Reset" class="reset" onClick="document.getElementById('captcha').src = '<?php echo base_url();?>assets/securimage/securimage_show.php?' + Math.random(); return false"></a>
                      			<a title="Help" class="help">
                            		<p class="hlptxt">Please enter the words as shown in the picture. Doing so helps prevent automated programs from abusing this form.</p>
                            	</a>
                        </div>
                        </div>
                        <input type="text" id="captchacode" name="captchacode" value="<?php if($haserror == ""):  echo  $this->input->post('captchacode'); endif;?>"/>
                    </div>					
            <div class="clear"></div>
            </div>
            
            	
			
            <div class="pd10">
                	<button type="button" class="lp_lnk_btn fadeInRight wow animated" onclick="forError()" >Send</button>
					<input type="hidden"  name="act" value="contact" /> 
            </div>
        </div>
        <div class="clear"></div>	
        </div>
 </form>               
        <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
    
 