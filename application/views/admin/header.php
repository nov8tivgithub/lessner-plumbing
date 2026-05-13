<?php $pagetitle = $pagetitle ?? ''; $createurl = $createurl ?? ''; ?>
<!DOCTYPE HTML>
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
        
        
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 
<script src="<?php echo base_url(); ?>scripts/jquery-1.11.0.min.js"></script>
 <script src="<?php echo base_url(); ?>scripts/jquery-migrate-1.2.1.js"></script>
 <script src="<?php echo base_url();?>scripts/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>


    </head>    
    <body>
      
      

   <div id="wrap">
   		<div class="navbar navbar-inverse" role="navigation" >
        	
            <div class="container-fluid">
            <a class="navbar-brand" href="<?php  echo base_url().ADMIN.'/adminmanager'; ?>"><img src="<?php echo base_url();?>images/logowhite.png" width="53"/></a>
              		<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
					</div>
                    <div class="collapse navbar-collapse navcustom" id="bs-example-navbar-collapse-1" >
                    <ul class="navbar-nav navbar-right" >
								<li class="dropdown list-none">
								<span class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;">
									
<img src="<?php echo $this->session->userdata( 'adminImage' ); ?>" width="36" class="img-circle"  style="margin-right:4px;"/>
									<?php echo ucfirst($this->session->userdata( 'adminFirstname' )) .' '. ucfirst($this->session->userdata( 'adminLastname' ));?><b class="caret"></b></span>
                                    <ul class="dropdown-menu dropdown-menu-right cus-top-drp dp-icnSpn" role="menu">
                                        <li><a href="<?php  echo base_url().ADMIN.'/myprofile'; ?>" class="navbar-link"><span class="glyphicon glyphicon-user"></span>My Profile</a></li> 
                                        <li class="divider"></li>
                                        <li><a href="<?php  echo base_url().ADMIN.'/logout'; ?>" class="navbar-link"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                               		</ul>
								</li>
							</ul>
                            <ul class="nav navbar-nav nav-stacked dp-icnSpn">
								
								<li class="divider"></li>
<li class="<?php if($titlecls=='admin'){echo 'active';}?> cus-bttm-brdr"><a href="<?php  echo base_url().ADMIN.'/adminmanager'; ?>"><span class="glyphicon glyphicon-globe"></span>Admins</a></li>

<li class="<?php if($titlecls=='post'){echo 'active';}?> cus-bttm-brdr"><a href="<?php  echo base_url().ADMIN.'/blogmanager'; ?>"><span class="glyphicon glyphicon-send"></span>Blogs </a></li>
	
	<a class="cus-close" onClick="clse()"><span class="glyphicon glyphicon-remove"></span></a>
							</ul>
                    
                    </div>
            		
            
            </div>
        <div class="overlay" onClick="OVcls()" ></div>
   		</div>
   
       
        <div class="container">
        
       <div class="panel-heading col-custm-6 pad0">
			<div class="col-sm12 pad0">
       		<div class="clearfix">
            <div class="col-sm-6 FL offset0">
           		<h3 class="main-hd-h3"><?php echo $pagetitle;?></h3>
            </div>
            <?php  if($createurl): ?>
            <div class="col-sm-3 pad0 FR">
                        <div class="btn-group FR smllScrn">
                       		<a href="<?php echo $createurl;?>" class="btn btn-primary bn-cust"><span class="glyphicon glyphicon-plus"></span> Create</a>
                        </div>
                 </div>
               <?php  endif; ?>
                 </div>
             </div>    
        </div>
        
	 <?php
	if(!empty($breadcum)){ ?>
	
	
	    <ol class="breadcrumb">
		<?php
		foreach($breadcum as $key =>$brd):
	?>
            
            <?php if(isset($brd['url'])){?>
              <li><a href="<?php echo $brd['url']?>"><?php echo $brd['title']?></a></li>
             <?php }else{?>
              <li class="active"><?php echo $brd['title']?></li>
             <?php }?>
            
            <?php 
		endforeach;
		?>
		</ol>
	    <?php
		}
	 ?>