<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a1d9c125-d300-4ba0-ae33-83f35c123378", doNotHash: true, doNotCopy: false, hashAddressBar: false, onhover : true});</script>
   
   <div id="section_one">
    	<div class="baner-content bounceInDown wow" data-wow-delay="0.3s">
        	<span>KEEPING<br />BUSINESS FLOWING</span>
            <p>24 hour emergency service</p>
        </div>
    <div class="clear"></div>
    </div>
    
    <div class="w100 calbar ">
   <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="fadeInLeft wow" href="tel:410746841">Call Today 410-746-8415</a><?php  } else {?><p class="fadeInLeft wow" >Call Today 410&shy;-746-8415</p><?php  } ?>
    </div>
    
    <div id="section_two">
    	<div class="w970 abt_box ">
            <div class="w55 FL slideInLeft wow">
                <h3 class="greshblu pbB4">Residential and Commercial Plumbing Services</h3>
                <p class="common_paragrph greshblu">Lessner Plumbing is a family owned and operated company offering full residential and commercial plumbing services to Baltimore metro area.</p>
                <a  href="<?php  echo base_url('aboutus'); ?>" class="lp_lnk_btn">Read More</a>
            </div>
            <div class="FL abtimgbx slideInRight wow">
                <img src="img/abt_pipe.png" />
            </div>
        <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
    
    <div id="section_three">
    	<div class="w970 abt_box text-center slideInLeft wow">
            <h3 class="white text-center">Services</h3>
            <p class="common_paragrph text-center white pT1">At Lessner Plumbing we provide professional plumbing services for your home or business.</p>
            <a href="<?php  echo base_url('service'); ?>" class="lp_lnk_btn">View Our Services</a>
		<div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
	
    <div id="section_four">
    	<div class="w970 abt_box text-center">
            <h3 class="greshblu fadeInRight wow">Blogs</h3>
            <div class="blog_section">
			
			<?php if(!empty($blogdata)):
				foreach($blogdata as $cv):
			?>
			
                <div class="blog_box fadeInLeft wow">
                    <a class="vie_more" href="<?php  echo base_url('blogdetails/home/'.$cv['postkey']); ?>"></a>
                    <div class="blog_img">
                        <img src="<?php echo $cv['image'];?>" alt="blog image" />
                    </div>
                    <div class="blog_txt">
                     <a href="<?php  echo base_url('blogdetails/home/'.$cv['postkey']); ?>">   <h4 class="blog_tytl"><?php echo substr(strip_tags($cv['title']),0,20)."..."?></h4> </a> 
                        <p class="blog_para"><?php  echo substr(strip_tags($cv['description']),0,90)."..."?></p>
                        <p class="text-right"><?php echo date("M", $cv['createdate'])." ";  echo date("d", $cv['createdate']).","." ";  echo date("Y", $cv['createdate']); ?></p>
                    </div>
                    <div class="share_box">
                        <a class="st_sharethis_custom share_away" st_url="<?php  echo base_url('blogdetails/'.$cv['postkey']); ?>" st_image="<?php  echo $cv['image'];?>" st_title="<?php  echo $cv['title']; ?>">Share</a>
                    </div>
                </div>
		<?php 
			endforeach;
			endif;
		?>			
            <div class="clear"></div>
            </div>
			
			<?php if(!empty($blogdata))				
			{?>		
			
            <div class="pd10">
                	<a class="lp_lnk_btn fadeInRight wow" href="<?php  echo base_url('blog'); ?>">Read More Blogs</a>
            </div>
			
			<?php }else {?>
			
				<div class="pd10">			
					<p class="norecords">No Records Found</p>
				</div>
				
				<?php }?>
				
        <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
    <div id="section_five">
    	<div class="area_pic">
        	<h3 class="white text-center lyn122 fadeInRight wow">Service Area</h3>
        </div> 
    	<div class="areamap">
        	<div class="areatopbox fadeInLeft wow">
            	<p class="common_paragrph greshblu">Proudly serving the Baltimore, Maryland metropolitan area including Baltimore County, Baltimore City, Carroll County and Harford County with plumbing services.</p>
            <div class="pd10">
                	<a href="<?php  echo base_url('servicearea'); ?>" class="lp_lnk_btn">View all Service Area</a>
            </div>
            <div class="clear"></div>
            </div>
        </div>
    <div class="clear"></div>
    </div>
    
    <div id="section_six">
    	<div class="w970 abt_box text-center slideInRight wow">
            <h3 class="greshblu">We Love to hear from You</h3>
            <p class="common_paragrph greshblu pT1">Thank you for visiting our website. Please contact us to 
           <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="common_paragrph greshblu" href="tel:410746841" style="display:inline !important;">410-746-8415</a><?php  } else{ ?>410&shy;-746-8415<?php }?> to request information about our services or to provide feedback about our site.<!-- When you are finished, click the <?php echo htmlspecialchars("'SEND'");?> button to send us your message.--></p>
            <div class="pd10">
            	<a href="<?php  echo base_url('contactus'); ?>" class="lp_lnk_btn">Contact Us</a>
            </div>
        </div>
    <div class="clear"></div>
    </div>