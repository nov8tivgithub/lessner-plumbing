<?php
  if ( !defined( 'BASEPATH' ) )
      exit( 'No direct script access allowed' );
  class Paginationlist extends CI_Model
  {
      public function __construct( )
      {
          $this->load->database();
      }
      public function getPagination( $totalcount, $perpage, $pageno = 1, $showpages = 3 )
      {
          if ( $totalcount != "" and $perpage != "" )
          {
              $totalpages = ceil( $totalcount / $perpage );
              $cur_page   = ceil( $pageno / $showpages );
              $from       = $showpages * ( $cur_page - 1 );
              $to         = $showpages * ( $cur_page );
              if ( $pageno > 1 )
              {
                  $pagination[ 'first' ][ 'pageno' ] = 1;
                  //$pagination['first']['start_lim'] = 0;
                  $pagination[ 'prev' ][ 'pageno' ]  = $pageno - 1;
                  //$pagination['prev']['start_lim'] = (($pageno-2)*$perpage);
              }
              if ( $pageno < $totalpages )
              {
                  $pagination[ 'next' ][ 'pageno' ] = $pageno + 1;
                  //$pagination['next']['start_lim'] = (($pageno)*$perpage);
                  $pagination[ 'last' ][ 'pageno' ] = $totalpages;
                  //$pagination['last']['start_lim'] = (($totalpages-1)*$perpage);
              }
              $pagination[ 'from' ] = $from;
              $pagination[ 'to' ]   = $to;
              for ( $i = $from; $i < $to && $i < $totalpages; $i++ )
              {
                  $pagination[ 'showpages' ][ $i + 1 ][ 'pageno' ] = $i + 1;
                  //$pagination['showpages'][$i+1]['start_lim'] = (($i)*$perpage);
              }
          }
          return $pagination;
      }
  }
?>