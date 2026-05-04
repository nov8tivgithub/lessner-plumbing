<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a1d9c125-d300-4ba0-ae33-83f35c123378", doNotHash: true, doNotCopy: false, hashAddressBar: false, onhover : true});</script>
<script>

function getBlogs(select){
//alert(ths);
		if(select == 'year')
		{
		 var month = 'all';			
		}else{
		 var month = $('#month').val();	
		}

	 var year = $('#year').val();
	 var catid = $('#categs').val();
	 
	 if(catid == undefined){
		catid = "";
	 }
	 //alert(catid);
	 var lin = '<?php  echo base_url(); ?>';
	 var relink = lin+'blog/'+year+'-'+month+'/'+catid
	 window.location.href = relink;
}

function getcatBlogs(){
	 var cat = $('#categs').val();
	 var month = $('#month').val();
	 var year = $('#year').val();
	 if(cat == ""){
	 	window.location.href = '<?php echo base_url('blog'); ?>';
	 }else{
		 var lin = '<?php  echo base_url(); ?>';
		 var relink = lin+'blog/'+year+'-'+month+'/'+cat
		 window.location.href = relink;
	 }
}

function loadmore(){
var cls = $("#blogclass").val().split('-');
var elem = $("#loadmr").html();
//alert(elem);
$("#loadmr").html('<img src="<?php echo base_url('images/lespre.gif'); ?>">');
 $.post('<?php  echo base_url('frontend/frontend/loadmoreblogs') ?>',{
 
	   monthyear : '<?php  echo $monthyear; ?>',
	   tagid     : '<?php  echo $tagid; ?>',
	   lastid    : $("#lastid").val(),
	   lastkey : cls[0],
	   count : cls[1],
	   large : cls[2]
			   
		  },function (data){
			   if(data.success){
				$("#loadmr").html(elem);
				   if(data.showLoadmore == "No"){
						$("#loadmr").remove();
				   }
				   $("#loadmoreblog").append(data.loadbloglist);
				   $("#lastid").val(data.lastid);
				   var valu = data.lastkey+'-'+data.count+'-'+data.large;
				   $("#blogclass").val(valu);
				   stButtons.locateElements()
				}
		},"json");
 }
 
</script>
  <div id="bloglist">
    	<div class="w970 abt_box text-center">
            <h3 class="greshblu MB10 fadeInRight wow">Blogs</h3>
            <div class="archive">
			<?php  if(!empty($categ)): ?>
            	<div class="category">
                	<p class="panda">Categories</p>
                    <div class="selctbx sel325">
                    	<select name="categs" onchange="getcatBlogs()" id="categs">
                        	<option value="">--ALL--</option>
							<?php  if(!empty($categ)): 							
							foreach($categ as $mn):							
							?>
							<option value="<?php  echo $mn['tagid']; ?>" <?php  if($tagid == $mn['tagid']): ?> selected="selected" <?php  endif; ?>> <?php  echo $mn['tagname']; ?> </option> 
                            <?php  
							endforeach;
							endif;
							?>
						</select>
                    </div>
                </div>
                <?php  
				endif;
				?>	

				
			<?php  $ymArray = explode('-',$monthyear); ?>
			<?php  if(!empty($blogsforDate)) : ?>
               
			   <div class="right_cate">
                	<p class="panda">Archives</p>
				 <div class="selctbx sel100">
					<select name="year" onchange="getBlogs('year')" id="year"> 
								<option value="all">--Year--</option>								
									<?php  if(!empty($blogsforDate)):
										foreach($blogsforDate as $bd):
											$yearArray[] = date('Y',$bd['createdate']);
										endforeach;
											$yearArray =  array_unique($yearArray);
										foreach($yearArray as $v):
										?>
							<option value="<?php  echo $v; ?>" <?php  if($v == $year): ?> selected="selected" <?php  endif; ?>> <?php  echo $v; ?> </option> 
							<?php  
							endforeach;
						endif;
					 ?>
				</select>		
             </div>
			  
			  		<?php  if( $year !== "all" ):  ?>	 
                    <div class="selctbx sel195" id="months" >
                    	<select name="month" onchange="getBlogs('month')" id="month">
                        	<option value="all">--Month--</option>
							      <?php  if(!empty($blogsformonth)):					
									foreach($blogsformonth as $b):
										$months[] = date('m',$b['createdate']);
									endforeach;
										$months = array_unique($months);
									foreach($months as $ad):
									?>
								<option value="<?php  echo $ad; ?>" <?php  if($ad == $month): ?> selected="selected" <?php  endif; ?>> <?php  $monthName = date('F', mktime(0, 0, 0, $ad, 10)); echo $monthName; ?> </option> 
							<?php  
			 		endforeach;
				endif;
			 ?>
                        </select>
                    </div>
					<?php  endif; ?>
					
                </div>
				<?php  endif; ?>
            <div class="clear"></div>
            </div>
            <div class="blog_section">
			
				<?php  if(!empty($blogdata)): 
				
				
				foreach($blogdata as $cv=>$cn):
					
				?>
			
                <div class="<?php echo $cn['class']; ?> fadeInLeft wow ">
                    <a class="vie_more" href="<?php  echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"></a>
                    <div class="blog_img">
                        <img src="<?php  echo $cn['image'];?>" alt="blog image" />
                    </div>
                    <div class="blog_txt">
                       <a href="<?php  echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"> <h4 class="blog_tytl"><?php  echo strlen(strip_tags($cn['title']))> $cn['truncate'] ? substr(strip_tags($cn['title']),0,$cn['truncate'])."..." : strip_tags($cn['title']);?></h4> </a> 
                        <p class="blog_para"><?php  echo  substr(strip_tags($cn['description']),0,$cn['para'])."..."?> </p>
                        <p class="text-right"><?php echo date("M", $cn['createdate'])." ";  echo date("d", $cn['createdate']).","." ";  echo date("Y", $cn['createdate']); ?></p>
                    </div>
                    <div class="share_box">
                        <a class="st_sharethis_custom share_away" st_url="<?php  echo base_url('blogdetails/'.$cn['postkey']); ?>" st_image="<?php  echo $cn['image'];?>" st_title="<?php  echo $cn['title']; ?>">Share</a>
                    </div>
                </div>     				
           
					<?php 
			endforeach;
			endif;
		?>
		
		<input type ="hidden" name="blogclass" id="blogclass" value="<?php echo $lastkey.'-'.$count.'-'.$large; ?>">
		 <div id="loadmoreblog"> </div>
			 <div class="clear"></div>
            </div>
			
			<input type="hidden" name="lastid" value="<?php  echo $lastid; ?>" id="lastid">
			
			<?php  if(empty($blogdata)): ?>		
                	<p class="norecords">No Records Found</p>
			<?php  endif; ?>
					
			<?php  if($showLoadmore == 'Yes'): ?>
				<div class="pd10" id="loadmr" >			
                	<a href="javascript:void(0)" onclick="loadmore()" class="lp_lnk_btn fadeInRight wow">Load More Blogs</a>
				</div>
			<?php  endif; ?>
			
        <div class="clear"></div>
        </div>
    <div class="clear"></div>
    </div>
    