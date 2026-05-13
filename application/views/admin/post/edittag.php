<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo base_url(); ?>styles/colorbox.css" />  
<script src="<?php  echo base_url('scripts/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php  echo base_url('scripts/jquery.colorbox.js'); ?>"></script>

<script language="javascript">
  $(document).ready(function () {

    $(document).ready(function () {
        $("#edittag").validate({

            rules: {
                tagname: 'required'

            },
            messages: {
                tagname: 'Please enter category name'

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
 
});
</script>

<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'edittag');
   echo form_open(base_url().ADMIN.'/editcategory/'.$tagDets['tagkey'], $attributes); 
   ?>

<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="cust_head">Edit Category</h3>

<a class="btn btn-primary btn-sm bakbtn" href="javascript:history.back()" class="bkbtnbknd">Back</a>
<div class="clear"></div></div>
<div class="panel-body">

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Category Name</label>
           <input type="text" class="form-control" id="exampleInputEmail1"  name="tagname" value="<?php echo htmlspecialchars($tagDets['tagname']);?>">
          </div> 
    </div>
    

</div>


<input type="hidden" name="edittag" value="1">
<center class="cntr-top"><button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div>
</form>