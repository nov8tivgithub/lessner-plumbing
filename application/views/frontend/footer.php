    <div id="footer">
		<div class="footer_top">
        	<div class="w970 slideInLeft wow">  
               <div>
                  <div class="foot_nav FL"> 
                      <a class="white"  href="<?php  echo base_url('home'); ?>">Home</a>
                      <a class="white" href="<?php  echo base_url('aboutus'); ?>">About Us</a>
                      <a class="white" href="<?php  echo base_url('service'); ?>">Services</a>
                      <a class="white" href="<?php  echo base_url('servicearea'); ?>">Service Area</a>
                      <a style="display:none" class="white" href="<?php  echo base_url('blog'); ?>">Blogs</a>
                       <a  class="white" href="<?php  echo base_url('gallery'); ?>">Gallery</a>
                     
                      
                      <a class="white" href="<?php  echo base_url('contactus'); ?>">Contact Us</a>
                  </div>
                  
                  <div class="callus_01 FL">
                      <p class="foothd">Call Today</p>
                      <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="numbr" href="tel:4107468415">410-746-8415</a><?php  } else {?>
                      <span class="bigtxt textsm"><span>410-</span><span>746-</span>8415</span><?php  } ?>
                  </div>
                  
                  
                  
                  <div class="FR">
                      <div class="foothd FR">Follow Us</div>
                      <div class="clear"></div>
                      <div>
                      <?php /*?><a class="soc_icn"><img src="<?php echo base_url();?>img/twtr_icn.png" /></a><?php */?> 
                      <a href="https://www.facebook.com/lessnerplumbing" class="soc_icn"><img src="<?php echo base_url();?>img/faceicn.png" /></a>
                      </div>
                  </div>
                </div>
                <div class="clear"></div>
                  <div class="foteradrs">
                    <div class="adres_01 FL">
                    	<p>
                          Lessner Services<br/>
                          PO Box 272<br/>
                          Glyndon, MD 21071-0272 
                      </p>
                    </div>
                    <div class="adres_02 FL">
                    	<p>
                          Lessner Services<br/>
                          4605 Pleasant Grove Road<br/>
                          Reisterstown, MD 21136 
                      </p>
                    </div>
                   <?php /* <div class="callus FL">
                        <p class="foothd">Call Today</p>
                        <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="numbr" href="tel:4107468415">410-746-8415</a><?php  } else {?>
                        <span class="bigtxt"><span>410-</span><span>746-</span>8415</span><?php  } ?>
                    </div>*/?>
                    <div class="adres_03 FL ">
                      <p>Lessner Services<br>3831 Maple Grove Rd.  <br>Manchester, MD 21102.</p>
                    </div>
                  </div>
                  
                  <?php /*<div class="foteradrs_01">
                    <div class="adres_01 FL">
                    	<p>
                          Lessner Services<br/>
                          PO Box 272 Glyndon,MD<br/>
                          21071-0272 
                      </p>
                    </div>
                    <div class="adres_02 FL">
                    	<p>
                          Lessner Services<br/>
                          4605 Pleasant Grove Rd.<br/>
                          Reisterstown, MD 21136 
                      </p>
                    </div>
                    <div class="callus FL">
                      <p class="foothd">Call Today</p>
                      <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="numbr" href="tel:4107468415">410-746-8415</a><?php  } else {?>
                      <span class="bigtxt"><span>410-</span><span>746-</span>8415</span><?php  } ?>
                  </div>
                  </div>*/?>
                  
                  
            </div>
        <div class="clear"></div>
    	</div>
        
        <div class="footer_bottom">
        	<p class="copyryt">&copy; <?php echo date('Y'); ?> lessnerplumbing.com,  All Rights Reserved.</p>
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