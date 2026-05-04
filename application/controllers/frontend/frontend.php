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
          $headerdata['title']	          = "Home: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
		  $headerdata['keywords']	      = "Baltimore Metro Area, Residential, Commercial Plumbing Services,"; 
		  $headerdata['description']	  = "Lessner Plumbing is a family owned and operated company.Lessner Plumbing is company offering full residential and commercial plumbing services to Baltimore metro area."; 		  
          
		  $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/index',$data);
          $this->load->view( 'frontend/footer');
      }
     public function index_new() {
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
          $headerdata['title']	          = "Home: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
		  $headerdata['keywords']	      = "Baltimore Metro Area, Residential, Commercial Plumbing Services,"; 
		  $headerdata['description']	  = "Lessner Plumbing is a family owned and operated company.Lessner Plumbing is company offering full residential and commercial plumbing services to Baltimore metro area."; 		  
          
		  $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/index_new',$data);
          $this->load->view( 'frontend/footer');
      }
     
	  public function bloglist($monthyear=NULL,$tagid=NULL) {

	  redirect( base_url() . '404' );
	  exit( );
	  
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
		$year= date("Y");
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
	
	if(!empty($activecat)){
		foreach($activecat as $kk => $mm){	
		$catid[] = $mm['tagid'];	
		}
	}
	
	$catid = array_unique($catid);
	if(!empty($catid)){
	$categ		 =$this->blog_model->getallcat($catid);
	  }
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
          $headerdata['title']	          = "Blogs: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Baltimore Metro Area, categories,"; 
	      $headerdata['description']	  = "Baltimore Metro Area 410-746-8415";		  
		  
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
        $headerdata['title']	      = "Blogs: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	    $headerdata['keywords']	      = "Baltimore Metro Area, categories,".$blogdat['title']; 
	    $headerdata['description']	  = "Baltimore Metro Area 410-746-8415";

		
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
		$year= date("Y");
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
        $headerdata['title']	      = "About: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	    $headerdata['keywords']	      = "Who we are, what we offer, our guarantee"; 
	    $headerdata['description']	  = "Family owned and operated company offering full residential and commercial service to Baltimore metro area. Same day, emergency, night, weekend, and holiday service. 10% senior discount. Clean courteous, professional, licensed, and insured. Prices quoted upfront, we don�t start until you have a full understanding of the work to be completed.";		
		
		
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/about');
          $this->load->view( 'frontend/footer');
      }
	  
	  public function contactus() {
	      $this->load->library('email');
	      $data = array();
	  	  if ( $this->input->post( 'act' ) == "contact" ) {
		  $this->form_validation->set_rules( 'firstname', 'Name', 'required|xss_clean' );
          $this->form_validation->set_rules( 'lastname', 'Last Name', 'required|xss_clean' );
          $this->form_validation->set_rules( 'email', 'Email', 'required|valid_email|xss_clean' );
          $this->form_validation->set_rules( 'message', 'Message', 'required|xss_clean' ); 
			  if ( $this->form_validation->run() === FALSE )
			  {
				$data[ 'haserror' ] = TRUE;
				$data[ 'errormsg' ] = "Please enter required fields.";
				
			  }else{   
				  	$recaptcha = $this->input->post('g-recaptcha-response');   
				  	$chk     = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".GOOGLESECRETKEY."&response=" . $recaptcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
					$capt    = array();
					$capt    = json_decode($chk, true);
					$success = 0;
					if ($capt['success'] == 1) {
					    $success = 1;
					}
			  	
                    if ( $success == 1 ){
					  $msg = $this->load->view( 'frontend/mail/contactus', $data, true );
					  //$this->corefunctions->sendmail( ADMINEMAIL,TOMAIL,'Customer Inquiry', $msg );
					  //$this->corefunctions->sendmail( ADMINEMAIL,'keerthi@consult-ic.com','Customer Inquiry', $msg );
					  
					  
					  $result = $this->email
    ->from(ADMINEMAIL)
    ->to(TOMAIL)
    ->subject('Customer Inquiry')
    ->message($msg)
    ->send();
					  
					  
					  
					  $data[ 'hasSucess' ] = TRUE;
					  $data[ 'Sucessmsg' ] = "Your Inquiry has been Submitted.";
					  unset ($_REQUEST);
				    }else{
						$data[ 'haserror' ] = TRUE;
				        $data[ 'errormsg' ] = "Please verify your identity";
					} 
			  }
			}
		
		  $headerdata['activeclass']	  = "contact";
          $headerdata['title']	          = "Contact Us: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Lessner Services, Glyndon, MD, 410�-746-8415"; 
	      $headerdata['description']	  = "Thank you for visiting our website. Please fill out the following form to request information about our services or to provide feedback about our site.Lessner Services, PO Box 272, Glyndon, MD 21071-0272, 410�-746-8415";		  
		  		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/contact',$data);
          $this->load->view( 'frontend/footer');
      }
	  public function service() {
		  $headerdata['activeclass']	  = "service";
		  $headerdata['title']	          = "Services: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Drain Cleaning Services, Polybutylene Pipe Replacement, Water Service Repair, Construction groundwork, water treatment systems, drain cleaning, plumbing repairs,  sump pumps, utility work, waterlines, water lines, Excavation services, sewer lines, boilers, radiant, heat systems, gas lines, flood restoration services, septic systems"; 
	      $headerdata['description']	  = "At Lessner Plumbing we offer professional plumbing services for your home and business. Proudly service the Baltimore, Maryland metropolitan area including Baltimore County, Baltimore City, Carroll County and Harford County. Professional,  Clean, and Courteous Plumbing Services.Our plumbing customers are thrilled with our work.Residential & Commercial Plumbing Licensed & Insured.";		  
		  
		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/service');
          $this->load->view( 'frontend/footer');
      }
	  public function servicearea() {
		  $headerdata['activeclass']	  = "servicearea";
		  $headerdata['title']	          = "Service Area: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Drain Cleaning Services, Polybutylene Pipe Replacement, Water Service Repair, Construction groundwork, water treatment systems, drain cleaning, plumbing repairs,  sump pumps, utility work, waterlines, water lines, Excavation services, sewer lines, boilers, radiant, heat systems, gas lines, flood restoration services, septic systems"; 
	      $headerdata['description']	  = "At Lessner Plumbing we offer professional plumbing services for your home and business. Proudly service the Baltimore, Maryland metropolitan area including Baltimore County, Baltimore City, Carroll County and Harford County. Professional,  Clean, and Courteous Plumbing Services.Our plumbing customers are thrilled with our work.Residential & Commercial Plumbing Licensed & Insured.";		  
		  
		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/servicearea');
          $this->load->view( 'frontend/footer');
      }
	  public function polybutylenepipe() {
          $headerdata['title']	          = "Polybutylene Pipe Replacement: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Water service, poly pipe, interior, construction, Baltimore, corporation, temperature, replacement, protects, sale, emergency, projects warrantee, materials, labor"; 
	      $headerdata['description']	  = "Polybutylene pipe is also known as �water service pipe�, �yard service pipe� or �poly pipe�. It is installed underground and delivers public drinking water from the street into your home. Polybutylene pipe is commonly used in and around homes the Baltimore metro area.Our polybutylene pipe replacements come with a 10 year warranty on materials and labor.";		  
          
		  $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/polybutylenepipe');
          $this->load->view( 'frontend/footer');
      }
	  public function draincleaning() {
          $headerdata['title']	          = "Drain Cleaning Services: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Drain cleaning services, tub drains, kitchen, garbage disposals, clogged shower drains, slow flowing drains,hydro jet sewer lines, sewer line repair, hydro jet, mechanical , snaking, preventive, maintenance, rooter, professional"; 
	      $headerdata['description']	  = "We offer professional Drain Cleaning to the Baltimore Maryland Metropolitan area. Serving Baltimore County,  Baltimore City, Carroll County, Harford County.";			  
		  
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/draincleaning');
          $this->load->view( 'frontend/footer');
      }
	  
	  public function plumber( $location ){
			$locations = array(
				'baldwin' 			=> 'Baldwin',
				'glyndon'			=> 'Glyndon',
				'phoenix-md'		=> 'Phoenix, MD',
				'boring'			=> 'Boring',
				'bunt-valley'		=> 'Hunt Valley',
				'pikesville'		=> 'Pikesville',
				'brooklandville'	=> 'Brooklandville',
				'hydes'				=> 'Hydes',
				'reisterstown'		=> 'Reisterstown',
				'butler'			=> 'Butler',
				'long-green'		=> 'Long Green',
				'riderwood'			=> 'Riderwood',
				'catonsville'		=> 'Catonsville',
				'lutherville'		=> 'Lutherville',
				'sparks-glencoe'	=> 'Sparks Glencoe',
				'cockeysville'		=> 'Cockeysville',
				'maryland-line'		=> 'Maryland Line',
				'stevenson'			=> 'Stevenson',
				'fork'				=> 'Fork',
				'monkton'			=> 'Monkton',
				'timonium'			=> 'Timonium',
				'freeland'			=> 'Freeland',
				'owings-mills'		=> 'Owings Mills',
				'towson'			=> 'Towson',
				'glen-arm'			=> 'Glen Arm',
				'parkton'			=> 'Parkton',
				'upperco'			=> 'Upperco',
				'finksburg'			=> 'Finksburg',
				'lineboro'			=> 'Linebor',
				'sykesville'		=> 'Sykesville',
				'eldersburg'		=> 'Eldersburg',
				'manchester-md'		=> 'Manchester, MD',
				'westminster'		=> 'Westminster',
				'hampstead-md'		=> 'Hampstead, MD',
				'marriottsville'	=> 'Marriottsville',
				'abingdon'			=> 'Abingdon',
				'fallston'			=> 'Fallston',
				'pylesville'		=> 'Pylesville',
				'baldwin'			=> 'Baldwin',
				'forestHill'		=> 'ForestHill',
				'street'			=> 'Street',
				'belcamp'			=> 'Belcamp',
				'jarrettsville'		=> 'Jarrettsville',
				'whiteford'			=> 'Whiteford',
				'churchville'		=> 'Churchville',
				'joppatowne'		=> 'Joppatowne',
				'whiteHall'			=> 'WhiteHall',
				'darlington'		=> 'Darlington',
				'monkton'			=> 'Monkton',
				'edgewood'			=> 'Edgewood',
				'perryman'			=> 'Perryman',
			);
			
			$County = array(
				'baldwin' 			=> 'Baltimore',
				'glyndon'			=> 'Baltimore',
				'phoenix-md'		=> 'Baltimore',
				'boring'			=> 'Baltimore',
				'bunt-valley'		=> 'Baltimore',
				'pikesville'		=> 'Baltimore',
				'brooklandville'	=> 'Baltimore',
				'hydes'				=> 'Baltimore',
				'reisterstown'		=> 'Baltimore',
				'butler'			=> 'Baltimore',
				'long-green'		=> 'Baltimore',
				'riderwood'			=> 'Baltimore',
				'catonsville'		=> 'Baltimore',
				'lutherville'		=> 'Baltimore',
				'sparks-glencoe'	=> 'Baltimore',
				'cockeysville'		=> 'Baltimore',
				'maryland-line'		=> 'Baltimore',
				'stevenson'			=> 'Baltimore',
				'fork'				=> 'Baltimore',
				'monkton'			=> 'Baltimore',
				'timonium'			=> 'Baltimore',
				'freeland'			=> 'Baltimore',
				'owings-mills'		=> 'Baltimore',
				'towson'			=> 'Baltimore',
				'glen-arm'			=> 'Baltimore',
				'parkton'			=> 'Baltimore',
				'upperco'			=> 'Baltimore',
				'finksburg'			=> 'Carroll',
				'lineboro'			=> 'Carroll',
				'sykesville'		=> 'Carroll',
				'eldersburg'		=> 'Carroll',
				'manchester-md'		=> 'Carroll',
				'westminster'		=> 'Carroll',
				'hampstead-md'		=> 'Carroll',
				'marriottsville'	=> 'Carroll',
				'abingdon'			=> 'Harford',
				'fallston'			=> 'Harford',
				'pylesville'		=> 'Harford',
				'baldwin'			=> 'Harford',
				'forestHill'		=> 'Harford',
				'street'			=> 'Harford',
				'belcamp'			=> 'Harford',
				'jarrettsville'		=> 'Harford',
				'whiteford'			=> 'Harford',
				'churchville'		=> 'Harford',
				'joppatowne'		=> 'Harford',
				'whiteHall'			=> 'Harford',
				'darlington'		=> 'Harford',
				'monkton'			=> 'Harford',
				'edgewood'			=> 'Harford',
				'perryman'			=> 'Harford',
			);
			
			$zipAdjuster = array(
			        'westminster'   => "21157,21158",
			        'finksburg'     => "21048",
			        'eldersburg'    => "21784",
			        'manchester-md' => "21102",
			        'hampstead-md'  => "21074"
			    );
			

			if( !( $locations[$location] ) ){
				redirect( base_url() . '404' );
				exit( );
			}
			
			$seoAdjuster = ( isset( $zipAdjuster[$location] ) ) ? " ".$zipAdjuster[$location] : "";
	
		  $headerdata['title']	          = "Plumber ".$locations[$location]." - Plumbing Services : Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Plumbers in ".$locations[$location].", Plumbing in ".$locations[$location].", Plumbers in ".$County[$location] . " County ".$seoAdjuster; 
	      $headerdata['description']	  = "Plumbing in ".$locations[$location]." Lessner Plumbing is quality plumber serving ".$locations[$location].$seoAdjuster.". We install residential pipes and plumbing. Popular residential plumbing systems that we install: Boiler and radiant heat systems Septic systems Sump pumps Water heaters Water softening and water treatment Well pumps &nbsp; We repair residential pipes and plumbing. Popular residential plumbing problems that we &hellip;";			  
		  
		  $data[ 'location' ] 	= $locations[$location]; 
		  $data[ 'county' ] 	= $County[$location]; 
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/plumber',$data);
          $this->load->view( 'frontend/footer');
	  }

	  public function gallery(){
	  	$location = 'glyndon';
	  	$locations = array(
				'baldwin' 			=> 'Baldwin',
				'glyndon'			=> 'Glyndon',
				'phoenix-md'		=> 'Phoenix, MD',
				'boring'			=> 'Boring',
				'bunt-valley'		=> 'Hunt Valley',
				'pikesville'		=> 'Pikesville',
				'brooklandville'	=> 'Brooklandville',
				'hydes'				=> 'Hydes',
				'reisterstown'		=> 'Reisterstown',
				'butler'			=> 'Butler',
				'long-green'		=> 'Long Green',
				'riderwood'			=> 'Riderwood',
				'catonsville'		=> 'Catonsville',
				'lutherville'		=> 'Lutherville',
				'sparks-glencoe'	=> 'Sparks Glencoe',
				'cockeysville'		=> 'Cockeysville',
				'maryland-line'		=> 'Maryland Line',
				'stevenson'			=> 'Stevenson',
				'fork'				=> 'Fork',
				'monkton'			=> 'Monkton',
				'timonium'			=> 'Timonium',
				'freeland'			=> 'Freeland',
				'owings-mills'		=> 'Owings Mills',
				'towson'			=> 'Towson',
				'glen-arm'			=> 'Glen Arm',
				'parkton'			=> 'Parkton',
				'upperco'			=> 'Upperco',
				'finksburg'			=> 'Finksburg',
				'lineboro'			=> 'Linebor',
				'sykesville'		=> 'Sykesville',
				'eldersburg'		=> 'Eldersburg',
				'manchester-md'		=> 'Manchester, MD',
				'westminster'		=> 'Westminster',
				'hampstead-md'		=> 'Hampstead, MD',
				'marriottsville'	=> 'Marriottsville',
				'abingdon'			=> 'Abingdon',
				'fallston'			=> 'Fallston',
				'pylesville'		=> 'Pylesville',
				'baldwin'			=> 'Baldwin',
				'forestHill'		=> 'ForestHill',
				'street'			=> 'Street',
				'belcamp'			=> 'Belcamp',
				'jarrettsville'		=> 'Jarrettsville',
				'whiteford'			=> 'Whiteford',
				'churchville'		=> 'Churchville',
				'joppatowne'		=> 'Joppatowne',
				'whiteHall'			=> 'WhiteHall',
				'darlington'		=> 'Darlington',
				'monkton'			=> 'Monkton',
				'edgewood'			=> 'Edgewood',
				'perryman'			=> 'Perryman',
			);
			
			if( !( $locations[$location] ) ){
				redirect( base_url() . '404' );
				exit( );
			}
	
		  $headerdata['title']	          = "Plumber ".$locations[$location]." - Plumbing Services : Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
	      $headerdata['keywords']	      = "Plumber ".$locations[$location].", Plumbing ".$locations[$location].""; 
	      $headerdata['description']	  = "Plumbing in ".$locations[$location]." Lessner Plumbing is quality plumber serving ".$locations[$location].". We install residential pipes and plumbing. Popular residential plumbing systems that we install: Boiler and radiant heat systems Septic systems Sump pumps Water heaters Water softening and water treatment Well pumps &nbsp; We repair residential pipes and plumbing. Popular residential plumbing problems that we &hellip;";			  
		  
		  $data[ 'location' ] 	= $locations[$location]; 
          $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/gallery',$data);
          $this->load->view( 'frontend/footer');
	  }
  }
?>