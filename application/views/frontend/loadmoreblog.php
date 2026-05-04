
 				<?php  if(!empty($loadblog)): 
				
				
				foreach($loadblog as $cv=>$cn):
					
				?>   
				
	<div class="<?php echo $cn['class']; ?> fadeInLeft wow ios">
			<a class="vie_more" href="<?php  echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"></a>
			<div class="blog_img">
				<img src="<?php  echo $cn['image'];?>" alt="blog image" />
			</div>
			<div class="blog_txt">
			 <a href="<?php  echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"> <h4 class="blog_tytl"><?php  echo strlen(strip_tags($cn['title']))> $cn['truncate'] ? substr(strip_tags($cn['title']),0,$cn['truncate'])."..." : strip_tags($cn['title']);?></h4></a>
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