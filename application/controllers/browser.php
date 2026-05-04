<?php
  /***********meera march 14 2014*****************/
  class Browser extends CI_Controller {
      public function __construct( ) {
          parent::__construct();
      }
	  
      /**Javascript check **/
      public function jcheck( ) {
          $data[ 'title' ] = TITLE . 'Javascript Error';
          $this->load->view( 'scriptcheck', $data );
      }
      /**Javascript check end **/
	  
      /**browser check **/
      public function browsercheck( ) {
          $this->load->helper( 'url' );
          $this->load->library( 'user_agent' );
          /*if ($this->agent->browser() == 'Internet Explorer' and $this->agent->version() <= 7)
          redirect('/unsupported-browser');*/
      }
      /**browser check end**/
	  
	  
	  
  }