<script language="javascript">
    $(document).ready(function () {
        $("#createadmin").validate({

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
                },

                email: {
                    required: true,
                    email: true,
                    remote: "<? echo base_url().'admin/admin/checkemailexists'; ?>"
                }


            },
            messages: {
                firstname: 'Please enter First Name',
                lastname: 'Please enter Last Name',
                address: 'Please enter Address',
                city: 'Please enter City',
                state: 'Please select your State',
                zip:{
				required:"Please enter Zip code",
				postalcode:"Please enter a valid Zip code"
				},
                phone:{ 
					required:"Please enter Phone#",
					phoneUS	:"Please enter valid Phone#"
					},
                email: {
                    required: "Please enter Email",
                    email: "Please enter a valid email address",
                    remote: "This email already exists."

                },

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
<!--<div class="page-header ">
	<div class="clearfix">
  		<h1 style="float:left;margin:0;" >Create Admin</h1>
	</div>
</div>-->
<?php if(isset($hasSucess) and $hasSucess){ ?>
	<script>
	alert('The admin has been successfully created and the confirmation email has been sent to the email address <?php echo $email;?>');
	window.location.href = "<?php echo base_url(ADMIN . '/adminmanager')?>";
    </script>
	
	<?php }?>
<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'createadmin');
   echo form_open(base_url().ADMIN.'/createadmin', $attributes); 
   ?>

<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="cust_head">Create Admin</h3></div>
<div class="panel-body">

<div class="row">

<div class="col-sm-6">
    <div class="form-group">
       <label for="exampleInputEmail1">Email</label>
       <input type="email" class="form-control" id="exampleInputEmail1"  name="email" value="<?php echo stripslashes($this->input->post('email'));?>">
      </div> 
</div>

<div class="col-sm-6">
 <div class="form-group">
   <label for="exampleInputPassword1">Password</label>
   <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
</div>

</div>

<div class="row">
<div class="col-sm-6">
	<div class="form-group">
   <label for="exampleInputEmail1">First Name</label>
   <input type="text" class="form-control"  name="firstname" value="<?php echo stripslashes($this->input->post('firstname'));?>">
  </div> 
</div>
<div class="col-sm-6">
<div class="form-group">
   <label for="exampleInputEmail1">Last Name</label>
   <input type="text" class="form-control"  name="lastname" value="<?php echo stripslashes($this->input->post('lastname'));?>">
 </div>  
</div>

</div>

<div class="row">

<div class="col-sm-6">
<div class="form-group">
   <label for="exampleInputEmail1">Address</label>
   <textarea class="form-control" rows="4" name="address"><?php echo stripslashes($this->input->post('address'));?></textarea>
 </div>  
</div>
<div class="col-sm-6">
	<div class="form-group">
       <label for="exampleInputEmail1">City</label>
       <input type="text" class="form-control" name="city" value="<?php echo stripslashes($this->input->post('city'));?>">
       
	

    </div>
<div class="form-group">
       <label for="exampleInputEmail1">State</label>
       <select class="form-control" name="state">
          <option value="">--Select--</option>
          <?php foreach ($states as $state): ?>
          <option value="<?php echo $state['state_prefix'] ?>"<?php if($this->input->post('state')==$state['state_prefix']) echo 'selected';?>><?php echo $state['state_prefix']; ?></option>
          <?php endforeach ?>
       </select>
      </div> 

</div>

</div>

<div class="row">

<div class="col-sm-6">
<div class="form-group">
   <label for="exampleInputEmail1">Zip</label>
   <input type="text" class="form-control"  name="zip" value="<?php echo stripslashes($this->input->post('zip'));?>">
  </div> 
</div>
<div class="col-sm-6">
<div class="form-group">
   <label for="exampleInputEmail1">Phone</label>
   <input type="text" class="form-control"   name="phone" value="<?php echo stripslashes($this->input->post('phone'));?>">
    <p class="Cus-pN">Eg:410-369-9899</p>
  </div> 
</div>

</div>

<?php /*?>
<div class="form-group">
   <label for="exampleInputFile">File input</label>
   <input type="file" id="exampleInputFile">
   <p class="help-block">Example block-level help text here.</p>
</div>
<?php */?>
<input type="hidden" name="addAdmin" value="1">
<center class="cntr-top"><button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div>
</form>