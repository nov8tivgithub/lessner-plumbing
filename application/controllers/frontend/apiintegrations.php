<?php

  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Apiintegrations extends CI_Controller {
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
          //echo FCPATH; exit;
          //echo FCPATH.'/google-api-php-client/vendor/autoload.php'; exit;
          //require_once '../../../google-api-php-client/vendor/autoload.php';
          
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
      
      public function googlephotos() {
          //include_once FCPATH.'/google-api-php-client/vendor/autoload.php';
          //include_once FCPATH."/google-api-php-client/templates/base.php";
          
          # create client
            /* $client = new Google_Client();
            $client -> setApplicationName("lessner-plumbing");
            
            $apiKey = 'AIzaSyA21eIKPMqKRCV7HxrbHvz2ABYoEQ602ZI';
            //if(!$apiKey = getApiKey()) {
            //    echo missingApiKeyWarning();
            //}
            
            $client -> setDeveloperKey($apiKey);
            
            $response = file_get_contents('https://photoslibrary.googleapis.com/v1/albums',TRUE);
$response = json_decode($response);
echo $response;

exit; */
		  
		  $data[ 'blogdata' ]       = array(); 
		  $headerdata['activeclass']	  = "home"; 
          $headerdata['title']	          = "Home: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
		  $headerdata['keywords']	      = "Baltimore Metro Area, Residential, Commercial Plumbing Services,"; 
		  $headerdata['description']	  = "Lessner Plumbing is a family owned and operated company.Lessner Plumbing is company offering full residential and commercial plumbing services to Baltimore metro area."; 		  
          
		  $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/googlephotos',$data);
          $this->load->view( 'frontend/footer');
      }
      
      
      public function youtubevideos() {
          //include_once FCPATH.'/google-api-php-client/vendor/autoload.php';
          //include_once FCPATH."/google-api-php-client/templates/base.php";
          
          # create client
            /* $client = new Google_Client();
            $client -> setApplicationName("lessner-plumbing");
            
            $apiKey = 'AIzaSyA21eIKPMqKRCV7HxrbHvz2ABYoEQ602ZI';
            //if(!$apiKey = getApiKey()) {
            //    echo missingApiKeyWarning();
            //}
            
            $client -> setDeveloperKey($apiKey);
            
            $response = file_get_contents('https://photoslibrary.googleapis.com/v1/albums',TRUE);
$response = json_decode($response);
echo $response;

exit; */
		  
		  $data[ 'blogdata' ]       = array(); 
		  $headerdata['activeclass']	  = "home"; 
          $headerdata['title']	          = "Home: Lessner Plumbing : Licensed  & Insured Plumbing Services | Baltimore Metro Area | 410-746-8415"; 		  
		  $headerdata['keywords']	      = "Baltimore Metro Area, Residential, Commercial Plumbing Services,"; 
		  $headerdata['description']	  = "Lessner Plumbing is a family owned and operated company.Lessner Plumbing is company offering full residential and commercial plumbing services to Baltimore metro area."; 		  
          
		  $this->load->view( 'frontend/header',$headerdata);		  
          $this->load->view( 'frontend/youtubevideos',$data);
          $this->load->view( 'frontend/footer');
      }
      
  }
?>