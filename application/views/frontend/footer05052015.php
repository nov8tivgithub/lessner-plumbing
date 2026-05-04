    <div id="footer">
		<div class="footer_top">
        	<div class="w970 slideInLeft wow">  
                <div class="foot_nav FL"> 
                    <a class="white"  href="<? echo base_url('home'); ?>">Home</a>
                    <a class="white" href="<? echo base_url('aboutus'); ?>">About Us</a>
                    <a class="white" href="<? echo base_url('service'); ?>">Services</a>
                    <a class="white" href="<? echo base_url('servicearea'); ?>">Service Area</a>
                    <a class="white" href="<? echo base_url('blog'); ?>">Blogs</a>
                    <a class="white" href="<? echo base_url('contactus'); ?>">Contact Us</a>
                </div>
                
                <div class="FL">
                    <p class="foothd">Call Today</p>
                    <? if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="numbr" href="tel:410746841">410-746-8415</a><? } else {?>
                    <span class="bigtxt"><span>410-</span><span>746-</span>8415</span><? } ?>
                </div>
                
                <div class="FR">
                    <div class="foothd FR">Follow Us</div>
                    <div class="clear"></div>
                    <div>
										<?php /*?><a class="soc_icn"><img src="<?echo base_url();?>img/twtr_icn.png" /></a><?php */?> 
                   	<a href="https://www.facebook.com/lessnerplumbing" class="soc_icn"><img src="<?echo base_url();?>img/faceicn.png" /></a>
                    </div>
                </div>
            </div>
        <div class="clear"></div>
    	</div>
        
        <div class="footer_bottom">
        	<p class="copyryt">&copy; 2014 lessnerplumbing.com,  All Rights Reserved.</p>
            <p class="master"> Master License Number 76242</p>
            <a href="http://consult-ic.com/" target="_blank" class="powrdby"></a>
        <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
<div class="clear"></div>
</div>  
 
</body>
</html>