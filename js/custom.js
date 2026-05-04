
			wow = new WOW(
			  {
				animateClass: 'animated',
				offset:       100
			  }
			);
			wow.init();
			
  		$(document).ready(function(){
     
        	$(document).scroll(function () {
				var y = $(this).scrollTop();
				//alert(y);
				if (y > 100) {
					$('.header-scrol').slideDown('fast');
				} else {
					$('.header-scrol').slideUp('fast');
				}

			});
			
			$(".ipdmenu_scrol, .ipdmenu").click(function(){
  				$(".menu_overlay").fadeIn();
			});
			
			$(".scrol_over").click(function(){
  				$(".menu_overlay").fadeOut();
			});
			
			
			var $targets = $('.target');
    			$('.echbx').click(function () {
        			var $target = $($(this).data('target')).slideToggle();
        			$targets.not($target).hide()
    			});
			
		})
		
		
	$(document).ready(function(){	
		$('.required').focus(function(){
			var $parent = $(this).parent();
			$parent.removeClass('error');
			$('label.error',$parent).fadeOut();
		});
		
	})
	
	function showsuccess(){
		$('.mainsuccess').animate({top: '0px'}, "slow");
		$('.mainsuccess').delay(2000).fadeOut(3000);		
	}
	function showerror(){
		$('.mainerror').animate({top: '0px'}, "slow");
		$('.mainerror').delay(2000).fadeOut(3000);		
	}
	
	
	
	function forError(){
	if($("#contactus").valid()){
		$("#contactus").submit();
	}else{
		if ($('label.error').length > 0) {
	 
				$('label.error').each(function(){
	 
					// Set the distance for the error animation
					var distance = 5;
	 
					// Get the error dimensions
					var width = $(this).outerWidth();
	 
					// Calculate starting position
					var start = width + distance;
	 
					// Set the initial CSS
					$(this).css({
						opacity: 0,
						right: -start+'px'
					})
					// Animate the error message
					.animate({
						right: 0+'px',
						opacity: 1
					}, 'slow');
	 
				});
			} 
	}
}
    


       