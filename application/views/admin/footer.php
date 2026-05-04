    </div>
<div id="push"></div>
</div>


        
   
<div id="footer">

<div class="container">
      Copyright &copy; <? echo date('Y'); ?><span style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#000;"><a href='http://demo.icwares.com/clients/dev/lp/599/v1/' style='text-decoration:none; font-size:16px; color:##494949;' target='_blank'> lessnerplumbing.com</a></span>, All Rights Reserved.
     <a href="http://consult-ic.com/" target="_blank" class="power"></a>

   </div>
</div>
<script src="<?php echo base_url(); ?>scripts/bootstrap.min.js"></script>


<script>
$(document).ready(function(){
	
	$('.navbar-toggle').on('click',function(){
	
	if(!$('.navcustom').hasClass('nikky')){
		$('.navcustom').animate({"left":"0px"}, 300).show();
		$('.overlay').fadeIn();
		
	}
	});

		
})
function clse(){
		$('.navcustom').animate({"left":"-290px"}, 300);
		$('.overlay').fadeOut();
			}
function OVcls(){
		$('.overlay').fadeOut();
		$('.navcustom').animate({"left":"-290px"}, 300);
}

</script>

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