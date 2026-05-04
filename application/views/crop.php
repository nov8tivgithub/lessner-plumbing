<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title?></title>
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>styles/backend/custom.css" />
        <script src="<?php echo base_url(); ?>scripts/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>scripts/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>scripts/jquery.validate.js" type="text/javascript"></script>
	
	<!-- Jcrop Scripts / Styles-->
	<script src="<?php echo base_url(); ?>scripts/jcrop/js/jquery.Jcrop.min.js"></script>
	<script src="<?php echo base_url(); ?>scripts/jcrop/js/jquery.color.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>scripts/jcrop/css/jquery.Jcrop.min.css" />
	
    </head>    
    <body>
    
    <style>	
	.prelod {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: rgba(0, 0, 0, 0);
    background-image: url("<?php echo base_url(); ?>images/lespre.gif");
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: no-repeat;
    background-size: auto auto;
    display: block;
    height: 35px;
    width: 35px;
}
</style>
	
	<script>
	    function closeColorBox(){
		parent.$.fn.colorbox.close();
	    }
	    
	    
	    jQuery(function($){
		 var jcrop_api;

		$('#target').Jcrop({
		    boxWidth: 375,
		    aspectRatio: <?php echo $imageSizes["width"];?>/<?php echo $imageSizes["height"];?>,
		    minSize: [ <?php echo $imageSizes["width"];?>, <?php echo $imageSizes["height"];?> ],
		    allowSelect: false,
		    setSelect: [ 0, 0, <?php echo $imageSizes["width"];?>, <?php echo $imageSizes["height"];?> ],
		    onChange:   attachCoords,
		    onSelect:   attachCoords,

		},function(){
		  jcrop_api = this;
		});
	    });
	    
	    
	    function attachCoords(c){
	      $('#x1').val(c.x);
	      $('#y1').val(c.y);
	      $('#x2').val(c.x2);
	      $('#y2').val(c.y2);
	      $('#w').val(c.w);
	      $('#h').val(c.h);
	    };
		
		$(document).ready(function(){
		$("#preloaddiv").html('');
			$("#firstsub").click(function(){
				//alert('asad');
				$("#preloaddiv").html('<div class="preInnr">Please wait while we upload…<span class="prelod cuspreNW"></span></div>');
			});
		});
	    
	</script>
	
	
	<div class="UPerror"><?php echo $error;?></div>
	
	<?php if($view == 1){ ?>
	<?php echo form_open_multipart('');?>
	    <input type="hidden" name="fileupload" />
         <input type="hidden" name="imtype" value="<?php echo $type;?>"/>
	  <div class="panel panel-default"><button type="button" class="close cus-clse" data-dismiss="modal" aria-hidden="true" onClick="closeColorBox();"></button>
	      <div class="panel-heading">
		<h4>Upload an image and crop</h4>
         
	      </div>
	      <div id="preloaddiv"></div>
	      <div class="panel-body">
		<div class="form-group">
		  <label for="exampleInputFile">Please upload a JPG/GIF/PNG image with minimum dimensions of <?php echo $imageSizes["width"];?>x<?php echo $imageSizes["height"];?>px (Width/Height) and max file size 6MB.</label>
		  <input type="file" id="exampleInputFile" name="myfile" />
		</div>
		
		<center><button class="btn btn-primary" type="submit" id="firstsub">Upload</button> <button class="btn btn-default" type="button" onClick="closeColorBox();">Cancel</button></center>
	      </div>
	  </div>
	</form>
	<?php } ?>
	
	<?php if($view == 2){ ?>
	
	    <form method="post">
		
		<input type="hidden" name="thumbnail" value="1" />
		<input type="hidden" id="x1" name="x1" value="0"/>
		<input type="hidden" id="y1" name="y1" value="0"/>
		<input type="hidden" id="x2" name="x2" value="0"/>
		<input type="hidden" id="y2" name="y2" value="0"/>
		<input type="hidden" id="w" name="w" value="0"/>
		<input type="hidden" id="h" name="h" value="0"/>
		<input type="hidden" name="imagekey" value="<?php echo $imagekey; ?>" />
		
		<div class="panel panel-default">
		    <div class="panel-heading">
		      <h4>Upload an image and crop</h4>
		    </div>
		    
		    <div class="panel-body">
			  <img src="<?php echo $imageLink; ?>" id="target" alt="Crop" />
		    </div>
		    
		    <center><button class="btn btn-primary" type="submit">Upload</button> <button class="btn btn-default" type="button" onClick="closeColorBox();">Cancel</button></center>
		    <br/>
		</div>
	    </form>
	
	<?php } ?>
	
	<?php if($view == 3){ ?>
	    	<script>
		    parent.profileImage('<?php echo $imagekey;?>','<?php echo $imagePath;?>');
		    parent.$.fn.colorbox.close(); 
		</script>
	<?php } ?>
	
    </body>
</html>    