<?php

  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Frontend extends CI_Controller {
      public function __construct( ) {
          parent::__construct();
          $this->load->model( array(
		  
              'frontend/blog_model', 
          ) );
          $this->load->library( array(
               'corefunctions',
              'securimage/securimage','migration'
              
          ) );

		    $this->load->library('migration');
			if ( ! $this->migration->current()) {
			  show_error($this->migration->error_string());
			} 
		  
          //$this->migration->current();
      }

      public function _remap( $method, $params = array( ) ) {
          if ( method_exists( __CLASS__, $method ) ) {
              $args = array_slice( $this->uri->rsegments, 2 );
              if ( method_exists( $this, $method ) ) {
                  return call_user_func_array( array(
                       &$this,
                      $method 
                  ), $args );
              }
          } else {
             redirect( base_url() . '404' );
              exit( );
          }
      }

	  public function pagenotfound( )
      {
          $data['title'] = 'Page Not Found';
          $this->output->set_status_header( '404' );
          $this->load->view( '404', $data );
      }
      
      public function index() {
          $blogdata             = $this->blog_model->loadbloglist(3);
		  
		  if ( !empty( $blogdata ) ) {
             foreach ( $blogdata as $cv => $cz ) {
                 if ( $cz[ 'imgkey' ] != NULL ) {
                     $blogdata[ $cv ][ 'image' ] = base_url( $this->corefunctions->getMyPath( $cz[ 'postid' ], $cz[ 'imgkey' ], $cz[ 'imgext' ], "assets/admin/post/crop/" ) );
                 } else {
                     $blogdata[ $cv ][ 'image' ] = base_url( "images/default.jpg" );
                 } 
             }
          }
		  
		  $data[ 'blogdata' ]       = $blogdata; 
		  $headerdata['activeclass']	  = "home"; 
		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/index',$data);
          $this->load->view( 'frontend/footer');
      }
     
	  public function bloglist($monthyear=NULL,$tagid=NULL) {

	  
	  	if($monthyear == ""){
				
				$monthyear = ("all-all");				
			}
		
		$ymArray = explode('-',$monthyear);

		if($tagid != ""){
			$postdet  = $this->blog_model->postidsbytagid($tagid);
		}	
	
	$year=$ymArray[0];
		if($year == "all")
		{
		$year="";
		}
	
	$month=$ymArray[1];
		if($month == "all")
		{
		$month="";
		}
	
	
	$post_id = array();
	if(!empty($postdet)){
		foreach($postdet as $jk=>$jh){		
		$post_id[] = $jh['postid'];		
		}
	}
	
	$blogdata    = $this->blog_model->getall_blog($year,$month,$post_id);
	
	$activecat   = $this->blog_model->getactivecat();
	
	$catid = array();
	foreach($activecat as $kk => $mm){	
	$catid[] = $mm['tagid'];	
	}
	
	$catid = array_unique($catid);

	$categ		 =$this->blog_model->getallcat($catid);
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))
		{
		$phone = 1;
		}
		$count=0;
		$prev=4;
		$large=6;
		if ( !empty( $blogdata ) ) {
             foreach ( $blogdata as $cv => $cz ) {
			 if($phone!= 1){
					if($count==$cv){
						$class="blog_box_big";
						$truncate = 59;
						$para  = 300;
						$count=$count+$large;
						$temp=$prev;
						$prev=$large;
						$large=$temp;
					}
					else{
						$class="blog_box";
						$truncate = 30;
						$para  = 150;
					}
				}else{
					$class="blog_box";
					$truncate = 20;
					$para  = 90;
				}		
				 $blogdata[ $cv ][ 'class' ] = $class;
				 $blogdata[ $cv ][ 'truncate'] = $truncate;
				 $blogdata[ $cv ][ 'para'] = $para;
                 if ( $cz[ 'imgkey' ] != NULL ) {
                     $blogdata[ $cv ][ 'image' ] = base_url( $this->corefunctions->getMyPath( $cz[ 'postid' ], $cz[ 'imgkey' ], $cz[ 'imgext' ], "assets/admin/post/crop/" ) );
                 } else {
                     $blogdata[ $cv ][ 'image' ] = base_url( "images/default.jpg" );
                 }
				 $lastid=$cz[ 'postid' ];
				 
             }
			  $moreBlogs = $this->blog_model->check_blog_more($lastid,$year,$month,$post_id);
          }
		 
		$showLoadmore = "No";
		if(!empty($moreBlogs)){
			$showLoadmore = "Yes";
		}		  
		  $blogsforDate = $this->blog_model->blog_bymonthyear();
		  $blogsformonth= $this->blog_model->blog_byyear($year);

		  
		  $data['count'] 			= $count;
		  $data['lastkey']			= $cv;
		  $data['large'] 			= $large;
		  $data['year']	    		= $ymArray[0];
		  $data['month']	    	= $ymArray[1];
		  $data['blogdata']       	= $blogdata;
		  $data['lastid']        	= $lastid;
		  $data['showLoadmore']   	= $showLoadmore;
		  $data['blogsforDate']	    = $blogsforDate;
		  $data['blogsformonth']	= $blogsformonth;
		  $data['monthyear']	    = $monthyear;
		  $data['months']	    	= $months;
		  $data['categ']	        = $categ;
		  $data['tagid']	        = $tagid;
		  $headerdata['activeclass']	  = "blog";
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/bloglisting',$data);
		  $this->load->view( 'frontend/footer');
      }
 
      public function blogdetail($from,$postkey) {
	  
	  if($postkey !==""){
		
	  $blogdat             = $this->blog_model->loadblog($postkey);
	  
	  if(!empty($blogdat)){	 
	  
	  $postid			   = $blogdat['postid'];
	  $tagids   		   = $this->blog_model->tagidbypostid($postid);

	  if(!empty($tagids)){
		  foreach($tagids as $cv=>$cm){
		  
		  $tagid[]			   = $cm['tagid'];
			}
          $tagarray= array_unique( $tagid );
		  $tagname   		   = $this->blog_model->loadtags( $tagarray );
		}	
		
       if ( $blogdat[ 'imgkey' ] != NULL ) {
          $blogdat[ 'image' ] = base_url( $this->corefunctions->getMyPath( $blogdat[ 'postid' ], $blogdat[ 'imgkey' ], $blogdat[ 'imgext' ], "assets/admin/post/crop/" ) );
               } else {
                    $blogdat[ 'image' ] = base_url( "images/default.jpg" );
				}
             
		$data[ 'blogdat' ]       = $blogdat;
		$data['tagname']         = $tagname;
		$data['from']            = $from;
		$headerdata['activeclass']	  = "blog";
		
		  $this->load->view( 'frontend/header',$headerdata);
          $this->load->view( 'frontend/blogdetails',$data);
		  $this->load->view( 'frontend/footer');
	  }
	  else{  
	  redirect(base_url('blog'));
	  }	  
      }
	  else{  
	  redirect(base_url('blog'));
	  }
	  }
	  
	 public function loadmoreblogs(){
	 
		$lastid = $this->input->post('lastid');
		$tagid  = $this->input->post('tagid');
		$monthyear = $this->input->post('monthyear');
		if($tagid != ""){
			$postdet  = $this->blog_model->postidsbytagid($tagid);
			$monthyear = "";
		}	
		
	  	if($monthyear == ""){
				
				$monthyear = ("all-all");				
			}		
		
		
		
		
	$ymArray = explode('-',$monthyear);	
	
	$post_id = array();
	
	if(!empty($postdet)){
		foreach($postdet as $jk=>$jh){
		
		$post_id[] = $jh['postid'];
		
		}
	}
	
	
		$year=$ymArray[0];
		if($year == "all")
		{
		$year="";
		}
	
		$month=$ymArray[1];
		if($month == "all")
		{
		$month="";
		}
	
	if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))
		{
		$phone = 1;
		}	
	
		$count = $this->input->post('count');
		
		$large = $this->input->post('large');
		$prev = ($large == 4) ? 6 : 4;
		$lastkey = $this->input->post('lastkey');
		$loadblog    = $this->blog_model->getall_blog($year,$month,$post_id,$lastid);		
		$lastid = "";
		if ( !empty( $loadblog ) ) {
              foreach ( $loadblog as $key => $postdet ) {
			  if($phone!= 1){
			  $lastkey++;
				 if($count==$lastkey){
					$class="blog_box_big";
					$truncate = 59;
					$para  = 300;
					$count=$count+$large;
					$temp=$prev;
					$prev=$large;
					$large=$temp;
				}
				else{
					$class="blog_box";
					$truncate = 30;
					$para = 150;
				}
				}else{
					$class="blog_box";
					$truncate = 20;
					$para  = 90;
				}
				
				$loadblog[ $key ][ 'class' ] 	= $class;			
				$loadblog[ $key ][ 'truncate'] = $truncate;			
				$loadblog[ $key ][ 'para'] = $para;			
                  if ( $postdet[ 'imgkey' ] != NULL ) {
                      $loadblog[ $key ][ 'image' ] = base_url( $this->corefunctions->getMyPath( $postdet[ 'postid' ], $postdet[ 'imgkey' ], $postdet[ 'imgext' ], "assets/admin/post/crop/" ) );
                  } else {
                      $loadblog[ $key ][ 'image' ] = base_url( "images/default.jpg" );
                  }
				    $lastid = $postdet[ 'postid' ];
              }
			$moreBlogs = $this->blog_model->check_blog_more($lastid,$year,$month,$post_id);
          }
		$showLoadmore = "No";
		if(!empty($moreBlogs) || empty($loadblog)){
			$showLoadmore = "Yes";
		}
		$data['loadblog'] = $loadblog;
		$data['lastid'] = $lastid;
		
		$jData['loadbloglist'] = $this->load->view( 'frontend/loadmoreblog',$data,TRUE);
		$jData['success'] = 1;
		
		$jData['lastid'] = $lastid;
		$jData['count'] = $count;
		$jData['lastkey'] = $lastkey;
		$jData['large'] = $large;
		$jData['showLoadmore'] = $showLoadmore;
		header( 'Content-Type: application/json' );
		print json_encode($jData);
		exit();
		
	  }
	  
	  public function aboutus() {
	  
	  	$headerdata['activeclass']	  = "about";
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/about');
          $this->load->view( 'frontend/footer');
      }
	  
	  public function contactus() {
	  	  if ( $this->input->post( 'act' ) == "contact" ) {
		  $this->form_validation->set_rules( 'firstname', 'Name', 'required|xss_clean' );
          $this->form_validation->set_rules( 'lastname', 'Last Name', 'required|xss_clean' );
          $this->form_validation->set_rules( 'captchacode', 'captcha code', 'required|xss_clean' );
          $this->form_validation->set_rules( 'email', 'Email', 'required|valid_email|xss_clean' );
          $this->form_validation->set_rules( 'message', 'Message', 'required|xss_clean' ); 
			  if ( $this->form_validation->run() === FALSE )
			  {
				$data[ 'haserror' ] = TRUE;
				$data[ 'errormsg' ] = "Please enter required fields.";
				
			  }else{
				if ( $this->securimage->check( $this->input->post( 'captchacode' ) ) == false ) {
					  $data[ 'haserror' ] = TRUE;
					  $data[ 'errormsg' ] = "Please enter correct security code.";
				  } else {	
					  $msg = $this->load->view( 'frontend/mail/contactus', $data, true );
					  $this->corefunctions->sendmail( ADMINEMAIL,"test1@consult-ic.com",'Customer Inquiry', $msg );
					  $data[ 'hasSucess' ] = TRUE;
					  $data[ 'Sucessmsg' ] = "Your Inquiry has been Submitted.";
					  unset ($_REQUEST);
				}
			  }
			}
		
		  $headerdata['activeclass']	  = "contact";
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/contact',$data);
          $this->load->view( 'frontend/footer');
      }
	  public function service() {
		  $headerdata['activeclass']	  = "service";
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/service');
          $this->load->view( 'frontend/footer');
      }
	  public function servicearea() {
		  $headerdata['activeclass']	  = "servicearea";
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/servicearea');
          $this->load->view( 'frontend/footer');
      }
	  public function polybutylenepipe() {
          $this->load->view( 'frontend/header');		  
          $this->load->view( 'frontend/polybutylenepipe');
          $this->load->view( 'frontend/footer');
      }
	  public function draincleaning() {
          $this->load->view( 'frontend/header');		  
          $this->load->view( 'frontend/draincleaning');
          $this->load->view( 'frontend/footer');
      }
  }
?>