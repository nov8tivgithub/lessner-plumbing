<script >
   function statchange(adminkey,status){
    if(confirm('Are you sure you want to '+status+' this user ?')){
	   $.post('<?php  echo base_url().ADMIN."/changeadminstatus" ?>',{
				   adminkey : adminkey,				
				   act : 'statchange',
				   status : status
				   
		      },function (data){
				   
				   if(data.success){
				   
					   $("#key_"+adminkey).remove();
					    var len = $(".listvw").length;
					    if(len < 1){
						   $("#admnlst").html("<p class='norec alert alert-danger'>No records found</p>"); 
					    }
				   }
		    },"json");
     }
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
        <div class="col-sm-6 offset0"><h3 class="cust_head"><?php echo $pageHeader; ?></h3></div>
        <div class="col-sm-6 ">
            <div class="btn-group btn-group-justified">
            <?php  /* ?> <a href="<?php echo base_url().ADMIN.'/createadmin'?>" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</a><?php  */?> 
				 
                 <a href="<?php echo base_url().ADMIN.'/adminmanager/Active'?>"  class="btn btn-default <?php if($status == 'Active'):{?>active<?php }?><?php endif; ?>">Active</a>
                 <a href="<?php echo base_url().ADMIN.'/adminmanager/Inactive' ?>"  class="btn btn-default <?php if($status == 'Inactive'):{?>active<?php }?><?php endif; ?>">Inactive</a>
            </div>
        </div>
</div>
</div>
<div class="panel-body">



		<center>
      <ul class="pagination">
	  <li class="<?php if($alpha ==''): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/adminmanager/'.$status;?>">All</a></li>
	  <?php foreach(range('A','Z') as $f) : ?>
	      <li  class="<?php if($alpha == $f ): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/adminmanager/'.$status.'/'.$f.''?>"><?php echo $f;?></a></li>
	  <?php endforeach; ?>
      </ul>
      </center>
    	
<div id="admnlst">		
<?php
	if(!empty($Admins)):    
		foreach($Admins as $admn):
	?>
	       <div class="row bordertop listvw" id="key_<?php  echo $admn['adminkey']; ?>">
		 		
		  <div class="offset1 media">
			<p class="pull-left"><img src="<?php echo $admn['profImg']; ?>" width="60" class="img-rounded img-responsive" /></p>
			<div class="media-body">
				<div class="col-sm-4">
                     <strong><?php echo $admn['firstname']." ".$admn['lastname']; ?></strong><br/>
                     <?php echo $admn['email']; ?>
				</div>
                <div class="col-sm-4">
                    <address>
                    <?php echo stripslashes(nl2br(str_replace('\n', "\n", $admn['address']))); ?><br>
                    <?php echo $admn['city']; ?>, <?php echo $admn['state']; ?> <?php echo $admn['zip']; ?><br>
                    <abbr title="Phone">P:</abbr> <?php echo $admn['phone']; ?>
                  </address>
                    
                </div>

			<div class="col-sm-4 pad-top">
			<div class="btn-group">
		     <?php if($admn['status'] == '0')  : ?>
			<a class="btn btn-default btn-sm" onclick="statchange('<?php  echo $admn['adminkey']; ?>','Activate')"><span class="glyphicon glyphicon-ok"></span> Activate</a><?php endif; ?>
		     <?php if( ($this->session->userdata('adminKey') != $admn['adminkey']) and $admn['status'] == '1' ) : ?>
			<a  class="btn btn-default btn-sm" onclick="statchange('<?php  echo $admn['adminkey']; ?>','Deactivate')"><span class="glyphicon glyphicon-trash"></span> Deactivate</a> <?php endif; ?>
		     <?php //if( $this->session->userdata('adminKey') != $admn['adminkey']) : ?>
			<a class="btn btn-default btn-sm" href="<?php echo base_url().ADMIN.'/editadmin/'.$admn['adminkey'];?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a> <?php //endif; ?>
		     </div>
			</div>
				

			</div>
		  </div>
		  
		  
	       </div>
	
 <?php 
		endforeach;
		else:
			?>
			<div class="alert alert-danger">No records found</div>
			<?php
			
		endif;
	 ?>	
</div>
</div>
</div>