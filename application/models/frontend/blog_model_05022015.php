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
	  
	 public function loadmoreblog($lastid,$monthyear=NULL,$post_id=NULL) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' ) . " where status= '1' and postid < '" . $lastid ."' order by createdate desc  limit " . PAGELIMIT;
		  
		  
          $query = $this->db->query( $sql );
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	 public function check_moreblog($lastid=NULL,$monthyear=NULL,$post_id=NULL) {
	 
          $sql = "SELECT *  from " . $this->db->dbprefix( 'posts' )." where status= '1' "; 
		
		  
		  if(!empty($post_id)){
		  $sql   .= "and postid in (" . join(",", $post_id) .")";
		  }
		  
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
	  	  
	 public function blog_by_tags( $tagid,$year=NULL,$month=NULL ) {
          $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'posts' ) . ',' . $this->db->dbprefix( 'post_tags' ) . ' WHERE ' . $this->db->dbprefix( 'posts' ) . '.postid=' . $this->db->dbprefix( 'post_tags' ) . '.postid and   ' . $this->db->dbprefix( 'post_tags' ) . '.tagid = "'.$tagid.'" and ' . $this->db->dbprefix( 'post_tags' ) . '.status ="1" and  ' . $this->db->dbprefix( 'posts' ) . '.status ="1"'; 
          if($year !=""){
		  
		  $sql.=" and FROM_UNIXTIME(lp_posts.createdate, '%Y')= '" . $year .  "' ";
		  }
		  if($month !=""){
		  
		  $sql.=" and FROM_UNIXTIME(lp_posts.createdate, '%m')= '" . $month .  "' ";
		  }
		  $sql.=' order by ' . $this->db->dbprefix( 'posts' ) . '.createdate desc limit '.PAGELIMIT;
		  $query = $this->db->query( $sql);
          //print $this->db->last_query();
          return $query->result_array();
      }
	  
	 public function tagidbypostid($postid) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'post_tags' ) . " where postid= ".$postid." ";
          
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	 public function loadtags($tagid) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'tags' ) . " where tagid in (" . join(",", $tagid) .")";
          
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	 public function postidsbytagid($tagid) {
          $sql = "SELECT *  from " . $this->db->dbprefix( 'post_tags' ) . " where tagid= ".$tagid." ";
          
          $query = $this->db->query( $sql);
          //print $this->db->last_query(); 
          return $query->result_array();
      }
	  
	  public function loadmoreblogsbytags($lastid,$tagid,$year=NULL,$month=NULL ){
		  $sql   = 'SELECT * FROM ' . $this->db->dbprefix( 'posts' ) . ',' . $this->db->dbprefix( 'post_tags' ) . ' WHERE ' . $this->db->dbprefix( 'posts' ) . '.postid=' . $this->db->dbprefix( 'post_tags' ) . '.postid and   ' . $this->db->dbprefix( 'post_tags' ) . '.tagid = "'.$tagid.'" and ' . $this->db->dbprefix( 'post_tags' ) . '.status ="1" and  ' . $this->db->dbprefix( 'posts' ) . '.status ="1" and ' . $this->db->dbprefix( 'posts' ) . '.postid < '.$lastid; 
		  
          if($year !=""){
		  
		  $sql.=" and FROM_UNIXTIME(lp_posts.createdate, '%Y')= '" . $year .  "' ";
		  }
		  if($month !=""){
		  
		  $sql.=" and FROM_UNIXTIME(lp_posts.createdate, '%m')= '" . $month .  "' ";
		  }
		  $sql.='order by ' . $this->db->dbprefix( 'posts' ) . '.createdate desc limit '.PAGELIMIT;
		  $query = $this->db->query( $sql);
          //print $this->db->last_query();
          return $query->result_array();
	  
	  
	  }
	  
  }
?>