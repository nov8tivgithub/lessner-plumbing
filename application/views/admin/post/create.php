<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo base_url(); ?>styles/colorbox.css" /> 

<script src="<?php  echo base_url();?>scripts/ckeditor/ckeditor.js"></script> 
<script src="<?php  echo base_url(); ?>scripts/jquery.colorbox.js"></script>
<script language="javascript">
  $(document).ready(function () {

        $(".upload").colorbox({
            iframe: true,
            width: "650px",
            height: "650px"
        });
        });
 $(document).ready(function () {

        $("#createpost").validate({
			 ignore: [],
            rules: {
                title: 'required',
                tags: 'required',
				descriptioncheck: {
					               required: function(element) {return ( CKEDITOR.instances['editor1'].getData() == "") }    
									}
				
               
                /* url: {
                    required: true,
                    cus_url: true
                } */

            },
            messages: {
                title: 'Please enter Title',
                descriptioncheck: 'Please enter Description',
				tags:'Please check tags'
				
              //  url: 'Please enter Url'

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
   function profileImage(imagekey,imagePath){
        $("#tempimage").val(imagekey);
		$("#showimg").show();
        $("#img_profile").attr("src",imagePath);
		$("#hideimg").hide();
    }

    
    function changeimage() {
        $("#showimg").hide();
		$("#hideimg").show();
        $("#tempimage").val('');
    }
function showform(){
		 
		//$("#docplaceid").val(docno);
		$(".uploads11").show();
		$("#uploaderoverlay").show();
		var midDiv = ( $(".projHidn").width() - $("#docform").width() ) / 2;
		var midHeight = ( $(".projHidn").height() - $("#docform").height() ) / 2;
		
		
		
		
		$("#uploaderoverlay").css({'height':$(".projHidn").height()+'px'});
		$("#uploaderoverlay").css({'width':$(".projHidn").width()+'px'});
		
		
		var scrolltop = $(window).scrollTop();
		scrolltop = ( $(window).height() /2 ) + scrolltop;
		$("#docform").fadeIn().css({'top':scrolltop+'px'}); 
		$("#docform").css({'left':midDiv+'px'});
}
function addTag(){

	if($("#tag").val() == ""){
		alert('Please enter tag');
		return false;
	}
	var mids = new Array();
	if($(".tagcls").length > 0){
		$(".tagcls").each(function(){
				var my_id = $(this).attr("id").split("_")[1];
				 //alert(my_id); 
				if ( my_id ){
						mids.push(my_id)
					}
			});
			
			mids.sort(function(a, b) { 
				return a - b;
				}); 
			
		var max_id = mids[mids.length - 1];
		var cnt = parseInt(max_id) + 1;
	}else{
		var cnt =  1;
	}
	var tagname ="";
	tagname = $("#tag").val();
	var elem = '<span class="tagcls btn btn-default btn-sm" id="tg_'+cnt+'">'+tagname+'<a class="glyphicon glyphicon-remove spce" onclick="removetag('+cnt+')"></a><input type="hidden" name=tagname['+cnt+'] value="'+tagname+'"></span>';
	$("#taglist").prepend(elem);
	$("#tag").val('');
}

function removetag(idd){
	if(confirm("Are you sure you want to remove this tag?")){
		$("#tg_"+idd).remove();
	}
}
</script>

<?php 
   //echo validation_errors(); 
   $attributes = array('id' => 'createpost');
   echo form_open(base_url().ADMIN.'/createblog', $attributes); 
   ?>

<?php if ( isset ($haserror ) ) {?>
<div class="alert alert-danger"><?php echo $errormsg; ?></div>
<?php  } ?>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="cust_head">Create Blog</h3></div>
<div class="panel-body">

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Title</label>
           <input type="text" class="form-control" id="exampleInputEmail1"  name="title" value="<?php echo stripslashes($this->input->post('title'));?>">
          </div> 
    </div>
   
    

        
        


</div>


<div class="row">


        <div class="col-sm-12">
            <div class="form-group" id="desdiv">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control" rows="4" name="description" id="editor1" onchange="addDes()"><?php echo $this->input->post('description');?></textarea>
                <script>
					CKEDITOR.replace( 'editor1', {
						toolbarGroups  : [
							{ name: 'basicstyles', groups: [ 'basicstyles' ] },
							{ name: 'links'}
						],
							enterMode : CKEDITOR.ENTER_BR
					});
				</script>
            </div> 
            <input type="hidden" name="descriptioncheck" value="" id="descriptioncheck"> 
        </div>
    
</div>
 
 <div class="row">
  <div class="col-sm-6 pd30">
        <div class="form-group">
           <label for="exampleInputEmail1">Website</label>
           <input type="text" class="form-control" id=""  name="url" value="<?php echo stripslashes($this->input->post('url'));?>">
           <p class="Cus-pN">[ Eg :http://www.google.com ]</span></p>
          </div> 
    </div>
	<div class="clear"></div>
	
    <div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Video Embed Code</label>
           <input type="text" class="form-control" id="embedcode"  name="embedcode" value="<?php echo stripslashes($this->input->post('embedcode'));?>">
		   <p class="Cus-pNqop">[ Eg: &lt;iframe width="560" height="315" src="//www.youtube.com/embed/Dw8_8ksWzNA" frameborder="0" allowfullscreen>&lt;/iframe&gt;]</p>
          </div> 
    </div>
	<div class="clear"></div>
	 </div> 
	<div class="row">

    <div class="col-sm-6">
        <div id="imageexists">
           <label for="exampleInputEmail1">Upload Image</label>
            <input type="hidden" name="tempimage" value="" id="tempimage"/>
             <div id="showimg" style="display:none"  class="cus-crss">
             <img src="<?php //echo $AdminDet['../post/profImg'];?>" width="630" class="img-thumbnail cus-imgN" id="img_profile"/>
             <a id="removeid" onclick="changeimage()" class="Crp-dlt">
              <span class="glyphicon glyphicon-remove"></span>
             </a>
             </div>
              <div id="hideimg">
              <a href="<?php echo base_url().'crop/index/post'; ?>" class="upload btn btn-default cboxElement"><span class="glyphicon glyphicon-camera"></span> Add Image</a>
           </div>
          
          </div> 
    </div>
    
    




<?php  if(!empty($tags)): ?>
<div class="col-sm-6">
        <div class="form-group">
           <label for="exampleInputEmail1">Tags</label>
           <div class="nmtag">
               <!--<input type="text" class="form-control" id="tag"  name="tag" value=""  maxlength ="40" style="width:250px;">
               <a onclick="addTag()" class="glyphicon glyphicon-plus addtag" title="Add Tag"></a>-->
				<?php foreach($tags as $tk => $tval){?>
					<input type="checkbox" name="tags[]" value="<?php  echo $tval['tagid'];?>"> <?php  echo $tval['tagname'];?>
				<?php }?>

           </div>
                      <div id="taglist">
           
           </div>
          </div> 
    </div> <?php  endif; ?>
</div>
</div>
<input type="hidden" name="addpost" value="1">
<center style="margin-bottom: 20px" class="cntr-top"><button type="submit" class="btn btn-primary">Submit</button> <button type="button" class="btn btn-default" onclick="javascript:history.back(1)">Cancel</button></center>
</div>
</div>
</form>

<div id="uploaderoverlay"></div>
 