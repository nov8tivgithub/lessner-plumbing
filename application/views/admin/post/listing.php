<script >
   function statchange(postkey,status){
    if(confirm('Are you sure you want to '+status+' this blog ?')){
	   $.post('<? echo base_url().ADMIN."/changeblogstatus" ?>',{
				   postkey : postkey,				
				   act : 'statchange',
				   status : status
				   
		      },function (data){
				   
				   if(data.success){
				   
					   $("#key_"+postkey).remove();
					    var len = $(".listvw").length;
					    if(len < 1){
						   $("#newlst").html("<div class='alert alert-danger'>No records found</div>"); 
					    }
				   }
		    },"json");
     }
   }


function getloadmore(){
	var postkey = $("#postlstkey").val();
	var alpha = $("#alpha").val();
	var status = $("#status").val();
   	$.post('<? echo base_url().ADMIN."/getmoreblogs" ?>',{
			   postkey :postkey,
			   act 	   :'getmore',
			   alpha   :alpha,
			   status  :status
	      },function (data){
			   if(data.success){
			   		if(data.loadmorediv == '0'){
			   			$("#loadmorediv").hide();
			   		}
			   	$("#postlstkey").val(data.postlastkey);	
			   	$("#newlst").append(data.page);		
			   }
	    },"json");
}

</script>
<!--<div class="page-header">

  
  <div style="float:right" class="">
    
  </div>
  
  
  <div style="clear:both"></div>
     
  
</div>-->
<div class="panel panel-default">
<div class="panel-heading ">
    <div class="clearfix">
        <div class="col-sm-4 offset0"><h3 class="cust_head"><?php echo $pageHeader; ?></h3></div>
        <div class="col-sm-7 pad0 FR">
            <div class="btn-group btn-group-justified">
                 <a href="<?php echo base_url().ADMIN.'/categories'?>"  class="btn btn-default <?php if($titlecls == 'categories'):{?>active<?php }?><?php endif; ?>">Categories</a>
                 <a href="<?php echo base_url().ADMIN.'/blogmanager/Active'?>"  class="btn btn-default <?php if($status == 'Active'):{?>active<?php }?><?php endif; ?>">Active</a>
                 <a href="<?php echo base_url().ADMIN.'/blogmanager/Inactive' ?>"  class="btn btn-default <?php if($status == 'Inactive'):{?>active<?php }?><?php endif; ?>">Inactive</a>
				
            </div>
        </div>
</div>
</div>
<div class="panel-body">



		<center>
      <ul class="pagination">
	  <li class="<?php if($alpha ==''): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/blogmanager/'.$status;?>">All</a></li>
	  <?php foreach(range('A','Z') as $f) : ?>
	      <li  class="<?php if($alpha == $f ): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/blogmanager/'.$status.'/'.$f.''?>"><?php echo $f;?></a></li>
	  <?php endforeach; ?>
      </ul>
      </center>
    	
<div id="newlst">		
<?php
$postlstkey = '';
	if(!empty($post)):    
		foreach($post as $new):
			$postlstkey = $new['postkey'];
	?>
	       <div class="row bordertop listvw" id="key_<? echo $new['postkey']; ?>">
		 		
		 
           <div class="col-sm-3"><img src="<?php echo $new['Img']; ?>" width="300" class="img-rounded img-responsive padd-BTM" /></div>
           
            <div class="col-sm-6">
                
                    <h3><?php echo $new['title']; ?></h3>
                    <span class="blog-dte"><?php echo date('m/d/Y',$new['createdate']); ?></span>
                        <div style="word-wrap: break-word;">
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
                    <a class="btn btn-default btn-sm" onclick="statchange('<? echo $new['postkey']; ?>','Activate')"><span class="glyphicon glyphicon-ok"></span> Activate</a><?php endif; ?>
                     <?php if($new['status'] == '1' ) : ?>
                    <a  class="btn btn-default btn-sm" onclick="statchange('<? echo $new['postkey']; ?>','Deactivate')"><span class="glyphicon glyphicon-trash"></span> Deactivate</a> <?php endif; ?>
                    <a class="btn btn-default btn-sm" href="<?php echo base_url().ADMIN.'/editblog/'.$new['postkey'];?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                 </div>
			</div>
				<div class="clearfix"></div>
         <!-- <div class="col-sm-12"><a class="pull-right cust-vw-mre">View more <span class="glyphicon glyphicon-chevron-right"></span></a></div>-->
		  
	       </div>
	
 <?
		endforeach;
		else:
			?>
			<div class="alert alert-danger">No records found</div>
			<?php
			
		endif;
	 ?>	
</div>

			<?php if($loadmorediv == '1'){ ?>
			<div class="btn btn-default" style="margin: 20px auto; width: 150px; display: block;" id="loadmorediv" onclick="getloadmore()">Load More</div>
			<?php } ?>
			<input type="hidden" name="postlstkey" value="<?php echo $postlstkey; ?>" id="postlstkey">
			<input type="hidden" name="alpha" value="<?php echo $alpha; ?>" id="alpha">
			<input type="hidden" name="status" value="<?php echo $status; ?>" id="status">	
</div>
</div>