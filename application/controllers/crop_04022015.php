<?php
  /***********meera march 14 2014*****************/
  class Crop extends CI_Controller {
      public function __construct( ) {
          parent::__construct();
          $this->load->model( array(
              'admin/admin_model' 
          ) );
          $this->load->library( array(
               'corefunctions',
              'cropimage' 
          ) );
          
      }
      public function index( $type ) {
          
          $location        = "assets/tempImgs/";
          $tempStorage     = $location . "original/";
          $tempCropStorage = $location . "crop/";
          $haserror        = 0;
          
          /*
          allowed image upload types
          */
          $imageArray = array(
               "profile" => array(
                   "width" => 200,
                  "height" => 200,
                  "minwidth" => 200,
                  "minheight" => 200 
              ),
              "news" => array(
                   "width" => 230,
                  "height" => 250,
                  "minwidth" => 230,
                  "minheight" => 250 
              ),
              "estore" => array(
                   "width" => 230,
                  "height" => 250,
                  "minwidth" => 230,
                  "minheight" => 250 
              ),
              "userprofile" => array(
                   "width" => 200,
                  "height" => 200,
                  "minwidth" => 200,
                  "minheight" => 200 
              ),
              "post" => array(
                   "width" => 230,
                  "height" => 250,
                  "minwidth" => 230,
                  "minheight" => 250 
              ) 
          );
          /*
          allowed image upload types
          */
          if ( !array_key_exists( $type, $imageArray ) ) {
              exit;
          }
          $data[ "imageSizes" ] = $imageArray[ $type ];
          $data[ "view" ]       = 1;
          $data[ "type" ]       = $type;
          $data[ 'error' ]      = "";
          
          if ( isset( $_POST[ "fileupload" ] ) ) {
		  if(!isset( $_FILES[ 'myfile' ][ 'tmp_name' ][0])){
					  $haserror        = 1;
					  $data[ 'error' ] = 'Please upload an image';
				}else{
              $image = $_FILES[ 'myfile' ];
              list( $width, $height, $type, $attr ) = getimagesize( $image[ 'tmp_name' ] );
              if ( $width < $imageArray[ $_POST[ "imtype" ] ][ 'minwidth' ] || $height < $imageArray[ $_POST[ "imtype" ] ][ 'minheight' ] ) {
                  $haserror        = 1;
                  $data[ 'error' ] = 'Please upload an image of size greater than ' . $imageArray[ $_POST[ "imtype" ] ][ 'minwidth' ] . ' X ' . $imageArray[ $_POST[ "imtype" ] ][ 'minheight' ] . ' pixels';
                  
               }  
              }
              if ( $haserror != 1 ) {
                  $config[ 'upload_path' ]   = $tempStorage;
                  $config[ 'allowed_types' ] = 'gif|jpg|png|jpeg';
                  $config[ 'max_size' ]      = '7000';
                  $config[ 'max_width' ]     = '4000';
                  $config[ 'max_height' ]    = '4000';
                  
                  /* Generate Unique Key for image uploading */
                  $imgKey = $this->corefunctions->generateUniqueKey( '12', 'tempimage', 'tempimgkey' );
                  
                  /* Extension Details */
                  $ext                   = pathinfo( $_FILES[ 'myfile' ][ 'name' ], PATHINFO_EXTENSION );
                  $config[ 'file_name' ] = $fileName = $imgKey . "." . $ext;
                  
                  
                  $this->load->library( 'upload', $config );
                  if ( !$this->upload->do_upload( 'myfile' ) ) {
                      $data[ 'error' ] = $this->upload->display_errors();
                  } else {
                      $uploadData = $this->upload->data();
                      
                      /* Create Temporary Image Data */
                      $this->admin_model->create_temp_img( $imgKey, $ext, $uploadData[ "image_width" ], $uploadData[ "image_height" ] );
                      
                      $data[ 'image' ]     = array(
                           'upload_data' => $uploadData 
                      );
                      $data[ 'imagekey' ]  = $imgKey;
                      $data[ 'imageLink' ] = base_url() . $tempStorage . $fileName;
                      $data[ "view" ]      = 2;
                      $data[ 'error' ]     = "";
                  }
              }
          }
          
          
          if ( isset( $_POST[ "thumbnail" ] ) ) {
              $tempImageDetails = $this->admin_model->get_temp_det( $_POST[ "imagekey" ] );
              
              if ( !empty( $tempImageDetails ) ) {
                  $tempSource      = $tempStorage . $tempImageDetails[ "tempimgkey" ] . "." . $tempImageDetails[ "tempimgext" ];
                  $cropDestination = $tempCropStorage . $tempImageDetails[ "tempimgkey" ] . "." . $tempImageDetails[ "tempimgext" ];
                  
                  $data[ 'imageType' ] = $tempSource;
                  
                  list( $imagewidth, $imageheight, $imageType ) = getimagesize( $tempSource );
                  $imageType = image_type_to_mime_type( $imageType );
                  print "<pre>";
                  print_r( $imageType );
                  print "</pre>";
                  
                  switch ( $imageType ) {
                      case "image/gif":
                          $img_r = imagecreatefromgif( $tempSource );
                          break;
                      case "image/pjpeg":
                      case "image/jpeg":
                      case "image/jpg":
                          $img_r = imagecreatefromjpeg( $tempSource );
                          break;
                      case "image/png":
                      case "image/x-png":
                          $img_r = imagecreatefrompng( $tempSource );
                          break;
                  }
                  
                  //$img_r = imagecreatefromjpeg( $tempSource );
                  $dst_r = imagecreatetruecolor( $imageArray[ $type ][ 'width' ], $imageArray[ $type ][ 'height' ] );
                  //$dst_r = ImageCreateTrueColor( $imageArray[ $type ][ 'width' ], $imageArray[ $type ][ 'height' ] );
                  imagecopyresampled( $dst_r, $img_r, 0, 0, $_POST[ 'x1' ], $_POST[ 'y1' ], $imageArray[ $type ][ 'width' ], $imageArray[ $type ][ 'height' ], $_POST[ 'w' ], $_POST[ 'h' ] );
                  switch ( $imageType ) {
                      case "image/gif":
                          imagegif( $dst_r, $cropDestination );
                          break;
                      case "image/pjpeg":
                      case "image/jpeg":
                      case "image/jpg":
                          imagejpeg( $dst_r, $cropDestination, 90 );
                          break;
                      case "image/png":
                      case "image/x-png":
                          imagepng( $dst_r, $cropDestination );
                          break;
                  }
                  //imagejpeg( $dst_r, $cropDestination );
                  
                  $data[ 'imagekey' ]  = $tempImageDetails[ "tempimgkey" ];
                  $data[ 'imagePath' ] = base_url() . $cropDestination;
                  $data[ "view" ]      = 3;
                  
                  
              }
              
          }
          
          $this->load->view( 'crop', $data );
      }
  }