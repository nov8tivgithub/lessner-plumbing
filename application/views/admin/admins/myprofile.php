<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo base_url(); ?>styles/colorbox.css" />  
<script src="<?php  echo base_url(); ?>scripts/jquery.colorbox.js"></script>
<script>
    $(document).ready(function () {

        $(".aupload").colorbox({
            iframe: true,
            width: "650px",
            height: "650px"
        });


    });

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
                phone: {
				required:'Please enter Phone#',
				phoneUS:'Please enter  a valid Phone#'
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

    function profileImage(imagekey,imagePath){
        $("#tempimage").val(imagekey);
        $("#img_profile").attr("src",imagePath);
    }

    function delImg(ke) {
        var imk = $("#ismain").val();
        if (imk == ke) {
            $("#ismain").val('');
        }
        $("#pimg_" + ke).remove();

        if ($(".primcls").length <= 0) {
            $("#imguplod").val('');
        }
    }

    function changeimage() {
        $("#imageexists").remove();
        $("#imageupload").show();
    }
</script>
<?php 
   $attributes = array('id' => 'editadmin');
   echo form_open(base_url().ADMIN.'/myprofile', $attributes); 
   ?>
<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>

<div class="panel panel-default">
<div class="panel-heading"><h3 class="cust_head">My Profile</h3></div>
<div class="panel-body">
<div class="row pad-bottom">
	<div class="col-lg-2">
            <?php if($AdminDet['profImg']){?>
                
                <div class="panel panel-default" id="imageexists">
                    <div class="panel-body">
                        <center>
                            <input type="hidden" name="tempimage" value="" id="tempimage"/>
                            <img src="<?php echo $AdminDet['profImg']; ?>" width="200" class="img-thumbnail" id="img_profile"/><br/>
                            <a href="<?php echo base_url().'crop/index/profile'; ?>" class="aupload myproimg"><span class="glyphicon glyphicon-camera"></span> Change Image</a>
                        </center>    
                    </div>
                </div>
                
            <?php }?>
           
         
            
	</div>
	<div class="col-lg-10 ">
                <h1><?php echo stripslashes($AdminDet['firstname']);?> <?php echo stripslashes($AdminDet['lastname']);?> <br/><small><?php echo stripslashes($AdminDet['email']);?></small></h1>
		<a href="<?php echo base_url().ADMIN.'/changeadminpasswrd/'.$AdminDet['adminkey'].'/profile';?>" class="btn btn-default"><span class="glyphicon glyphicon-lock"></span> Change Password</a>
	</div>	
</div>


<div class="row bordertop">
<div class="col-lg-6 ">
    <div class="form-group">
       <label for="exampleInputEmail1">First Name</label>
       <input type="text" class="form-control" name="firstname" value="<?php echo stripslashes($AdminDet['firstname']);?>">
       
    </div>
</div>
    <div class="col-lg-6 ">
        <div class="form-group">
           <label for="exampleInputEmail1">Last Name</label>
           <input type="text" class="form-control" name="lastname" value="<?php echo stripslashes($AdminDet['lastname']);?>">
          
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 ">
        <div class="form-group">
           <label for="exampleInputEmail1">Address</label>
           <textarea class="form-control" rows="4" name="address"><?php echo stripslashes(str_replace('\n', "\n", $AdminDet['address']));?></textarea>
          
        </div>
    </div>
    <div class="col-lg-6 ">
        <div class="form-group">
           <label for="exampleInputEmail1">City</label>
           <input type="text" class="form-control"   name="city" value="<?php echo stripslashes($AdminDet['city']);?>">
           
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
	<div class="col-lg-6 ">
    <div class="form-group">
       <label for="exampleInputEmail1">Zip</label>
       <input type="text" class="form-control" name="zip" value="<?php echo stripslashes($AdminDet['zip']);?>">
       
    </div>
	</div>
	<div class="col-lg-6 ">
    <div class="form-group">
       <label for="exampleInputEmail1">Phone</label>
       <input type="text" class="form-control" name="phone" value="<?php echo stripslashes($AdminDet['phone']);?>">
       
	</div>
</div>
</div>


<input type="hidden" name="editadmin" value="1">
 <center class="cntr-top"><button type="submit" class="btn btn-primary">Save</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div>
</form>