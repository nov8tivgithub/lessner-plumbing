<?php
	if(!empty($post)){
		foreach($post as $new){
	?>
	       <div class="row bordertop listvw" id="key_<?php  echo $new['postkey']; ?>">


           <div class="col-sm-3"><img src="<?php echo $new['Img']; ?>" width="300" class="img-rounded img-responsive padd-BTM" /></div>

            <div class="col-sm-6">

                    <h3 class="title-blog"><?php echo $new['title']; ?></h3>
                    <span class="blog-dte"><?php echo date('m/d/Y',$new['createdate']); ?></span>
                        <div style="word-wrap: break-word; margin-bottom:10px;">
						<?php

							$finaldescription = "";
							$finaldescription = strip_tags($new['description']);
						?>
                        <?php echo (strlen($finaldescription) > 300) ? substr(strip_tags($finaldescription),0,300)."..."  : strip_tags($new['description']) ; ?><br>
                        <a href="<?php echo $new['url']; ?>" target="_blank"><?php echo $new['url']; ?></a>

                     </div>

                </div>

			<div class="col-sm-3 pad-top ">
                <div class="btn-group">
					 <?php if($new['status'] == '0')  : ?>
                    <a class="btn btn-default btn-sm" onclick="statchange('<?php  echo $new['postkey']; ?>','Activate')"><span class="glyphicon glyphicon-ok"></span> Activate</a><?php endif; ?>
                     <?php if($new['status'] == '1' ) : ?>
                    <a  class="btn btn-default btn-sm" onclick="statchange('<?php  echo $new['postkey']; ?>','Deactivate')"><span class="glyphicon glyphicon-trash"></span> Deactivate</a> <?php endif; ?>
                    <a class="btn btn-default btn-sm" href="<?php echo base_url().ADMIN.'/editblog/'.$new['postkey'];?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                 </div>
			</div>
				<div class="clearfix"></div>
         <!-- <div class="col-sm-12"><a class="pull-right cust-vw-mre">View more <span class="glyphicon glyphicon-chevron-right"></span></a></div>-->

	       </div>

 <?php  }} ?>