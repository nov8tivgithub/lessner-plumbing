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
		  
		  //print_r($blogdata);
		  $data[ 'blogdata' ]       = $blogdata; 
		  $headerdata['activeclass']	  = "home"; 
		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/index',$data);
          $this->load->view( 'frontend/footer');
      }
     
	  public function bloglist($monthyear=NULL,$tagid=NULL) {

	  
	  	if($monthyear == ""){
		$lastblog = $this->blog_model->get_lastpost();
		if(!empty($lastblog)){
			$monthyear = date('Y-m',$lastblog['createdate']);
			}else{
				$monthyear = date('Y-m');
			}
		}
		$ymArray = explode('-',$monthyear);

		if($tagid != ""){
			$blogdata = $this->blog_model->blog_by_tags($tagid,$ymArray[0],$ymArray[1]);
			$postdet  = $this->blog_model->postidsbytagid($tagid);
			//$monthyear = "";
		}else{	  
		if($monthyear != "" ){
			if (!preg_match('/^([0-9]{4})\-([0-9]{2})/', $monthyear, $matches)) {
			redirect(base_url('blog'));
			exit;
			}
		}
		$blogdata    = $this->blog_model->loadbloglist(PAGELIMIT,$monthyear);
	}	
	
	
	if(!empty($postdet)){
		foreach($postdet as $jk=>$jh){
		
		$post_id[] = $jh['postid'];
		
		}
	}
	
	
		$categ				  =$this->blog_model->getallcat();
		if ( !empty( $blogdata ) ) {
             foreach ( $blogdata as $cv => $cz ) {
                 if ( $cz[ 'imgkey' ] != NULL ) {
                     $blogdata[ $cv ][ 'image' ] = base_url( $this->corefunctions->getMyPath( $cz[ 'postid' ], $cz[ 'imgkey' ], $cz[ 'imgext' ], "assets/admin/post/crop/" ) );
                 } else {
                     $blogdata[ $cv ][ 'image' ] = base_url( "images/default.jpg" );
                 }
				 $lastid=$cz[ 'postid' ];
				 $moreBlogs = $this->blog_model->check_moreblog($lastid,$monthyear,$post_id);
             }
          }
		$showLoadmore = "No";
		if(!empty($moreBlogs) || empty($blogdata)){
			$showLoadmore = "Yes";
		}		  
		  $blogsforDate = $this->blog_model->blog_bymonthyear();
		  
		  
		  
		  $data['year']	    		= $ymArray[0];
		  $data['month']	    	= $ymArray[1];
		  $data[ 'blogdata' ]       = $blogdata;
		  $data[ 'lastid' ]         = $lastid;
		  $data[ 'showLoadmore' ]   = $showLoadmore;
		  $data['blogsforDate']	    = $blogsforDate;
		  $data['monthyear']	    = $monthyear;
		  $data['categ']	        = $categ;
		  $data['tagid']	        = $tagid;
		  $headerdata['activeclass']	  = "blog";
		 /* print "<pre>";
		  print_r($data);
		  print "</pre>"; */
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/bloglisting',$data);
		  $this->load->view( 'frontend/footer');
      }
 
      public function blogdetail($postkey) {
	  
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
             
		//print_r($blogdat);
		$data[ 'blogdat' ]       = $blogdat;
		$data['tagname']         = $tagname;
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
			$loadblog    = $this->blog_model->loadmoreblogsbytags($lastid,$tagid);
			$monthyear = "";
		}else{	  
		if($monthyear != "" ){
			if (!preg_match('/^([0-9]{4})\-([0-9]{2})/', $monthyear, $matches)) {
			redirect(base_url('blog'));
			exit;
			}
		}
		$loadblog    = $this->blog_model->loadmoreblog($lastid,$monthyear);
	}
		
	if(!empty($postdet)){
		foreach($postdet as $jk=>$jh){
		
		$post_id[] = $jh['postid'];
		
		}
	}
		
				
		//$loadblog = $this->blog_model->loadmoreblog($lastid,$post_id);
		$lastid = "";
		if ( !empty( $loadblog ) ) {
              foreach ( $loadblog as $key => $postdet ) {
                  if ( $postdet[ 'imgkey' ] != NULL ) {
                      $loadblog[ $key ][ 'image' ] = base_url( $this->corefunctions->getMyPath( $postdet[ 'postid' ], $postdet[ 'imgkey' ], $postdet[ 'imgext' ], "assets/admin/post/crop/" ) );
                  } else {
                      $loadblog[ $key ][ 'image' ] = base_url( "images/default.jpg" );
                  }
				    $lastid = $postdet[ 'postid' ];
              }
			$moreBlogs = $this->blog_model->check_moreblog($lastid,$monthyear,$post_id);
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
				$data[ 'errormsg' ] = "Please enter required fields";
				
			  }else{
				if ( $this->securimage->check( $this->input->post( 'captchacode' ) ) == false ) {
					  $data[ 'haserror' ] = TRUE;
					  $data[ 'errormsg' ] = "Please enter correct security code";
				  } else {	
					  $msg = $this->load->view( 'frontend/mail/contactus', $data, true );
					  $this->corefunctions->sendmail( ADMINEMAIL,"test1@consult-ic.com",'Customer Inquiry', $msg );
					  $data[ 'hasSucess' ] = TRUE;
					  $data[ 'Sucessmsg' ] = "Your Inquiry has been Submitted";
					  unset( $_REQUEST );
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