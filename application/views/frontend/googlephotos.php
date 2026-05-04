<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js'></script>
<script src="https://apis.google.com/js/plus.js?onload=init"></script>
<script type='text/javascript' src='https://apis.google.com/js/api.js' async defer></script>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
<script type='text/javascript' src='https://apis.google.com/js/platform.js' async defer></script>



<script src="<?php echo base_url('js'); ?>/jquery_newsTicker.js" type="text/javascript"></script>


<link rel="stylesheet" type="text/css" href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css'></link>
<link rel="stylesheet" type="text/css" href='<?php echo base_url('styles'); ?>/lightbox.min.css'></link>
 
<style>
.txt-socialhead{line-height:20px !important;}
.lb-outerContainer img.lb-image{ position: relative !important;}
.PTB20 {padding: 29px 24px;margin-top: 377px; margin-bottom:0px;}
.grndtnk p{height: 66px; }
@media only screen and (max-width: 1200px) and (min-width: 1024px)  {


.grndtnk p {
  height: 66px;
  font-size: 18px;
  
}
.greshblu{margin-bottom:0px !important;}
.google-pic li {
  width: 195px !important;
}


}
    @media screen and (min-width: 992px) {
  .tabPanel-widget label:nth-child(1), .tabPanel-widget h2:nth-child(3) {left: 19em;}
  .tabPanel-widget label:nth-child(5), .tabPanel-widget h2:nth-child(7) {left: 28em;}
  .lb-loader{margin-top:400px !important;}
  ul.liveyoutube li{max-width: 220px; max-height: 180px;}
  .google-pic li{width: 210px;}

  .img-preview img {
    width: 100% !important;
    object-fit: cover;
    height: 192px;
}

    }

    @media only screen and (max-width: 1000px) and (min-width: 991px)  {
      ul.liveyoutube li {max-width: 286px !important; float: left !important;}
      .tabPanel-widget label:nth-child(5), .tabPanel-widget h2:nth-child(7){left: 448px !important;}
      .tabPanel-widget label:nth-child(1), .tabPanel-widget h2:nth-child(3){left: 290px !important;}
      .google-pic li{width: 192px !important; height:162px !important;}
}
    @media screen and (max-width: 992px) {
        .lb-closeContainer{z-index:3333 !important; position: absolute !important;}
        .tabPanel-widget label:nth-child(1), .tabPanel-widget h2:nth-child(3) {left: 160px;}
        .tabPanel-widget label:nth-child(5), .tabPanel-widget h2:nth-child(7) {left: 315px;}
        .service_statbx { width: 100% !important;}
        .lb-loader {top:250px !important;}
        .greshblu{margin-bottom:0px !important;}
        .grndtnk p{height:70px;}
        .lstbx {  padding: 25px 0 0 0px;   min-height: 81px !important;

    }

    @media only screen and (max-width: 556px) and (min-width: 320px)  {
        .PTB20{ margin-top:100px !important;}
        ul.liveyoutube li{max-width: 300px; padding: 10px 30px 0px 0px;}
        ul.liveyoutube{width:300px !important;}
        .google-pic ul{padding:0px !important;}
        .google-pic li{width:100% !important; height: 200px !important;}
        
       }

       @media only screen and (max-width: 584px) and (min-width: 557px)  {
        ul.liveyoutube li{float: left !important;}
        ul.liveyoutube{width:110% !important; }
        ul.liveyoutube li{ max-width: 172px !important;}
        .PTB20{ margin-top:100px !important;}
        .google-pic li{width: 200px !important;}
    }
  


    

    @media only screen and (max-width: 990px) and (min-width: 585px)  {
        ul.liveyoutube{width:100% !important;}
        ul.liveyoutube li{max-width:255px !important;  float: left !important;
            
        }
    }

    @media only screen and (max-width:767px) and (min-width: 700px)  {
        ul.liveyoutube li {max-width: 219px !important;  float: left !important; height: 191px;}
        .tabPanel-widget label:nth-child(1), .tabPanel-widget h2:nth-child(3) {left: 191px;}
        .tabPanel-widget label:nth-child(5), .tabPanel-widget h2:nth-child(7) {left: 349px;}
        .google-pic li{width: 200px !important;}
    }

    @media screen and (max-width: 575px) {
        .tabPanel-widget label:nth-child(1), .tabPanel-widget h2:nth-child(3) {left: 0px;}
        .tabPanel-widget label:nth-child(5), .tabPanel-widget h2:nth-child(7) {left: 146px;}
    }
   
</style>


<script src="https://apis.google.com/js/api.js"></script>






<script>
    var nt_exampleutube = $('#utube_feed').newsTicker({
        row_height: 165,
        max_rows: 1,
        duration: 4000,
        prevButton: $('#utube_feed-prev'),
        nextButton: $('#utube_feed-next')
    });
    
  
    
    $(document).ready(function() {
  
        setTimeout(function() {
            //showVideoList("livingclassroomsfnd", "utube_feed", 10, "AIzaSyC2eF-q6GsEVclw1dB4_InY-42WjopQo0k");
            showVideoList("UCNcsUgezX9d04H4fmK82Ozw", "utube_feed", 10, "AIzaSyBC5zTubnIcEmXJfdOYtiOtFCsWXzPkgnI");
        }, 1000);
    });
    
    function showVideoList(username, writediv, maxnumbervideos, apikey) {
        try {
            
             $.get(
                "https://www.googleapis.com/youtube/v3/search",{
                  part : 'snippet', 
                  channelId : username, // You can get one from Advanced settings on YouTube
                  type : 'video',
                  key: apikey },
                  function(data) {
                      console.log( data.items );
                    $.each( data.items, function( i, item ) {
                      $('#results').append('<li>https://www.youtube.com/embed/' + item.id.videoId + '</li>');
                      
                       //var videothumbnail = 'https://i.ytimg.com/vi/'+videoid+'/maxresdefault.jpg';
                   // var videothumbnail = 'https://img.youtube.com/vi/' + item.id.videoId + '/1.jpg';
                     var videothumbnail = 'https://i.ytimg.com/vi/' + item.id.videoId + '/mqdefault.jpg';
                    document.getElementById(writediv).innerHTML += "<li class='liveyoutube'><div class='col-xs-12 p0'><div class='social-imgwrp'>" +
                        "<a class='video_trigger' onclick='videopopup(this," + '"video"' + ")' data-video='" + item.id.videoId + "' data-type='video' data-name='" + item.snippet.title + "'>" +
                        "<span></span><img src='" + videothumbnail + "'></a>" +
                        "<div class='feature-video' style='display:none;'><p class='modeltitle'></p>" +
                        "<div class='videourl' id='" + item.id.videoId + "'></div></div></div></div>" +
                        "<div class='col-xs-12 mt15-xxs tc'><p class='txt-socialhead'>" + item.snippet.title + "</p></div></li>";
                        
                    })
                  }
              );
            
            
        } catch (ex) {
            //alert(ex.message);
        }
    }
    
    
    
    $('.popcls').click(function() {
            //$('#Overlay').css({"height":$(document).height(),"width":$(window).width()}).show();
            var widadj = ($(window).width() / 2) - 452;
            var widadh = ($(window).height() / 2) - 266;

            //$('.pop').fadeIn("slow").css({left:widadj+'px',top:widadh+'px'});
            if ($(this).attr('data-type') == 'video') {
                var ytemb = '<iframe type="text/html" width="854" height="510" frameborder="0" src="https://www.youtube.com/embed/' + $(this).attr("id") + '" ></iframe>';
            } else {
                var ytemb = '<iframe width="854" height="510" src="https://www.youtube.com/embed/videoseries?list=' + $(this).attr("id") + '" frameborder="0" allowfullscreen></iframe>';
            }

            $("#youholder").html(ytemb);
            $("#videopop").modal('show')
    });

    $('.video_trigger').click(function() {
        $('.videopopup').modal('show')
        if ($(this).attr('data-type') == 'video') {
            var videoframe = '<iframe width="100%" height="490" src="https://www.youtube.com/embed/' + $(this).attr('data-video') + '?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';
        } else {
            var videoframe = '<iframe width="854" height="510" src="https://www.youtube.com/embed/videoseries?list=' + $(this).attr("data-video") + '" frameborder="0" allowfullscreen></iframe>';
        }
        var videoname = $(this).attr('data-name');
        $("#myModalLabel").html(videoname);
        $("#videowrapper").html(videoframe);
    });
    
    
    $("body").click(function() {
           if ($('#mypopup_video').is(":visible")) {
               $('.homevideo').attr('src','');
                $("#mypopup_video").modal('hide');
           }
        });
    
        
    $('#mypopup_video').on('hidden.bs.modal', function(e) {
        
        $("#videowrapper").html('');
        $('.homevideo').attr('src','');
        $("#mypopup_video").modal('hide');
    })

    var mobileHover = function() {
        $('*').on('touchstart', function() {
            $(this).trigger('hover');
        }).on('touchend', function() {
            $(this).trigger('hover');
        });
    };

    mobileHover();
    
    function modelpopup(popupcls){
      $('#popuptitle').text($('.'+popupcls).children('.modeltitle').text());
      $('#popupcontent').html($('.'+popupcls).children('.modelcontent').html());
      if(! $("#mypopup").hasClass('show') ){
       $("#mypopup").modal('show');
      }
   }


    function videopopup(ths,thstype){
      if(thstype == 'video'){
        var embdkey = $(ths).siblings('.feature-video').children('.videourl').attr('id');
        var embdurl = 'https://www.youtube.com/embed/'+embdkey+'?rel=0&hd=1&autoplay=1';
        var title= $(ths).siblings('.feature-video').children('.modeltitle').text();
        $('.homevideo').attr('src',embdurl);
        $('.homevideo').show();
        $('.homeimage').hide();
        
       }else if(thstype == 'image'){
        var embdurl = $(ths).siblings('.feature-image').children('.imageurl').attr('src');
        $('.homeimage').attr('src',embdurl);
        $('.homeimage').show();
        $('.homevideo').hide();
      }
      $('#video_popuptitle').text(title);
      $("#mypopup_video").modal('show');
    }

    function videoModalClose(){
        $('.homevideo').attr('src','');
        $("#mypopup_video").modal('hide');
    }

    function modalClose(){
        $('.homevideo').attr('src','');
        $("#mypopup").modal('hide');
    }
    
    
    
  
 
    
    function handlePhotoApiAuthResult(authResult) {
        console.log(authResult)
        if (authResult && !authResult.error) {
            oauthToken = authResult.access_token;
    
                   GetAllPhotoGoogleApi();
        }
    }
    
    
    function GetAllPhotoGoogleApi() {
           gapi.client.request({
            'path': 'https://photoslibrary.googleapis.com/v1/mediaItems:search',
            'method': 'POST',
            'body': {
                "filters": {
                    "mediaTypeFilter": {
                        "mediaTypes": ["PHOTO"]
                    }
                }
            }
        }).then(function (response) {
            console.log(response);     
    
        }, function (reason) {
            console.log(reason);
        });
    }
    
</script>

<?php 
                            
      $json = file_get_contents('https://script.google.com/macros/s/AKfycbwIGrl6QGuSb5BZJGwHGMMjeyTwa3A4J5hTZqu9kZT2TvkRHZ_2NMAzdlfUqS3pVcfH8A/exec?authuser=2');
      $imageData = json_decode($json, true);
 
      $list = $imageData['data'];
      

$finalImageArray = array();

if( !empty(  $imageData ) ){
        foreach( $imageData as $imgID ){
              $finalImageArray[] = $imgID;
        }
    }

    $imgListArray = ( isset( $finalImageArray[1] ) ) ? $finalImageArray[1] : array();


      $finalImageArray = array();
    
                 
   ?>
 
<div class="modal fade" tabindex="-1" role="dialog" id="mypopup_video">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="video_popuptitle"></h4>
        <button type="button" class="close" data-dismiss="modal" onclick="videoModalClose();" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="video_popupcontent">
    <iframe class="homevideo pop-video" src="" allow="autoplay; encrypted-media" allowfullscreen="" style="width: 100%; height: 400px;" frameborder="0"></iframe>
    <img class="homeimage pop-image" src="" style="width: 100%;" />
    </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" tabindex="-1" role="dialog" id="mypopup">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="popuptitle"></h4>
        <button type="button" class="close" data-dismiss="modal" onclick="modalClose();"  aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="popupcontent">
    
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->








	
    <div id="banepic">
    	<div class="srvcbanr"></div>
            <h3 class="greshblu PTB20 bgadj fadeInRight wow">Services</h3>
        <div class="grbgcon">
        	<p class="contp fadeInLeft wow">At Lessner Plumbing we offer professional plumbing services for your home and business. Proudly service the Baltimore, Maryland metropolitan area including Baltimore County, Baltimore City, Carroll County and Harford County.
</p>
        <div class="statbx_contnr fadeInRight wow">    
            <a class="service_statbx FL" href="<?php  echo base_url('draincleaning'); ?>">
            	<div class="imgcrcl"><img src="img/draincleaning.jpg" /></div>
                <span class="sublnk">Drain Cleaning Services</span> 
            </a>
            <a class="service_statbx FR" href="<?php  echo base_url('polybutylenepipe'); ?>">
            	<div class="imgcrcl"><img src="img/polybutylene.jpg" /></div>
              	<span class="sublnk">Polybutylene Pipe Replacement and Water Service Repair</span>
            </a >
        <div class="clear"></div>    
        </div>
        
          <div class="w970 fadeInLeft wow">
            	<div class="grndtnk">
              <p>New Construction Groundwork</p>
              	<img class="grndtnkimg" src="img/groundwork.jpg"/>
              </div>
              <div class="grndtnk">
              <p>Well tanks, Well Pumps and Water Treatment Symstems</p>
              	<img class="grndtnkimg" src="img/welltanks.jpg"/>
              </div>
              <div class="clear"></div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="bgfff">
        <div class="w970 fadeInLeft wow">
        	<div class="subhead">Professional, Clean, and Courteous Plumbing Services are</div>
            <div class="list">
           		<div class="lstbx FL">Basement Waterproofing (Waterproofing for basements)</div>
        		<div class="lstbx FR">Boiler and radiant heat systems</div>
                <div class="clear"></div>
        		<div class="lstbx FL">Drain cleaning</div>
                <div class="lstbx FR">Gas lines</div>
                <div class="clear"></div>
						<div class="lstbx FL">Excavation services</div>
                <div class="lstbx FR">Flood Restoration Services</div>
                <div class="clear"></div>
        		<div class="lstbx FL">Plumbing repairs</div>
                <div class="lstbx FR">Polybutylene Pipe Replacement and Water Service Repair</div>
                <div class="clear"></div>	
        		<div class="lstbx FL">Sewer Lines</div>
                <div class="lstbx FR">Septic systems</div>
                <div class="clear"></div>
        		<div class="lstbx FL">Sump pumps</div>
                <div class="lstbx FR">Trench-less water services</div>
                <div class="clear"></div>	
        		<div class="lstbx FL">Utility work</div>
                <div class="lstbx FR">Water heaters</div>
                <div class="clear"></div>
        		<div class="lstbx FL">Water lines</div>
                <div class="lstbx FR">Water treatment systems</div>
                <div class="clear"></div>
                <div class="lstbx FL">Well pumps and Systems</div>
                <div class="clear"></div>
            </div>    
        </div>
        <div class="clear"></div>
                <!--Tab-->
                <div class="w970 fadeInRight wow">

<div class="tabPanel-widget">

<label for="tab-1" tabindex="0"></label>
<input id="tab-1" type="radio" name="tabs" checked="true" aria-hidden="true">

<h2>Videos</h2>

<div>
 <div class="col-lg-4 footer-split BN-md ytscroll">
    <div class="socialfeed-head mb0">
        <span class="social-youtube"></span>
        <p>YouTube Videos</p>
    </div>

    <div class="social_feed-container">
        <i class="" id="utube_feed-prev"><span class="glyphicon glyphicon-chevron-up"></span></i>
        <ul id="utube_feed" class="clearfix liveyoutube"></ul>
        <i class="" id="utube_feed-next"><span class="glyphicon glyphicon-chevron-down"></span></i>
    </div>

    <a target="_blank" href="https://www.youtube.com/@lessnerplumbing328" class="btn-readmore slideLeft">More Videos</a>
</div>


</div>

<label for="tab-2" tabindex="0"></label>
<input id="tab-2" type="radio" name="tabs" aria-hidden="true">

<h2>Photos</h2>

<div class="google-pic">
    <ul>
<?php
  if( !empty( $imgListArray ) ){
       for($i=0; $i<count($imgListArray); $i++){
         echo '<li>
     <div class="img-preview"><a href="https://drive.google.com/uc?export=view&id='.$imgListArray[$i]['img_id'].'" data-imgkey = "'.$imgListArray[$i]['img_id'].'" data-lightbox="example-set"  class="multi-img"  ><img src="https://drive.google.com/uc?export=view&id='.$imgListArray[$i]['img_id'].'" class=""></a></div></li>';
        }  
  }else{
       echo '<li style="float: inherit !important;"><div>
       <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets3.lottiefiles.com/packages/lf20_yMTq6U/photo.json"  background="transparent"  speed="1"  style="display:block; width: 82px; height: 76px; margin:auto; margin-top:20px;"  loop  autoplay></lottie-player>
      
<h4 style="font-size: 1rem;text-align: center;">Please check back later!</h4>
</div></li>';
  }
   
?>
</ul>
</div>

</div>

</div>
<!--Tab end-->
        </div>        
        <div class="clear"></div>
        </div>

        <div class="grbgcon">
        <div class="w970 fadeInRight wow">
        <div class="text-center">
        
        	<div class="foot_caption fon20">Professional, Clean, and Courteous Plumbing Services</div>
            <div class="foot_caption fon18">Our plumbing customers are thrilled with our work.</div>
            <div class="foot_caption fon14">Residential & Commercial Plumbing Licensed & Insured</div>
        </div>
        </div>
        </div>
    <div class="clear"></div>
    </div>
    
<script src="<?php echo base_url('js'); ?>/lightbox-plus-jquery.min.js" type="text/javascript"></script>

