<?php
  class Post_model extends CI_Model {
      public function __construct( ) {
          $this->load->database();
          $this->load->dbforge();
          $this->load->library( array(
               'corefunctions' 
          ) );
      }
      
      public function filter( $data ) {
          $data = trim(  strip_tags( $data )  );
          return $data;
      }
      /*
      postS manager starts
      */
      public function all_post( $status = '1', $alpha = NULL, $createdate = NULL ) {
          $sql = 'SELECT *  from ' . $this->db->dbprefix( 'posts' ) . ' where status= ? ';
          if ( $alpha != "" ) {
              $sql .= "and title LIKE '$alpha%'  ";
          }
          $sql .= " order by createdate desc limit ". PAGE_LIMIT;
          $query = $this->db->query( $sql, array(
               $status 
          ) );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
      public function change_post_status( $postkey, $status ) {
          $data = array(
               'status' => $status 
          );
          $this->db->where( 'postkey', $postkey );
          $this->db->update( 'posts', $data );
          //print $this->db->last_query();
      }
      public function create_post( ) {
          $postkey = $this->corefunctions->generateUniqueKey( '15', 'posts', 'postkey' );
          $data    = array(
               'title' => $this->filter( $this->input->post( 'title' ) ),
              'description' => $this->input->post( 'description'),
              'url' => $this->filter( $this->input->post( 'url' ) ),
              'embedcode' =>html_entity_decode ($this->input->post( 'embedcode' ) ),
              'postkey' => $postkey,
              'createdby' => $this->session->userdata( 'adminId' ),
              'createdate' => time() 
          );
          $this->db->insert( 'posts', $data );
          $insert_id = $this->db->insert_id();
          $this->db->trans_complete();
          //print $this->db->last_query();
          return $insert_id;
      }
      public function post_update_by_key( $postkey ) {
          $data = array(
               'title' => $this->filter( $this->input->post( 'title' ) ),
              'description' =>$this->input->post( 'description'),
              'url' => $this->filter( $this->input->post( 'url' ) ),
              'embedcode' => html_entity_decode( $this->input->post( 'embedcode' ) ),
              'updatedate' => time() 
          );
          $this->db->where( 'postkey', $postkey );
          $this->db->update( 'posts', $data );
          //print $this->db->last_query();
      }
      public function post_by_key( $postkey ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'posts' ) . ' WHERE postkey = ?  limit 1';
          $query = $this->db->query( $sql, array(
               $postkey 
          ) );
          //print $this->db->last_query();
          return $query->row_array();
      }
      public function all_post_count( ) {
          $sql      = "SELECT count(postid) as tot  from " . $this->db->dbprefix( 'posts' ) . " where status='1'";
          $query    = $this->db->query( $sql );
          $totadmin = $query->row_array();
          //print $this->db->last_query();
          return $totadmin[ 'tot' ];
      }
      public function update_img_post( $postid, $imgkey, $imgext ) {
          $data = array(
               'imgkey' => $imgkey,
              'imgext' => $imgext 
          );
          $this->db->where( 'postid', $postid );
          $this->db->update( 'posts', $data );
          //print $this->db->last_query();
      }
      public function change_image_status( $postkey ) {
          $data = array(
               'imgkey' => '',
              'imgext' => '',
              'updatedate' => time() 
          );
          $this->db->where( 'postkey', $postkey );
          $this->db->update( 'posts', $data );
          //print $this->db->last_query();
      }
      public function get_postyears( ) {
          $sql   = 'SELECT FROM_UNIXTIME(createdate,"%Y") as year  from ' . $this->db->dbprefix( 'posts' ) . ' where status= "1" GROUP BY FROM_UNIXTIME(createdate,"%Y") order by createdate DESC';
          $query = $this->db->query( $sql );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
      public function get_postby_monthandyear( $year, $month ) {
          $sql   = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1' and FROM_UNIXTIME(createdate, '%Y')='" . $year . "'and FROM_UNIXTIME(createdate, '%m')='" . $month . "' order by createdate desc";
          $query = $this->db->query( $sql );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
      /*
      post manager ends
      */
	    /*
      tag manager starts
      */
	   public function all_tags( $status = '1', $alpha = NULL) {
          $sql = 'SELECT *  from ' . $this->db->dbprefix( 'tags' ) . ' where status= ? ';
          if ( $alpha != "" ) {
              $sql .= "and tagname LIKE '$alpha%'  ";
          }
		$sql .= "order by tagname asc  ";

          $query = $this->db->query( $sql, array(
               $status 
          ) );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	    public function post_tags( $postid ) {
          $sql   = "SELECT * FROM " . $this->db->dbprefix( 'post_tags' ) . " WHERE postid = ? ";
		
          $query = $this->db->query( $sql, array(
               $postid 
          ) );
         // print $this->db->last_query();
          return $query->result_array();
      }
		public function insert_post_tags( $tagid, $postid){
		
          $data    = array(
              'tagid' => $tagid,
              'postid' => $postid,
			 // 'tagname'=> $tagname,
              'createdate' => time() 
          );
          $this->db->insert( 'post_tags', $data );
          $insert_id = $this->db->insert_id();
          $this->db->trans_complete();
          //print $this->db->last_query();
          return $insert_id;
	  }
	  
	   public function del_post_tags( $postid ){
		$sql   = "DELETE FROM " . $this->db->dbprefix( 'post_tags' ) . " WHERE postid = ? ";
		
          $query = $this->db->query( $sql, array(
               $postid 
          ) );
         // print $this->db->last_query();
          
	  }
	  public function checkTagname( $tagname, $tagid=NULL ){
	  $tag = $this->filter($tagname);

		 $sql = 'SELECT * FROM ' .$this->db->dbprefix( 'tags' ) . ' where tagname = ?  ';
		 if($tagid!=''){
			$sql .= 'and tagid!= ? ';
		 }
		 $query = $this->db->query( $sql, array(
               $tag,
			   $tagid
          ) );
		 // print $this->db->last_query(); 
          return $query->result_array();
		  
	  }

		public function createTags(){
		$tagkey = $this->corefunctions->generateUniqueKey( '15', 'tags', 'tagkey' );
          $data    = array(
               'tagname' => $this->filter( $this->input->post( 'tagname' ) ),
              'tagkey' => $tagkey,
              'createdate' => time() 
          );
          $this->db->insert( 'tags', $data );
          $insert_id = $this->db->insert_id();
          $this->db->trans_complete();
          //print $this->db->last_query();
          return $insert_id;
	  }	
	   
	   public function change_tag_status( $tagkey, $status ){
		$data = array(
               'status' => $status 
          );
          $this->db->where( 'tagkey', $tagkey );
          $this->db->update( 'tags', $data );
          //print $this->db->last_query();
	  }
	  
	  public function change_posttag_status( $tagid, $status ){
		$data = array(
               'status' => $status 
          );
          $this->db->where( 'tagid', $tagid );
          $this->db->update( 'post_tags', $data );
          //print $this->db->last_query();
	  }

		public function tag_by_key( $tagkey ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'tags' ) . ' WHERE tagkey = ?  limit 1';
          $query = $this->db->query( $sql, array(
               $tagkey 
          ) );
          //print $this->db->last_query();
          return $query->row_array();
      }
	
		  public function tag_update_by_key( $tagkey ) {
          $data = array(
               'tagname' => $this->filter( $this->input->post( 'tagname' ) ),
              'updatedate' => time() 
          );
          $this->db->where( 'tagkey', $tagkey );
          $this->db->update( 'tags', $data );
          //print $this->db->last_query();
      }
	  
      /// kurian addition load more 19-01-2018///

      public function checkloadmore( $postid,$status,$alpha ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'posts' ) . ' where status = ? and postid < ?';
          if($alpha != ""){
            $sql .= " and title LIKE '$alpha%' ";
          }
          $sql .=' limit 1';
          $query = $this->db->query( $sql, array(
               $status,$postid 
          ) );
          //print $this->db->last_query();
          $loadmr = $query->row_array();
          return (empty($loadmr)) ? '0' : '1'; 
      }

      public function all_post_loadmore( $status, $alpha, $postid ) {
          $sql = 'SELECT *  from ' . $this->db->dbprefix( 'posts' ) . ' where status= ? ';
          if ( $alpha != "" ) {
              $sql .= "and title LIKE '$alpha%'  ";
          }
          $sql .= " and postid < ? order by createdate desc limit ". PAGE_LIMIT;
          $query = $this->db->query( $sql, array(
               $status,$postid 
          ) );
          //print $this->db->last_query(); 
          return $query->result_array();
      }  

		
  }
?>