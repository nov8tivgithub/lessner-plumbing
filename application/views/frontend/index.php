
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
      integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
      crossorigin="anonymous"
    />
<style>
.lp_logo img{
  height: 60px;
  padding: 14px 10px;
}
#fulnav{padding-top:20px !important;}
.love{ width:74px; height:74px; display:inline-block;
    background: url('<?php echo base_url('img/love.png'); ?>') no-repeat;
   
}
.slider {
  position: relative;
  overflow: hidden;
  height: 100vh;

}

.slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 0.4s ease-in-out;
}

.slide.current {
  opacity: 1;
}

.slide .content {
    position: absolute;
    left: -413px;
    opacity: 0;
    top: 40%;
}

.slide .content h1 {
  font-size: 90px;
    color: #fff;
    font-family: 'Raleway-Black';
}

.slide .content h2 {
  font-size: 50px;
    color: #fff;
    font-family: 'Raleway-Black';
}
.slide .content p{  font-size: 30px; color: #fff; margin-top:10px;}

.slide.current .content {
  opacity: 1;
  transform: translateX(600px);
  transition: all 0.7s ease-in-out 0.3s;
}

.buttons button#next {
  position: absolute;
  top: 40%;
  right: 15px;
}

.buttons button#prev {
  position: absolute;
  top: 40%;
  left: 15px;
}

.buttons button {
    border: 1px solid #fff;
    background-color: #f9f6f645;
    color: #ffffff;
    cursor: pointer;
    padding: 22px 24px;
    border-radius: 50%;
    outline: none;
}

.buttons button:hover {
  background-color: #fff;
  color: #333;
}
@media screen and (min-device-width: 501px) and (max-device-width:1024px) { 
  .buttons button#prev {
  top: 18% !important;
}
.buttons button#next {
  top: 18% !important;
}
}
@media (max-width: 500px) {
  .areatopbox{padding:10px 5px !important;}
  .areatopbox p{line-height:20px; font-size:12px;}
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 65% 65px !important;}

.slide .content h1{ font-size:30px; text-align: center;}
.slide .content h2 {
  font-size: 18px;
  text-align: center;
}

.slide .content p{
    font-size: 16px;
  text-align: center;
}

.love {
  width: 42px;
  height: 44px;
  background: url('<?php echo base_url('img/love.png'); ?>') no-repeat;
  background-size: cover;
}


  .slide .content {
    top:420px !important;
    left: 0;
    width: 100%;
  }

  .slide.current .content {
    transform: translateY(-300px);
  }
}
@media screen and (min-device-width: 501px) and (max-device-width:640px) { 
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 85% 98px !important;}
}
@media screen and (min-device-width: 641px) and (max-device-width:800px) { 
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 85% 98px !important;}
}
@media screen and (min-device-width: 801px) and (max-device-width:1024px) { 
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 85% 98px !important;}
  .slide .content {
    top: 120px !important;
left: -600px;
width: 100%;
}
.slide .content h2{font-size:22px !important;}
.slide .content p{font-size:16px !important;}
}

@media screen and (min-device-width: 1025px) and (max-device-width:1200px) { 
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 85% 98px !important;}
  .slide .content {
    top: 120px !important;
left: -600px;
width: 100%;
}
}

@media screen and (min-device-width: 1200px) and (max-device-width:1400px) { 
  .slide:first-child{background-position: 85% 98px !important;}
  .slide:nth-child(2){background-position: 85% 98px !important;}
  .slide:nth-child(3){background-position: 85% 98px !important;}
  .slide .content {
    top: 120px !important;
left: -600px;
width: 100%;
}
}

@media screen and (min-device-width: 501px) and (max-device-width:800px) { 
  .foot_nav a{font-size: 11px !important;}
  .buttons button#prev{top:60%;}
  .buttons button#next{top:60%;}
.slide .content h1{ font-size:30px; text-align: center;}
.slide .content h2 {
  font-size: 20px;
  text-align: center;
}

.slide .content p{
    font-size: 16px;
  text-align: center;
}

.love {
  width: 42px;
  height: 44px;
  background: url('<?php echo base_url('img/love.png'); ?>') no-repeat;
  background-size: cover;
}

.slide .content {
  top: 120px !important;
left: -600px;
width: 100%;
}

}

@media screen and (min-device-width: 801px) and (max-device-width: 1024px) { 


.slide .content h1{ font-size:50px; text-align: center;}
.slide .content h2 {
  font-size: 30px;
  text-align: center;
}

.slide .content p{
    font-size: 20px;
  text-align: center;
}

}

@media screen and (min-device-width: 1025px) and (max-device-width: 1366px) { 

    .slide .content {
top: 303px !important;
left: -480px;
width: 100%;
}
.slide .content h1{ font-size:50px; }
.slide .content h2 {
  font-size: 30px;

}

.slide .content p{
    font-size: 20px;

}

}
@media screen and (min-device-width: 320px) and (max-device-width: 700px) { 
  .foot_nav a{display: block !important; font-size: 11px !important;}
}

@media screen and (min-device-width: 1367px) and (max-device-width: 1600px) { 
    .slider{height:90vh !important;}
    .slide .content {
top: 303px !important;
left: -445px;
width: 100%;
}
.slide .content h1{ font-size:60px;}
.slide .content h2 {
  font-size: 40px;

}

.slide .content p{
    font-size: 26px;

}

}
.foot_nav{display: block !important;}
/* Backgorund Images */
 
.slide:first-child {
  background: url('<?php echo base_url('img/banner-slide3.jpg'); ?>') no-repeat
    center top/cover;
}
.slide:nth-child(2) {
  background: url('<?php echo base_url('img/banner-slide1.jpg'); ?>') no-repeat
    center top/cover;
}
.slide:nth-child(3) {
  background: url('<?php echo base_url('img/banner-slide2.jpg'); ?>') no-repeat
    center top/cover;
}

</style>
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a1d9c125-d300-4ba0-ae33-83f35c123378", doNotHash: true, doNotCopy: false, hashAddressBar: false, onhover : true});</script>
   

 
            <!--slider-->
            <div class="slider">
      <div class="slide current">
        <div class="content">
          <h1>We love water!</h1>
          <h2>Your plumber for life</h2>
          <p>24 hr emergency service</p>
        </div>
      </div>
      <div class="slide">
        <div class="content">
        <h1>We love water!</h1>
          <h2>Your plumber for life</h2>
          <p>24 hr emergency service</p>
        </div>
      </div>
      <div class="slide">
        <div class="content">
        <h1>We love water!</h1>
          <h2>Your plumber for life</h2>
          <p>24 hr emergency service</p>
        </div>
      </div>

 

    </div>
    <div class="buttons">
      <button id="prev"><i class="fas fa-arrow-left"></i></button>
      <button id="next"><i class="fas fa-arrow-right"></i></button>
    </div>

            <!--slider end-->
 
 
    
    <div class="w100 calbar ">
   <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="fadeInLeft wow" href="tel:4107468415">Call Today 410-746-8415</a><?php  } else {?><p class="fadeInLeft wow" >Call Today 410&shy;-746-8415</p><?php  } ?>
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
	
    <div id="section_four" style="display:none"  >
    	<div class="w970 abt_box text-center" >
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
           <?php  if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><a class="common_paragrph greshblu" href="tel:4107468415" style="display:inline !important;">410-746-8415</a><?php  } else{ ?>410&shy;-746-8415<?php }?> to request information about our services or to provide feedback about our site.<!-- When you are finished, click the <?php echo htmlspecialchars("'SEND'");?> button to send us your message.--></p>
            <div class="pd10">
            	<a href="<?php  echo base_url('contactus'); ?>" class="lp_lnk_btn">Contact Us</a>
            </div>
        </div>
    <div class="clear"></div>
    </div>
 
    <script>
const slides = document.querySelectorAll('.slide');
const next = document.querySelector('#next');
const prev = document.querySelector('#prev');
const auto = false; // Auto scroll
const intervalTime = 5000;
let slideInterval;

const nextSlide = () => {
  // Get current class
  const current = document.querySelector('.current');
  // Remove current class
  current.classList.remove('current');
  // Check for next slide
  if (current.nextElementSibling) {
    // Add current to next sibling
    current.nextElementSibling.classList.add('current');
  } else {
    // Add current to start
    slides[0].classList.add('current');
  }
  setTimeout(() => current.classList.remove('current'));
};

const prevSlide = () => {
  // Get current class
  const current = document.querySelector('.current');
  // Remove current class
  current.classList.remove('current');
  // Check for prev slide
  if (current.previousElementSibling) {
    // Add current to prev sibling
    current.previousElementSibling.classList.add('current');
  } else {
    // Add current to last
    slides[slides.length - 1].classList.add('current');
  }
  setTimeout(() => current.classList.remove('current'));
};

// Button events
next.addEventListener('click', e => {
  nextSlide();
  if (auto) {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, intervalTime);
  }
});

prev.addEventListener('click', e => {
  prevSlide();
  if (auto) {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, intervalTime);
  }
});

// Auto slide
if (auto) {
  // Run next slide at interval time
  slideInterval = setInterval(nextSlide, intervalTime);
}

</script>