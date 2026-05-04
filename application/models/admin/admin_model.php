<?php
  class Admin_model extends CI_Model {
      public function __construct( ) {
          $this->load->database();
          $this->load->dbforge();
          $this->load->library( array(
               'corefunctions' 
          ) );
      }
	  public function countryList( ) {
          $sql   = "SELECT * FROM " . $this->db->dbprefix( 'country' ) . "";
          $query = $this->db->query( $sql );
          //print $this->db->last_query();
          return $query->result_array();
      }
      /*
      Login
      Forgotpassword
      and resetpassword starts
      */
      public function filter( $data ) {
          $data = trim(  strip_tags( $data )  );
          return $data;
      }
      public function check_login_creds( $email, $password ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'admins' ) . ' WHERE email = ? AND password = ?  limit 1';
          $query = $this->db->query( $sql, array(
               $email,
              $password 
          ) );
          //print $this->db->last_query();
          return $query->row_array();
      }
      public function check_admin_by_email( $email ) {
          $sql   = 'SELECT adminid, adminkey, firstname, lastname, email,status FROM ' . $this->db->dbprefix( 'admins' ) . ' WHERE email = ? limit 1';
          $query = $this->db->query( $sql, array(
               $email 
          ) );
          //print $this->db->last_query();
          return $query->row_array();
      }
      public function update_passwordkey( $adminid, $key ) {
          $data = array(
               'passwrdkey' => $key 
          );
          $this->db->where( 'adminid', $adminid );
          $this->db->update( 'admins', $data );
      }
      public function recoverkey_exists( $passwrdkey ) {
          $sql   = 'select * from ' . $this->db->dbprefix( 'admins' ) . ' where passwrdkey = ? limit 1';
          $query = $this->db->query( $sql, array(
               $passwrdkey 
          ) );
          return $query->row_array();
      }
      public function update_password( $adminid, $password ) {
          $data = array(
               'password' => $password 
          );
          $this->db->where( 'adminid', $adminid );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
      public function update_lastlogin( $adminid ) {
          $data = array(
               'lastlogindate' => time() 
          );
          $this->db->where( 'adminid', $adminid );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
      /*
      Login
      Forgotpassword
      and resetpassword ends
      */
      /*
      admin manager starts
      */
      public function all_admins( $status = '1', $alpha = NULL ) {
          $sql = 'SELECT *  from ' . $this->db->dbprefix( 'admins' ) . ' where status= ? ';
          if ( $alpha != "" )
              $sql .= "and firstname LIKE '$alpha%'  ";
          $sql .= "order by firstname asc  ";
          $query = $this->db->query( $sql, array(
               $status 
          ) );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
      public function change_admin_status( $adminkey, $status ) {
          $data = array(
               'status' => $status 
          );
          $this->db->where( 'adminkey', $adminkey );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
      public function get_states( ) {
          $this->db->order_by( "state_prefix", "asc" );
          $query = $this->db->get( "state" );
          //print $this->db->last_query();
          return $query->result_array();
      }
      public function create_admin( $adminkey, $password ) {
          $data = array(
               'firstname' => $this->filter( $this->input->post( 'firstname' ) ),
              'lastname' => $this->filter( $this->input->post( 'lastname' ) ),
              'address' => $this->filter( $this->input->post( 'address' ) ),
              'city' => $this->filter( $this->input->post( 'city' ) ),
              'phone' => $this->filter( $this->input->post( 'phone' ) ),
              'mobile' => $this->filter( $this->input->post( 'mobile' ) ),
              'state' => $this->filter( $this->input->post( 'state' ) ),
              'zip' => $this->filter( $this->input->post( 'zip' ) ),
              'password' => $password,
              'adminkey' => $adminkey,
              'email' => $this->input->post( 'email' ),
              'createdate' => time() 
          );
          $this->db->insert( 'admins', $data );
          $insert_id = $this->db->insert_id();
          $this->db->trans_complete();
          //print $this->db->last_query();
          return $insert_id;
      }
      public function admin_update_by_key( $adminkey ) {
          $data = array(
               'firstname' => $this->filter( $this->input->post( 'firstname' ) ),
              'lastname' => $this->filter( $this->input->post( 'lastname' ) ),
              'address' => $this->filter( $this->input->post( 'address' ) ),
              'city' => $this->filter( $this->input->post( 'city' ) ),
              'phone' => $this->filter( $this->input->post( 'phone' ) ),
              'mobile' => $this->filter( $this->input->post( 'mobile' ) ),
              'state' => $this->filter( $this->input->post( 'state' ) ),
              'zip' => $this->filter( $this->input->post( 'zip' ) ),
              'updatedate' => time() 
          );
          $this->db->where( 'adminkey', $adminkey );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
      public function check_adminemail_exists( $email ) {
          $myarray = array(
               "email" => $email 
          );
          $query   = $this->db->get_where( "admins", $myarray );
          // print $this->db->last_query();
          return $query->row_array();
      }
      public function admin_by_key( $adminkey ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'admins' ) . ' WHERE adminkey = ?  limit 1';
          $query = $this->db->query( $sql, array(
               $adminkey 
          ) );
          //print $this->db->last_query();
          return $query->row_array();
      }
      public function change_admin_password( $adminid, $password ) {
          $data = array(
               'password' => $password 
          );
          $this->db->where( 'adminid', $adminid );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
      public function all_admins_count( ) {
          $sql      = "SELECT count(adminid) as tot  from " . $this->db->dbprefix( 'admins' ) . " where status='1'";
          $query    = $this->db->query( $sql );
          $totadmin = $query->row_array();
          //print $this->db->last_query();
          return $totadmin[ 'tot' ];
      }
      /*
      admin manager ends
      */
     
     
      public function create_temp_img( $tempimgkey, $tempimgext, $width, $height ) {
          $data = array(
               'tempimgkey' => $tempimgkey,
              'tempimgext' => $tempimgext,
              'width' => $width,
              'height' => $height,
              'createdate' => time() 
          );
          $this->db->insert( 'tempimage', $data );
          $insert_id = $this->db->insert_id();
          $this->db->trans_complete();
          //print $this->db->last_query();
          return $insert_id;
      }
      public function get_temp_det( $key ) {
          $myarray = array(
               "tempimgkey" => $key 
          );
          $query   = $this->db->get_where( "tempimage", $myarray );
          // print $this->db->last_query();
          return $query->row_array();
      }
      public function update_img_admin( $adminid, $imgkey, $imgext ) {
          $data = array(
               'imgkey' => $imgkey,
              'imgext' => $imgext 
          );
          $this->db->where( 'adminid', $adminid );
          $this->db->update( 'admins', $data );
          //print $this->db->last_query();
      }
    
      
  }
?>