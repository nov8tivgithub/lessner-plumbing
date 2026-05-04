<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<meta name="description" content="<?php echo $description; ?>" />         
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
        <link href="<?echo base_url();?>css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?echo base_url();?>css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?echo base_url();?>css/fonts.css" rel="stylesheet" type="text/css" />
        <link rel="icon" href="<?php echo base_url();?>img/lp_favicn.png" type="image/png" sizes="16x16"/>
        
        <script src="<?echo base_url();?>js/jquery-1.11.0.min.js" type="text/javascript"></script> 
		<script src="<?echo base_url();?>js/wow.js"></script>
        <script src="<?echo base_url();?>js/custom.js"></script>
        <script src="<?echo base_url();?>js/jquery.validate.js"></script>
        
	</head>
<body>

<div class="wrapper">
	<div id="header">
    <div class="header pdTB5 bounceInDown wow">
            <div class="w10 FL pdL20 ">
                <a href="<? echo base_url('home'); ?>" class="lp_logo"><img src="<?echo base_url();?>img/lp_logo_main.png" /></a>
            </div>
            <? if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><div class="headr_callus FL"><p><span>Call Us Today:</span><a class="callnmbr" href="tel:4107468415">&thinsp; 410&shy;-746-8415</a></p></div><? } else{ ?>
            <div class="headr_callus FL"><p><span>Call Us Today:</span><a class="callnmbr">&thinsp; 410&shy;-746-8415</a></p></div><?}?>
            <!--menu below768-->
            	<div id="ipdmne" class="ipdmenu hvr-reveal"><img src="<?echo base_url();?>img/menu_icn.png" /></div>
            <!--menu below768-->
            <div id="fulnav" class="FR pdR20 pdT30">
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('home'); ?>"><?php if($activeclass=="home"): ?><span class="plum"></span><?php endif;?>HOME</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('aboutus'); ?>"><?php if($activeclass=="about"): ?><span class="plum"></span><?php endif;?>ABOUT US</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('service'); ?>"><?php if($activeclass=="service"): ?><span class="plum"></span><?php endif;?>SERVICES</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('servicearea'); ?>"><?php if($activeclass=="servicearea"): ?><span class="plum"></span><?php endif;?>SERVICE AREA</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('gallery'); ?>"><?php if($activeclass=="gallery"): ?><span class="plum"></span><?php endif;?>GALLERY</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('blog'); ?>"><?php if($activeclass=="blog"): ?><span class="plum"></span><?php endif;?>BLOGS</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('contactus'); ?>"><?php if($activeclass=="contact"): ?><span class="plum"></span><?php endif;?>CONTACT US</a>
            </div>
        <div class="clear"></div>
    	</div>
        
        <?php /*?><div class="header-scrol">
            <div class="w10 FL pdL20 ">
                <a href="<? echo base_url('home'); ?>" class="lp_logo"><img src="<?echo base_url();?>img/logo_scrol.png" /></a>
            </div>
            <!--menu below768-->
            	<div id="ipdmne" class="ipdmenu_scrol hvr-reveal"><img src="<?echo base_url();?>img/menu_scrol_icn.png" /></div>
            <!--menu below768-->
            <div id="fulnav" class="FR pdR20 pdT15">
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('home'); ?>"><?php if($activeclass=="home"): ?><span class="plum"></span><?php endif;?>HOME</a>
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('aboutus'); ?>"><?php if($activeclass=="about"): ?><span class="plum"></span><?php endif;?>ABOUT US</a>
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('service'); ?>"><?php if($activeclass=="service"): ?><span class="plum"></span><?php endif;?>SERVICES</a>
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('servicearea'); ?>"><?php if($activeclass=="servicearea"): ?><span class="plum"></span><?php endif;?>SERVICE AREA</a>
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('blog'); ?>"><?php if($activeclass=="blog"): ?><span class="plum"></span><?php endif;?>BLOGS</a>
                <a class="nav-button_scrol FL hvr-underline-from-center" href="<? echo base_url('contactus'); ?>"><?php if($activeclass=="contact"): ?><span class="plum"></span><?php endif;?>CONTACT US</a>
            </div>
        <div class="clear"></div>
    	</div><?php */?>
  
      <div class="header-scrol">
            <div class="w10 FL pdL20 ">
                <a href="<? echo base_url('home'); ?>" class="lp_logo"><img src="<?echo base_url();?>img/lp_logo_main.png" /></a>
            </div>
            
            <? if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone')) {?><div class="headr_callus FL"><p><span>Call Us Today:</span><a class="callnmbr" href="tel:4107468415">&thinsp; 410&shy;-746-8415</a></p></div><? } else{ ?>
            <div class="headr_callus FL"><p><span>Call Us Today:</span><a class="callnmbr">&thinsp; 410&shy;-746-8415</a></p></div><?}?>
            <!--menu below768-->
            	<div id="ipdmne" class="ipdmenu hvr-reveal"><img src="<?echo base_url();?>img/menu_icn.png" /></div>
            <!--menu below768-->
            <div id="fulnav" class="FR pdR20 pdT30">
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('home'); ?>"><?php if($activeclass=="home"): ?><span class="plum"></span><?php endif;?>HOME</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('aboutus'); ?>"><?php if($activeclass=="about"): ?><span class="plum"></span><?php endif;?>ABOUT US</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('service'); ?>"><?php if($activeclass=="service"): ?><span class="plum"></span><?php endif;?>SERVICES</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('servicearea'); ?>"><?php if($activeclass=="servicearea"): ?><span class="plum"></span><?php endif;?>SERVICE AREA</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('gallery'); ?>"><?php if($activeclass=="gallery"): ?><span class="plum"></span><?php endif;?>GALLERY</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('blog'); ?>"><?php if($activeclass=="blog"): ?><span class="plum"></span><?php endif;?>BLOGS</a>
                <a class="nav-button FL hvr-underline-from-center" href="<? echo base_url('contactus'); ?>"><?php if($activeclass=="contact"): ?><span class="plum"></span><?php endif;?>CONTACT US</a>
            </div>
        <div class="clear"></div>
    	</div>
      
      
        
        <div class="menu_overlay">
        	<a class="scrol_over hvr-underline-from-center">X</a>
            <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('home'); ?>"><?php if($activeclass=="home"): ?><span class="plum"></span><?php endif;?>HOME</a>
            <a class="scrol_over hvr-underline-from-center"  href="<? echo base_url('aboutus'); ?>"><?php if($activeclass=="about"): ?><span class="plum"></span><?php endif;?>ABOUT US</a>
            <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('service'); ?>"><?php if($activeclass=="service"): ?><span class="plum"></span><?php endif;?>SERVICES</a>
            <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('servicearea'); ?>"><?php if($activeclass=="servicearea"): ?><span class="plum"></span><?php endif;?>SERVICE AREA</a>
             <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('gallery'); ?>"><?php if($activeclass=="gallery"): ?><span class="plum"></span><?php endif;?>GALLERY</a>
            <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('blog'); ?>"><?php if($activeclass=="blog"): ?><span class="plum"></span><?php endif;?>BLOGS</a>
            <a class="scrol_over hvr-underline-from-center" href="<? echo base_url('contactus'); ?>"><?php if($activeclass=="contact"): ?><span class="plum"></span><?php endif;?>CONTACT US</a>
        </div>
    
    </div>