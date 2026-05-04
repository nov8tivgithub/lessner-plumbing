<link rel="stylesheet" media="screen" type="text/css" href="<? echo base_url(); ?>styles/colorbox.css" />  
<script src="<? echo base_url('scripts/ckeditor/ckeditor.js'); ?>"></script>
<script src="<? echo base_url('scripts/jquery.colorbox.js'); ?>"></script>

<script language="javascript">
  $(document).ready(function () {

        $(".upload").colorbox({
            iframe: true,
            width: "650px",
            height: "650px"
        });


    });
    $(document).ready(function () { 
        $("#addtag").validate({
            rules: {
                tagname: 'required'
            },
            messages: {
                tagname: 'Please enter category name',
            },
			errorPlacement: function(error, element) {
			  if(element.attr("name") == "description") {
				error.appendTo( $('#desdiv') );
			  }else {
				error.insertAfter(element);
		  	  }
			}
            
        });


    });
  
  function statchange(tagkey,status){
    if(confirm('Are you sure you want to '+status+' this tag ?')){
	   $.post('<? echo base_url().ADMIN."/changetagstatus" ?>',{
				   tagkey : tagkey,				
				   act : 'statchange',
				   status : status
				   
		      },function (data){
				   
				   if(data.success){
				   
					   $("#key_"+tagkey).remove();
					    var len = $(".listvw").length;
					    if(len < 1){
						   $("#newlst").html("<div class='alert alert-danger'>No records found</div>"); 
					    }
				   }
		    },"json");
     }
   }

</script>


<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'addtag');
   echo form_open(base_url().ADMIN.'/categories', $attributes); 
   ?>

<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<div class="panel panel-default">
<!--<div class="panel-heading"><h3 class="cust_head">Create Category</h3><a href="javascript:history.back()" class="bkbtnbknd">Back</a> -->
<div id="clear"></div><!--</div>-->
<div class="panel-body">

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Category Name</label>
           <input type="text" class="form-control" id="exampleInputEmail1"  name="tagname" value="<?php echo $this->input->post('tagname');?>">
          </div> 
    </div>
    
    
</div>


<input type="hidden" name="addtag" value="1">
<center class="cntr-top"><button type="submit" class="btn btn-primary" >Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div>
</form>

<div class="panel panel-default">
<div class="panel-heading ">
    <div class="clearfix">
        <div class="col-sm-6 offset0"><h3 class="cust_head"><?php echo $pageHeader; ?></h3></div>

        <div class="col-sm-6 ">
            <div class="btn-group btn-group-justified">
             
                 <a href="<?php echo base_url().ADMIN.'/categories/Active'?>"  class="btn btn-default <?php if($status == 'Active'):{?>active<?php }?><?php endif; ?>">Active</a>
                 <a href="<?php echo base_url().ADMIN.'/categories/Inactive' ?>"  class="btn btn-default <?php if($status == 'Inactive'):{?>active<?php }?><?php endif; ?>">Inactive</a>
            </div>
        </div>
	</div>
</div>
<div class="panel-body">



		<center>
      <ul class="pagination">
	  <li class="<?php if($alpha ==''): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/categories/'.$status;?>">All</a></li>
	  <?php foreach(range('A','Z') as $f) : ?>
	      <li  class="<?php if($alpha == $f ): ?>active<?php endif; ?>"><a href="<?php echo base_url().ADMIN.'/categories/'.$status.'/'.$f.''?>"><?php echo $f;?></a></li>
	  <?php endforeach; ?>
      </ul>
      </center>
    	
<div id="newlst">		
<?php
	if(!empty($tags)):    
		foreach($tags as $new):
	?>
	       <div class="row bordertop listvw" id="key_<? echo $new['tagkey']; ?>">
		 		
		 
           
           
            <div class="col-sm-8">
                
                    <h3><?php echo $new['tagname']; ?></h3>
                    
                </div>

			<div class="col-sm-4 pad-top ">
                <div class="btn-group">
					 <?php if($new['status'] == '0')  : ?>
                    <a class="btn btn-default btn-sm" onclick="statchange('<? echo $new['tagkey']; ?>','Activate')"><span class="glyphicon glyphicon-ok"></span> Activate</a><?php endif; ?>
                     <?php if($new['status'] == '1' ) : ?>
                    <a  class="btn btn-default btn-sm" onclick="statchange('<? echo $new['tagkey']; ?>','Deactivate')"><span class="glyphicon glyphicon-trash"></span> Deactivate</a> <?php endif; ?>
                    <a class="btn btn-default btn-sm" href="<?php echo base_url().ADMIN.'/editcategory/'.$new['tagkey'];?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
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
</div>
</div>