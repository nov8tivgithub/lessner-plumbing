
 				<? if(!empty($loadblog)): 
				
				
				foreach($loadblog as $cv=>$cn):
					
				?>   
				
	<div class="<?echo $cn['class']; ?> fadeInLeft wow ios">
			<a class="vie_more" href="<? echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"></a>
			<div class="blog_img">
				<img src="<? echo $cn['image'];?>" alt="blog image" />
			</div>
			<div class="blog_txt">
			 <a href="<? echo base_url('blogdetails/blog/'.$cn['postkey']); ?>"> <h4 class="blog_tytl"><? echo strlen(strip_tags($cn['title']))> $cn['truncate'] ? substr(strip_tags($cn['title']),0,$cn['truncate'])."..." : strip_tags($cn['title']);?></h4></a>
				<p class="blog_para"><?php  echo  substr(strip_tags($cn['description']),0,$cn['para'])."..."?> </p>
				<p class="text-right"><?echo date("M", $cn['createdate'])." ";  echo date("d", $cn['createdate']).","." ";  echo date("Y", $cn['createdate']); ?></p>
			</div>
			<div class="share_box">
				<a class="st_sharethis_custom share_away" st_url="<? echo base_url('blogdetails/'.$cn['postkey']); ?>" st_image="<? echo $cn['image'];?>" st_title="<? echo $cn['title']; ?>">Share</a>
			</div>
		</div>  
		
		<?
			endforeach;
			endif;
		?>