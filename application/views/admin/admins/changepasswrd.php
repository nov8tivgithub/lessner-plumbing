<script language="javascript">
 
$(document).ready(function() {

       $('#resetpas').validate({
	      rules :{
		      newpassword:{
			    required: true,
				minlength: 3
			  },
		      repassword:{
			    required: true,
			    equalTo: '#newpassword',							    
			    }	
	      },
	      messages : {
		      newpassword:{			  
			  required:"Please enter your new Password",
			  minlength: "Your password must contain more than 3 characters"
			  },
			  repassword: {
               required: "Please confirm your new Password",
               equalTo: "Your passwords do not match. Please check and try again."
              }
		    
	      }
		  
      });
});
</script>
<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'resetpas');
   echo form_open(base_url().ADMIN.'/changeadminpasswrd/'.$adminkey.'/'.$type, $attributes); 
   ?>
<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<?php if ( isset ($hasSucess ) ) {?><div class="alert alert-success"><?php echo $Sucessmsg; ?></div><?php  } ?>


<div class="panel panel-default">
<div class="panel-heading">
<div class="clearfix">
        <div class="col-sm-6 offset0"><h3 class="cust_head">Change Password</h3></div>
        <div class="col-sm-6 align-right">
            
            	<?php if($type=='admin'){?>
                 <a href="<?php echo base_url().ADMIN.'/editadmin/'.$adminkey;?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
                 <?php }elseif($type=='profile'){?>
                 <a href="<?php echo base_url().ADMIN.'/myprofile';?>" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
                  <?php }?>

            
        </div>
</div>
</div>
<div class="panel-body">
	<div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Enter your new Password</label>
          <input type="password" class="form-control" id="newpassword" name="newpassword" autocomplete="off">
           <label class="error"><?php echo form_error('newpassword'); ?></label>
        </div>
    </div>
    <div class="col-sm-6">
    <div class="form-group">
       <label for="exampleInputPassword1">Confirm your new Password</label>
       <input type="password" class="form-control" id="exampleInputPassword1" name="repassword" autocomplete="off">
       <label class="error"><?php echo form_error('repassword'); ?></label>
    </div>
    </div>
<input type="hidden" name="resetpass" value="1">
<div class="col-sm-12">
<center><button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div></div>
</form>