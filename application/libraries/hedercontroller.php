<?php
  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Hedercontroller extends CI_Model
  {
      function __construct( )
      {
          parent::__construct();
          $this->load->model( array(
               'admin/admin_model'
            
          ) );
      }
      
      public function headerdata( )
      {
          
          $header[ 'adminCount' ]  = $this->admin_model->all_admins_count();
          
          return $header;
      }
  }
?>