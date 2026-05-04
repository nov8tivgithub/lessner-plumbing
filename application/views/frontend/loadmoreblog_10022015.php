<script>
$( document ).ready(function() {
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	  $( ".ios" ).each(function() {
         $( ".ios" ).removeClass( "blog_box_big" ).addClass( "blog_box" );
      });
	}
});
</script>

 				<? if(!empty($loadblog)): 
				
				
				foreach($loadblog as $cv=>$cn):
					
				?>   
				
	<div class="<?echo $cn['class']; ?> fadeInLeft wow ios">
			<a class="vie_more" href="<? echo base_url('blogdetails/'.$cn['postkey']); ?>"></a>
			<div class="blog_img">
				<img src="<? echo $cn['image'];?>" alt="blog image" />
			</div>
			<div class="blog_txt">
				<h4 class="blog_tytl"><?php echo substr(stripslashes($cn['title']),0,50)."..."?></h4>
				<p class="blog_para"><?php  echo substr(stripslashes($cn['description']),0,60)."..."?> </p>
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