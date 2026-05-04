<?php
if (!defined('BASEPATH'))
      exit('No direct script access allowed');
  class Dates extends CI_Model
  {
	
		public function __construct(){
			
		}
		
		public function DisplydaterangeArray(){
			$arr = array(1 => 'All Dates',
						 2 => 'Custom', 
						 3 => 'Today', 
						 //4 => 'This Week' ,
						 5 => 'This Week-to-date', 
						 //6 => 'This month', 
						 7 => 'This month -to-date',
						 //8 => 'This Quarter', 
						 9 => 'This Quarter-to-date', 
						 //10 => 'This Year',
						 11 => 'This-year-to-date', 
						 12 => 'Yesterday', 
						 13 => 'Last Week',
						 14 => 'Last Week-to-date',
						 15 => 'Last Month', 
						 16 => 'Last Month-to-date', 
						 17 => 'Last Quarter' ,
						 18 => 'Last Quarter-to-date',
						 19 => 'Last Year', 
						 20 => 'Last Year-to-date',
						 21 => 'Since 30 Days Ago', 
						 22 => 'Since 60 Days Ago', 
						 23 => 'Since 90 Days Ago',
						 24 => 'Since 365 Days Ago');
			return $arr;
		}
		
		public function getDaterange($duration,$startDate=NULL,$endDate=NULL){
		
			function get_quarter($i=0) {
				$y = date('Y');
				$m = date('m');
				if($i > 0) {
					for($x = 0; $x < $i; $x++) {
						if($m <= 3) { $y--; }
						$diff = $m % 3;
						$m = ($diff > 0) ? $m - $diff:$m-3;
						if($m == 0) { $m = 12; }
					}
				}
				switch($m) {
					case $m >= 1 && $m <= 3:
						$start = $y.'-01-01 00:00:01';
						$end = $y.'-03-31 00:00:00';
						break;
					case $m >= 4 && $m <= 6:
						$start = $y.'-04-01 00:00:01';
						$end = $y.'-06-30 00:00:00';
						break;
					case $m >= 7 && $m <= 9:
						$start = $y.'-07-01 00:00:01';
						$end = $y.'-09-30 00:00:00';
						break;
					case $m >= 10 && $m <= 12:
						$start = $y.'-10-01 00:00:01';
						$end = $y.'-12-31 00:00:00';
							break;
				}
				return array(
					'start' => $start,
					'end' => $end,
					'start_nix' => strtotime($start),
					'end_nix' => strtotime($end)							
				);
			}
		
			switch($duration){
				case 1  : 	$startDate  = "";
						  	$endDate    = "";
						  	break;
							
				case 2 	: 	$startDate  = $startDate;
						 	$endDate    = $endDate;
						 	break;
							
				case 3 	: 	$startDate  = date('m/d/Y') ;
						 	$endDate  	= date('m/d/Y');
						 	break;
							
				case 4 	: 	if(date('w')==0){ $startDate  = date('m/d/Y'); }else {  $startDate  = date('m/d/Y',strtotime('last sunday')); }
						 	if(date('w')==6){ $endDate  = date('m/d/Y'); }else {  $endDate  = date('m/d/Y',strtotime('next monday')); }
						 	break;
							
				case 5 	: 	if(date('w')==0){ $startDate  = date('m/d/Y'); }else {  $startDate  = date('m/d/Y',strtotime('last sunday')); }
						 	$endDate  	= date('m/d/Y');
						 	break;
							
				case 6 	: 	$startDate  = date('m/d/Y',strtotime('first day of this month'));
						 	$endDate  	= date('m/d/Y',strtotime('last day of this month'));
						 	break;
							
				case 7 	: 	$startDate  = date('m/d/Y',strtotime('first day of this month'));
						 	$endDate  	= date('m/d/Y');
						 	break;
							
				case 8 	: 	$thisquarter  = get_quarter(0);
						 	$startDate    =  date('m/d/Y',$thisquarter['start_nix']);		
						 	$endDate  	  = date('m/d/Y',$thisquarter['end_nix']);
						 	break;
							
				case 9 	: 	$thisquarter  = get_quarter(0);
						 	$startDate  = date('m/d/Y',$thisquarter['start_nix']);	
						 	$endDate  	= date('m/d/Y');
						 	break;
							
				case 10 	: 	$startDate  = "01/01/".date("Y");
						 	$endDate  	= "12/31/".date("Y");
						 	break;
							
				case 11	: 	$startDate  = "01/01/".date("Y");
						 	$endDate  	= date('m/d/Y');
						 	break;
							
				case 12	: 	$startDate  = date('m/d/Y',strtotime('yesterday'));
						 	$endDate  	= date('m/d/Y',strtotime('yesterday'));
						 	break;
							
				case 13	: 	if(date('w')==0){ $startDate  = date('m/d/Y',strtotime('last sunday')); }else {  $startDate  = date('m/d/Y',strtotime('-2  Sunday')); }
						 	$endDate  	= date('m/d/Y',strtotime('last saturday'));
						 	break;
							
				case 14	: 	if(date('w')==0){ $startDate  = date('m/d/Y',strtotime('last sunday')); }else {  $startDate  = date('m/d/Y',strtotime('-2  Sunday')); }
						 	$endDate  	= date('m/d/Y');
						    break;
							
				case 15	:  $startDate  = date('m/d/Y',mktime(0, 0, 0, date("m")-1, 1, date("Y")));
							$endDate  	= date('m/d/Y',mktime(0, 0, 0, date("m"), 0, date("Y")));
							break;
							
				case 16	:	$startDate  = date('m/d/Y',mktime(0, 0, 0, date("m")-1, 1, date("Y")));
							$endDate  	= date('m/d/Y');
							break;
							
				case 17	:	$lastquarter  = get_quarter(1);
							$startDate    =  date('m/d/Y',$lastquarter['start_nix']);		
							$endDate  	  = date('m/d/Y',$lastquarter['end_nix']);	
							break;
							
				case 18	:	$lastquarter  = get_quarter(1);
							$startDate    =  date('m/d/Y',$lastquarter['start_nix']);
							$endDate  	= date('m/d/Y');
							break;
							
				case 19	:	$startDate  = "01/01/".date("Y",strtotime('last year'));
							$endDate  	= "12/31/".date("Y",strtotime('last year'));
							break;
							
				case 20	:	$startDate  = "01/01/".date("Y",strtotime('last year'));
							$endDate  	= date('m/d/Y');
							break;
							
				case 21	:	$startDate  = date('m/d/Y',strtotime('-30 days'));
							$endDate  	= date('m/d/Y');
							break;
							
				case 22	:	$startDate  = date('m/d/Y',strtotime('-60 days'));
							$endDate  	= date('m/d/Y');
							break;
							
				case 23	:	$startDate  = date('m/d/Y',strtotime('-90 days'));
							$endDate  	= date('m/d/Y');
							break;
							
				case 24	:	$startDate  = date('m/d/Y',strtotime('-365 days'));
							$endDate  	= date('m/d/Y');
							break;
							
				default :	$startDate  = "";
						  	$endDate    = "";
						  	break;
				
			}
			return array(
				'startDate' => $startDate,
				'endDate' => $endDate							
			);
			
				
			
			
		 }
		
			
			
			 
		
	}
		
?>