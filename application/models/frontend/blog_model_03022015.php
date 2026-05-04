<?php
  class Blog_Model extends CI_Model {
      public function __construct( ) {
          $this->load->database();
          $this->load->dbforge();
          $this->load->library( array(
               'corefunctions', 
          ) );
      }


      function loadbloglist($limit=NULL,$monthdate=NULL) {
          $sql   = "SELECT * FROM " . $this->db->dbprefix( 'posts' ) . " WHERE status='1'";
		  
		  if ( $monthdate != "" ) {
             $sql .= " and FROM_UNIXTIME(createdate, '%Y-%m')= '" . $monthdate .  "'";
          }
		  $sql .= " order by createdate desc";
		  if($limit != NULL){
			$sql .= " limit " . $limit;
		  }else{
			$sql .= " limit " . PAGELIMIT;
		  }
		  $query = $this->db->query( $sql, array(
		  
          ) );
          return $query->result_array();
          //print $this->db->last_query();
      }
	   	  
	  function loadblog($postkey) {
          $sql   = "SELECT * FROM " . $this->db->dbprefix( 'posts' ) . " WHERE postkey= ?";
          $query = $this->db->query( $sql, array(	$postkey	  
          ) );
          return $query->row_array();
          //print $this->db->last_query();
      }
	  
	 public function loadmoreblog($lastid) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1' and postid < '" . $lastid ."' order by createdate desc  limit " . PAGELIMIT;
          $query = $this->db->query( $sql );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	 public function check_moreblog($lastid=NULL,$monthyear=NULL) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1' "; 
		  if($lastid!=""){
		  $sql .= "and postid < '" . $lastid .  "' "; 
		  }
		  if ( $monthyear != "" ) {
             $sql .= " and FROM_UNIXTIME(createdate, '%Y-%m')= '" . $monthyear .  "'";
          }
		  $sql.="order by createdate desc ";
		  
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->row_array();
      }
	  
	 public function blog_bymonthyear( ) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1'  group by  FROM_UNIXTIME(createdate, '%Y-%m') order by createdate desc " ;
          $query = $this->db->query( $sql );
         // print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	 public function get_lastpost( ) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1' order by createdate desc limit 1";
          
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->row_array();
      }
	  
	 public function getallcat() {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'tags' ) . " where status= '1' order by tagname asc";
          
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	  
	  
  }
?>