<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a1d9c125-d300-4ba0-ae33-83f35c123378", doNotHash: true, doNotCopy: false, hashAddressBar: false, onhover : true});</script>
<script>

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=345426848880569";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
	
    <div id="bloglist">
    	<div class="w970 abt_box text-center">
            <h3 class="greshblu MB10 fadeInRight wow">Blog Details</h3>
                	<p class="blogdate fadeInLeft wow"><?php echo date("M", $blogdat['createdate'])." ";  echo date("d", $blogdat['createdate']).","." ";  echo date("Y", $blogdat['createdate']); ?></p>
                    <a href="<?php  echo base_url($from); ?>" class="backonestep fadeInRight wow">Back</a>
                    <div class="shardeta"><a class="st_sharethis_custom share_away" st_url="<?php  echo base_url('blogdetails/'.$blogdat['postkey']); ?>" st_image="<?php  echo $blogdat['image']; ?>" st_title="<?php  echo $blogdat['title']; ?>">Share</a></div>
                    <div class="clear"></div>
                <div class="blogmain fadeInDown wow">
                <a href="" class="bloghed greshblu"><?php echo $blogdat['title'];?></a>
                    <div class="blogdescpn">
                    	<div class="blogdescpn_img"><img src="<?php echo $blogdat['image'];?>" /></div>
                        <p><?php  echo $blogdat['description'];?></p>
						
                    <div class="clear"></div>
                    </div>
                    <div class="tagbx fadeInUp wow">
					<?php  if (!empty($tagname)): ?>
					<?php  foreach($tagname as $cv=>$cm): ?>
                    	<a class="tags" href="<?php  echo base_url('blog/'."all".'-'."all".'/'.$cm['tagid']); ?>" ><?php  echo $cm['tagname']; ?></a> 
					<?php  endforeach;
						endif;
					?>
                    </div>
					
					<div class="embdvideo"> <?php echo $blogdat['embedcode'];?></div>
					
					
                    <div class="blogdt_commentbx">
					<div id="C" class="fb-comments" data-href="<?php  echo base_url('blogdetails/'.$blogdat['postkey']); ?>" data-num-posts="2" data-width="100%"> </div>
	
					<div class="clear"></div>
					</div>
                </div>
        <div class="clear"></div>
        </div>
		<div class="clear"></div>
    </div>
