<script language="javascript">
    $(document).ready(function () {
        $("#editadmin").validate({

            rules: {
                firstname: 'required',
                lastname: 'required',
                password: 'required',
                address: 'required',
                city: 'required',
                state: 'required',
                zip: {
                    required: true,
                    postalcode: true
                },
                phone: {
                    required: true,
                    phoneUS: true
                }


            },
            messages: {
                firstname: 'Please enter First Name',
                lastname: 'Please enter Last Name',
                address: 'Please enter Address',
                city: 'Please enter City',
                state: 'Please select your State',
                zip: {
				required:'Please enter Zip code',
				postalcode:'Please enter a valid Zip code',				
				},
				
                phone: 'Please enter Phone# ',
                password: 'Please enter Password'

            },
            errorPlacement: function (error, element) {

                error.insertAfter(element);

            }

        });

        jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        });

        jQuery.validator.addMethod("postalcode", function (postalcode, element) {
            return this.optional(element) || postalcode.match(/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXYabceghjklmnpstvxy]{1}\d{1}[A-Za-z]{1} ?\d{1}[A-Za-z]{1}\d{1})$/);
        });



    });
</script>

<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'editadmin');
   echo form_open(base_url().ADMIN.'/editadmin/'.$AdminDet['adminkey'], $attributes); 
   ?>
<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="cust_head">Edit Admin</h3></div>
<div class="panel-body">
<div class="row pad-bottom">
    <div class="col-sm-6 ">
    <h4><p class="form-control-static"><?php echo stripslashes($AdminDet['email']);?></p></h4>
    </div>
    <div class="col-sm-6 ">
    <a href="<?php echo base_url().ADMIN.'/changeadminpasswrd/'.$AdminDet['adminkey'].'/admin';?>" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Change Password</a>
    </div>

</div>

<div class="row bordertop">
    <div class="col-sm-6 form-group">
       <label for="exampleInputEmail1">First Name</label>
       <input type="text" class="form-control"  name="firstname" value="<?php echo htmlspecialchars($AdminDet['firstname']);?>">
      
    </div>
    <div class="col-sm-6 form-group">
       <label for="exampleInputEmail1">Last Name</label>
       <input type="text" class="form-control"   name="lastname" value="<?php echo htmlspecialchars($AdminDet['lastname']);?>">
       
    </div>
</div>

<div class="row">
<div class="col-sm-6 ">
    <div class="form-group">
       <label for="exampleInputEmail1">Address</label>
       <textarea class="form-control" rows="4" name="address" ><?php echo stripslashes(str_replace('\n', "\n", $AdminDet['address']));?></textarea>
      
    </div>
</div>
<div class="col-sm-6">
	<div class="form-group">
       <label for="exampleInputEmail1">City</label>
       <input type="text" class="form-control"  name="city" value="<?php echo htmlspecialchars($AdminDet['city']);?>">
      
	</div>
	<div class="form-group">
     <label for="exampleInputEmail1">State</label>
       <select class="form-control" name="state">
          <option value="">--State--</option>
          <?php foreach ($states as $state): ?>
          <option value="<?php echo $state['state_prefix'] ?>"<?php if($AdminDet['state']==$state['state_prefix']) echo 'selected';?>><?php echo $state['state_prefix']; ?></option>
          <?php endforeach ?>
       </select>
      
</div>
	
</div>
</div>

<div class="row">
<div class="col-sm-6 form-group">
   <label for="exampleInputEmail1">Zip</label>
   <input type="text" class="form-control"   name="zip" value="<?php echo stripslashes($AdminDet['zip']);?>">
   
</div>
<div class="col-sm-6 form-group">
   <label for="exampleInputEmail1">Phone</label>
   <input type="text" class="form-control"  name="phone" value="<?php echo stripslashes($AdminDet['phone']);?>">
    <p class="Cus-pN">Eg:410-369-9899</p>
  
</div>
</div>


<input type="hidden" name="editadmin" value="1">
<p><center><button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center></p>
</div>
</div>
</form>