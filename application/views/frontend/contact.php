<?php $haserror = $haserror ?? ''; $hasSucess = $hasSucess ?? ''; ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script language="javascript">
 $(document).ready(function () {

        jQuery.validator.addMethod("personName", function (value, element) {
            return this.optional(element) || /^[A-Za-z][A-Za-z .'-]*[A-Za-z]$/.test($.trim(value));
        }, "Please enter a valid name (letters only, at least 2 characters)");

        jQuery.validator.addMethod("meaningfulText", function (value, element) {
            var trimmed = $.trim(value);
            return this.optional(element) || (trimmed.length >= 10 && /[A-Za-z]{2,}/.test(trimmed));
        }, "Please enter a meaningful message (at least 10 characters)");

        $("#contactus").validate({
            ignore : [],
            rules: {
                firstname: {
                    required: true,
                    minlength: 2,
                    personName: true
                },
                lastname: {
                    required: true,
                    minlength: 2,
                    personName: true
                },
                message: {
                    required: true,
                    minlength: 10,
                    meaningfulText: true
                },
                //captchacode  : 'required',
                hiddenRecaptchacontact : {
                     required: function() {
                       if(grecaptcha.getResponse() == '') {
                         return true;
                       } else {
                         return false;
                       }
                     }
                  },
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
                firstname: {
                    required: 'Please enter First Name',
                    minlength: 'First Name must be at least 2 characters',
                    personName: 'Please enter a valid First Name'
                },
                lastname: {
                    required: 'Please enter Last Name',
                    minlength: 'Last Name must be at least 2 characters',
                    personName: 'Please enter a valid Last Name'
                },
                message: {
                    required: 'Please enter Message',
                    minlength: 'Message must be at least 10 characters',
                    meaningfulText: 'Please enter a meaningful message'
                },
                //captchacode   : 'Please enter security code'
                hiddenRecaptchacontact   : 'Please verify your identity',
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
  function recaptchaCallback_contact(){
    $('#contactus').valid("#hiddenRecaptchacontact");
  }

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
	  // $("#captchacode").val('')
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
        	<p class="contp fadeInLeft wow">
  Thank you for visiting our website. Please fill out the following form to get in touch with our certified staff and request additional information about our services.
</p>
        <div class="statbx_contnr fadeInRight wow">

            	<!--mobile-->
                	<div class="mob_onl">
                    	<!--<div class="echbx FL" data-target="#mail"><span class="md_ad"></span></div>-->

                        <div class="echbx FL" data-target="#phon"><a href="tel:410-746-8415"><span class="md_phon"></span></a></div>
                        <div class="echbx FL" data-target="#adres"><span class="md_loc"></span></div>
                        <div class="echbx FL" data-target="#adres1"><span class="md_loc"></span></div>
                        <div class="echbx FL" data-target="#adres2"><span class="md_loc"></span></div>
                    <div class="clear"></div>
                    </div>

                	<!--<div id="mail" class="slyd_mail target">adam@lessnerplumbing.com</div>-->
                    <div id="adres" class="slyd_mail target">Lessner Services<br />
												PO Box 272<br />
												Glyndon, MD 21071-0272</div>
                   <a href="tel:410-746-8415"><div id="phon" class="slyd_mail target"><span>410-</span> <span>746</span>–8415</div></a>
                   <div id="adres1" class="slyd_mail target">Lessner Services<br />
												4605 Pleasant Grove Road<br />
												Reisterstown, MD 21136</div>
                 <div id="adres2" class="slyd_mail target">Lessner Services<br/>3831 Maple Grove Rd. <br/>Manchester, MD 21102.</div>

                <!--mobile-->

            <!--<div class="statbx FL">
            	<span class="icnspnmail botomout"></span>
              	<p class="spntxt">adam@lessnerplumbing.com</p>
            </div>-->
            <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?> <a href="tel:410-746-8415" class="statbx icnspnphon-wrp FR">
                     
                 <p class="spntxt"> <span class="icnspnphon botomout"></span> 410&shy;-746-8415 </p>
            </a><?php  } else {?>
                <div class="statbx FL icnspnphon-wrp"> 
            <p class="spntxt"> <span class="icnspnphon botomout"></span> 410&shy;-746-8415 </p> </div> <?php  } ?>
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
            <div class="statbx FL">
                <span class="icnspnadd botomout"></span>
                <p class="spntxt"> Lessner Services<br/>3831 Maple Grove Rd. <br/>Manchester, MD 21102. </p>
            </div>

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
                      <p class="hidden-6forty">&nbsp;</p>
                      <?php /*  <p>Please enter the text in the same order as shown in the Image below.</p>
                        <div class="cpatchbx"><img id="captcha" src="<?php echo base_url();?>assets/securimage/securimage_show.php?sid=<?php echo md5(time()) ?>" alt="CAPTCHA Image" />
                        	<div class="rytpat">
								<a title="Reset" class="reset" onClick="document.getElementById('captcha').src = '<?php echo base_url();?>assets/securimage/securimage_show.php?' + Math.random(); return false"></a>
                      			<a title="Help" class="help">
                            		<p class="hlptxt">Please enter the words as shown in the picture. Doing so helps prevent automated programs from abusing this form.</p>
                            	</a>
                        </div>
                        </div>
                        <input type="text" id="captchacode" name="captchacode" value="<?php if($haserror == ""):  echo  $this->input->post('captchacode'); endif;?>"/> */ ?>
                        <div class="row mb20">
						  <div class="col-xs-12 res-captcha for-signup mt15 pl0">
							<div class="g-recaptcha custom-captcha signup-captcha" data-callback="recaptchaCallback_contact" data-sitekey="<?php echo GOOGLESITEKEY;?>" data-theme="light"></div>
							<input type="hidden" name="hiddenRecaptchacontact" id="hiddenRecaptchacontact" >
						  </div>
                        </div>
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
