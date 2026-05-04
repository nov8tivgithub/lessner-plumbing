<?php
  /* meera april 2014
  post controller exists
  1. post manager (create, edit, view, changepassowrd)
  3. login, forgot password, resetpassword
  4. if user or admin exists
  */
  
  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Posts extends CI_Controller
  {
      public function __construct( )
      {
          parent::__construct();
          $this->load->model( array(
                'admin/post_model',
               'admin/admin_model' 
          ) );
          $this->load->library( array(
               'corefunctions',
              'hedercontroller' 
          ) );
		   if ( !$this->session->userdata( 'adminKey' ) )
          {
              redirect( base_url( ADMIN ) );
          }
      }
      /*
      For remapping meera 
      check if a function exists
      or else redirect to 404
      */
      public function _remap( $method, $params = array( ) )
      {
          if ( method_exists( __CLASS__, $method ) )
          {
              $args = array_slice( $this->uri->rsegments, 2 );
              if ( method_exists( $this, $method ) )
              {
                  return call_user_func_array( array(
                       &$this,
                      $method 
                  ), $args );
              }
          }
          else
          {
              //redirect( base_url() . '404' );
              exit( );
          }
      }
      /*
      For remapping meera end 
      */
      /*
      post manager starts meera april 4 2014
      */
      public function postmanager( $status = 'Active', $alpha = NULL )
      {
          
          if ( $status == 'Active' )
              $stat = '1';
          elseif ( $status == 'Inactive' )
              $stat = '0';
          else
              $stat = '1';
          $post = $this->post_model->all_post( $stat, $alpha );
          $postlastid = 1;
          if ( !empty( $post ) )
          {
              foreach ( $post as $key => $postdet )
              {
                  if ( $postdet[ 'imgkey' ] != NULL )
                  {
                      $post[ $key ][ 'Img' ] = base_url($this->corefunctions->getMyPath( $postdet[ 'postid' ], $postdet[ 'imgkey' ], $postdet[ 'imgext' ], "assets/admin/post/crop/"));
                  }
                  else
                  {
                      $post[ $key ][ 'Img' ] = base_url("images/default.jpg");
                  }
                  $postlastid = $postdet[ 'postid' ];
              }
          }
          $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/blogmanager'),
              "title" => 'Blogs' 
          );
          $breadcum[ ]           = array(
              
               "title" => $status . ' Blogs' 
          );

          $data['loadmorediv']    = $this->post_model->checkloadmore($postlastid,$stat,$alpha);
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Blog Manager';
          $header[ 'titlecls' ]  = 'post';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
		      $header[ 'createurl' ]  = base_url().ADMIN.'/createblog';
		      $header[ 'pagetitle' ]  = 'Blogs';
          $data[ 'pageHeader' ] = $status . " Blogs";
          $data[ 'post' ]       = $post;
          $data[ 'alpha' ]      = $alpha;
          $data[ 'status' ]     = $status;
          
          $this->load->view(  'admin/header', $header );
          $this->load->view(  'admin/post/listing', $data );
          $this->load->view( 'admin/footer' );
      }
      
      public function changepoststatus( )
      {
          if ( !$this->session->userdata( 'adminKey' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( !$this->input->post( 'postkey' ) or !$this->input->post( 'status' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( $this->input->post( 'act' ) == 'statchange' )
          {
              if ( $this->input->post( 'status' ) == 'Activate' )
              {
                  $stat = '1';
                  $st   = '0';
              }
              elseif ( $this->input->post( 'status' ) == 'Deactivate' )
              {
                  $stat = '0';
                  $st   = '1';
              }
              $this->post_model->change_post_status( $this->input->post( 'postkey' ), $stat );
              $arr[ 'success' ] = 1;
              print json_encode( $arr );
              exit( );
          }
      }
      
      public function createpost( )
      {
          
          
          $tags = $this->post_model->all_tags( $stat='1' );
		
          if ( $this->input->post( 'addpost' ) == '1' )
          {
		  
		  
              $this->form_validation->set_rules( 'title', 'Title', 'required|xss_clean' );
			   $this->form_validation->set_rules( 'description', 'Description', 'required' );
   
              if ( $this->form_validation->run() === FALSE )
              {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              }
              else
              {
			  
                  $Id = $this->post_model->create_post();
                  if ( $this->input->post( 'tempimage' ) and $this->input->post( 'tempimage' ) != '' )
                  {
                      $tempImg      = $this->admin_model->get_temp_det( $this->input->post( 'tempimage' ) );
                      $originalpath = "assets/tempImgs/original/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $croppath     = "assets/tempImgs/crop/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $imgkey       = $this->corefunctions->generateUniqueKey( '12', 'posts', 'imgkey' );
                      $this->post_model->update_img_post( $Id, $imgkey, $tempImg[ 'tempimgext' ] );
                      $orgpath = $this->corefunctions->getMyPath( $Id, $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/post/original/' );
                      $cppath  = $this->corefunctions->getMyPath( $Id, $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/post/crop/' );
                      copy( $originalpath, $orgpath );
                      copy( $croppath, $cppath );
                  }
				  
				  if( $this->input->post('tags') ){
					foreach( $this->input->post('tags') as $tkey => $tvalue ){
						$post_tags = $this->post_model->insert_post_tags( $tvalue, $Id );
					}
				  }
                  redirect( base_url(ADMIN . '/blogmanager'));
                  exit;
              }
          }
          
          $header[ 'titlecls' ] = 'post';
          
          
          $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/blogmanager'),
              "title" => 'Blogs' 
          );
          $breadcum[ ]           = array(
              
               "title" => 'Create Blog' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Create Blog';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
		  //$header[ 'createurl' ]  = base_url().ADMIN.'/createblog';
		  $header[ 'pagetitle' ]  = 'Blogs';
		  $data[ 'tags' ]       = $tags;
          
          $this->load->view(  'admin/header', $header );
          $this->load->view(  'admin/post/create',$data );
          $this->load->view(  'admin/footer' );
      }
      
      public function editpost( $postkey = NULL )
      {
          
          if ( !$postkey )
          {
              redirect( base_url(ADMIN . '/blogmanager'));
              exit;
          }
          $post_by_key = $this->post_model->post_by_key( $postkey );
          if ( !$post_by_key )
          {
              redirect( base_url(ADMIN . '/blogmanager'));
              exit;
          }
          $tags = $this->post_model->all_tags( $stat='1' );
		  $posttags = $this->post_model->post_tags( $post_by_key['postid'] );
		  
          
		  if( !empty($tags) and !empty($posttags) ){
			foreach($tags as $kt => $kv){
				foreach($posttags as $pt => $pv){
					if($kv['tagid'] == $pv['tagid']){
						$tags[$kt]['checked'] = 1;
					}
				}
			}
		  }

          if ( $this->input->post( 'editpost' ) == '1' )
          {
		  
		  if($this->input->post( 'removeimg' ) != ''){
		  
		  $this->post_model->change_image_status( $this->input->post( 'removeimg' ) );
		  }
		  
              $this->form_validation->set_rules( 'title', 'Title', 'required|xss_clean' );
              $this->form_validation->set_rules( 'description', 'Description', 'required' );
              
              
              if ( $this->form_validation->run() === FALSE )
              {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              }
              else
              {
				  $this->post_model->del_post_tags( $post_by_key['postid'] );
				  
                  $this->post_model->post_update_by_key( $postkey );
				  
                  if ( $this->input->post( 'tempimage' ) and $this->input->post( 'tempimage' ) != '' )
                  {
                      $tempImg      = $this->admin_model->get_temp_det( $this->input->post( 'tempimage' ) );
                      $originalpath = "assets/tempImgs/original/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $croppath     = "assets/tempImgs/crop/" . $this->input->post( 'tempimage' ) . '.' . $tempImg[ 'tempimgext' ];
                      $imgkey       = $this->corefunctions->generateUniqueKey( '12', 'posts', 'imgkey' );
                      $this->post_model->update_img_post( $post_by_key[ 'postid' ], $imgkey, $tempImg[ 'tempimgext' ] );
                      $orgpath = $this->corefunctions->getMyPath( $post_by_key[ 'postid' ], $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/post/original/' );
                      $cppath  = $this->corefunctions->getMyPath( $post_by_key[ 'postid' ], $imgkey, $tempImg[ 'tempimgext' ], 'assets/admin/post/crop/' );
                      copy( $originalpath, $orgpath );
                      copy( $croppath, $cppath );
                  }
				   if( $this->input->post('tags') ){
					foreach( $this->input->post('tags') as $tkey => $tvalue ){
						$post_tags = $this->post_model->insert_post_tags( $tvalue, $post_by_key['postid'] );
					}
				  }
                  redirect( base_url(ADMIN . '/blogmanager'));
                  exit;
              }
          }
          
          if ( $post_by_key[ 'imgkey' ] )
          {
              $post_by_key[ 'img' ] = base_url($this->corefunctions->getMyPath( $post_by_key[ 'postid' ], $post_by_key[ 'imgkey' ], $post_by_key[ 'imgext' ], "assets/admin/post/crop/"));
          }
          else
          {
              //$post_by_key[ 'img' ] = base_url() . "images/defltimg.png";
          }
          $data[ 'postDet' ]    = $post_by_key;
          $data[ 'tags' ]    = $tags;
          $header[ 'titlecls' ] = 'post';
          
          
          $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/blogmanager'),
              "title" => 'Blogs' 
          );
          $breadcum[ ]           = array(
              
               "title" => 'Edit Blog' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Edit Blog';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
		  //$header[ 'createurl' ]  = base_url().ADMIN.'/createblog';
		  $header[ 'pagetitle' ]  = 'Blogs';
          
          $this->load->view(  'admin/header', $header );
          $this->load->view(  'admin/post/edit', $data );
          $this->load->view(  'admin/footer' );
      }
      public function changepostimage( )
      {
	  	//print_r($this->input->post());
          if ( !$this->session->userdata( 'adminKey' ) )
          {
             
              print 'error';
              exit( );
          }
          if ( !$this->input->post( 'postkey' ) )
          {
              print 'error';
              exit( );
          }
		 if ( $this->input->post( 'act' ) == 'removeimage' ) {
              $this->post_model->change_image_status( $this->input->post( 'postkey' ) );
              print 'success';
              exit( );
          } 
          
      }
      
	   public function tags( $status = 'Active', $alpha = NULL )
      {
          
          if ( $status == 'Active' )
              $stat = '1';
          elseif ( $status == 'Inactive' )
              $stat = '0';
          else
              $stat = '1';
			  
		  if ( $this->input->post( 'addtag' ) == '1' )
          {
              $this->form_validation->set_rules( 'tagname', 'Tag Name', 'required|xss_clean' );
              
              if ( $this->form_validation->run() === FALSE )
              {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              }
              else
              {
				
				$checkTagname = $this->post_model->checkTagname( $this->input->post('tagname') );
				
				if( $checkTagname ){
					 $data[ 'haserror' ] = TRUE;
                     $data[ 'errormsg' ] = "Tag already exists.";
				}else{
					$tagID = $this->post_model->createTags();
					  
					  redirect( base_url(ADMIN . '/categories'));
					  exit;
				 }
              }
          }
		  
          $tags = $this->post_model->all_tags( $stat, $alpha );
         
          $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/blogmanager'),
              "title" => 'Blogs' 
          );
		  $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/categories'),
              "title" => 'Categories' 
          );
          $breadcum[ ]           = array(
              
               "title" => $status . ' Categories' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Category Manager';
          $header[ 'titlecls' ]  = 'post';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
	    // $header[ 'createurl' ]  = base_url().ADMIN.'/categories';
		  $header[ 'pagetitle' ]  = 'Categories';
          
          $data[ 'pageHeader' ] = $status . " Category";
          $data[ 'tags' ]       = $tags;
          $data[ 'alpha' ]      = $alpha;
          $data[ 'status' ]     = $status;
          
          $this->load->view(  'admin/header', $header );
          $this->load->view( 'admin/post/tags', $data );
          $this->load->view(  'admin/footer' );
      }
	  
	  public function changetagstatus(){
	  
	   if ( !$this->session->userdata( 'adminKey' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( !$this->input->post( 'tagkey' ) or !$this->input->post( 'status' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( $this->input->post( 'act' ) == 'statchange' )
          {
              if ( $this->input->post( 'status' ) == 'Activate' )
              {
                  $stat = '1';
                  $st   = '0';
              }
              elseif ( $this->input->post( 'status' ) == 'Deactivate' )
              {
                  $stat = '0';
                  $st   = '1';
              }
              $this->post_model->change_tag_status( $this->input->post( 'tagkey' ), $stat );
				
			   $tagstat =	$this->post_model->tag_by_key($this->input->post( 'tagkey' ));
				
              $this->post_model->change_posttag_status( $tagstat['tagid'], $stat );
              $arr[ 'success' ] = 1;
              print json_encode( $arr );
              exit( );
          }
		
	  }
	  
	  public function edittag( $tagkey = NULL )
      {
          
          if ( !$tagkey )
          {
              redirect( base_url(ADMIN . '/blogmanager'));
              exit;
          }
          $tag_by_key = $this->post_model->tag_by_key( $tagkey );
          if ( !$tag_by_key )
          {
              redirect( base_url(ADMIN . '/categories'));
              exit;
          }
          
          
          if ( $this->input->post( 'edittag' ) == '1' )
          {
              $this->form_validation->set_rules( 'tagname', 'Tag Name', 'required|xss_clean' );
             
              
              if ( $this->form_validation->run() === FALSE )
              {
                  $data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Please enter required details";
              }
              else
              {
				  $checkTagname = $this->post_model->checkTagname( $this->input->post('tagname'), $tag_by_key['tagid'] );
				  
				  if($checkTagname){
					$data[ 'haserror' ] = TRUE;
                  $data[ 'errormsg' ] = "Tag already exists";
				  }else{
					  $this->post_model->tag_update_by_key( $tagkey );
					 
					  redirect( base_url(ADMIN . '/categories'));
					  exit;
				  }
              }
          }
          
          $data[ 'tagDets' ]    = $tag_by_key;
          $header[ 'titlecls' ] = 'post';
          
          
          $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/blogmanager'),
              "title" => 'Blogs' 
          );
		  $breadcum[ ]           = array(
               "url" => base_url(ADMIN . '/categories'),
              "title" => 'Categories' 
          );
          $breadcum[ ]           = array(
              
               "title" => 'Edit Category' 
          );
          $header[ 'breadcum' ]  = $breadcum;
          $header[ 'title' ]     = TITLE . 'Edit Category';
          $header[ 'hederdata' ] = $this->hedercontroller->headerdata();
		  //$header[ 'createurl' ]  = base_url().ADMIN.'/editcategory';
		  $header[ 'pagetitle' ]  = 'Categories';
          
          $this->load->view(  'admin/header', $header );
          $this->load->view(  'admin/post/edittag', $data );
          $this->load->view(  'admin/footer' );
      }



   public function getmoreblogs( )
      {
          if ( !$this->session->userdata( 'adminKey' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( !$this->input->post( 'postkey' ) or !$this->input->post( 'act' ) )
          {
              $arr[ 'error' ] = 1;
              print json_encode( $arr );
              exit( );
          }
          if ( $this->input->post( 'act' ) == 'getmore' )
          {

            $lastpost = $this->post_model->post_by_key($this->input->post( 'postkey' ));
            $postlastid   = $lastpost['postid'];
            $postlastkey = '';
            $st = $this->input->post( 'status' );
            $status = ($st == 'Active') ? '1' : '0';
            $post    = $this->post_model->all_post_loadmore( $status, $this->input->post( 'alpha' ), $postlastid);  

            if ( !empty( $post ) )
            {
                foreach ( $post as $key => $postdet )
                {
                    if ( $postdet[ 'imgkey' ] != NULL )
                    {
                        $post[ $key ][ 'Img' ] = base_url($this->corefunctions->getMyPath( $postdet[ 'postid' ], $postdet[ 'imgkey' ], $postdet[ 'imgext' ], "assets/admin/post/crop/"));
                    }
                    else
                    {
                        $post[ $key ][ 'Img' ] = base_url("images/default.jpg");
                    }
                    $postlastid = $postdet[ 'postid' ];
                    $postlastkey = $postdet[ 'postkey' ];
                }
            }
              $arr['loadmorediv']    = $this->post_model->checkloadmore($postlastid,$status, $this->input->post( 'alpha' ));
              $data[ 'post' ] = $post;
              $arr[ 'postlastkey' ] = $postlastkey;
              $arr[ 'success' ] = 1;
              $arr['page']      = $this->load->view('admin/post/listingajax', $data, TRUE);
              header('Content-Type: application/json');              
              print json_encode( $arr );
              exit( );
          }
      }


  }
?>