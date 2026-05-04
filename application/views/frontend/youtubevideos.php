<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js'></script>
<script src="https://apis.google.com/js/plus.js?onload=init"></script>
<script type='text/javascript' src='https://apis.google.com/js/api.js' async defer></script>
<script src="https://apis.google.com/js/platform.js?onload=onLoadCallback" async defer></script>
<script type='text/javascript' src='https://apis.google.com/js/platform.js' async defer></script>



<script src="<?php echo base_url('js'); ?>/jquery_newsTicker.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css'></link>
 



<script src="https://apis.google.com/js/api.js"></script>
<script>
  /**
   * Sample JavaScript code for photoslibrary.mediaItems.get
   * See instructions for running APIs Explorer code samples locally:
   * https://developers.google.com/explorer-help/code-samples#javascript
   */

  function authenticate() {
    return gapi.auth2.getAuthInstance()
        .signIn({scope: "https://www.googleapis.com/auth/photoslibrary https://www.googleapis.com/auth/photoslibrary.readonly https://www.googleapis.com/auth/photoslibrary.readonly.appcreateddata"})
        .then(function() { console.log("Sign-in successful"); },
              function(err) { console.error("Error signing in", err); });
  }
  
  
  
  
  function loadClient() {
    gapi.client.setApiKey("AIzaSyBGjF0wfQ0ozuRLq_kTpQ5fYgY_rXld7HA");
    //alert("https://photoslibrary.googleapis.com/$discovery/rest?version=v1")
    return gapi.client.load("https://photoslibrary.googleapis.com/$discovery/rest?version=v1")
        .then(function() { 
            console.log("GAPI client loaded for API"); 
            alert("client loaded") ;
        },
              function(err) { 
              console.error("Error loading GAPI client for API", err);
              
                  
              });
  }
  // Make sure the client is loaded and sign-in is complete before calling this method.
  function execute() {
    return gapi.client.photoslibrary.mediaItems.list({
           "pageSize": 1
        })
        .then(function(response) {
                alert("dfdf");
                // Handle the results here (response.result has the parsed body).
                console.log("Response", response);
              },
              function(err) {
                    alert("error");
                  console.error("Execute error", err); });
   
   
  }
  
  
  gapi.load("client:auth2", function() {
    gapi.auth2.init({client_id: "612497566580-gkftcj0581joti69saqhrj69fi7uln02.apps.googleusercontent.com"});
  });
</script>






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
            showVideoList("UCt5sACuHIyRWp2vmLM4OdEw", "utube_feed", 10, "AIzaSyAG6gN5KkqKuwtSVUY-A8PLfFm4JaYdNTY");
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
                    $.each( data.items, function( i, item ) {
                        console.log(item)
                      $('#results').append('<li>https://www.youtube.com/embed/' + item.id.videoId + '</li>');
                      
                       //var videothumbnail = 'https://i.ytimg.com/vi/'+videoid+'/maxresdefault.jpg';
                   // var videothumbnail = 'https://img.youtube.com/vi/' + item.id.videoId + '/mqdefault.jpg';
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
    
        
    $('.videopopup').on('hidden.bs.modal', function(e) {
        $("#videowrapper").html('');
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
		 <h3 class="greshblu PTB20 PLR10 bgadj fadeInRight wow">Gallery</h3>
         <div class="col-lg-4 col-sm-12 col-xs-12 footer-split BN-md ytscroll">
            <div class="socialfeed-head mb0">
                <span class="social-youtube"></span>
                <p>YouTube Videos</p>
            </div>
        
            <div class="social_feed-container">
                <i class="" id="utube_feed-prev"><span class="glyphicon glyphicon-chevron-up"></span></i>
                <ul id="utube_feed" class="clearfix liveyoutube"></ul>
                <i class="" id="utube_feed-next"><span class="glyphicon glyphicon-chevron-down"></span></i>
            </div>
        
            <a href="https://www.youtube.com/user/livingclassroomsfnd" class="btn-readmore slideLeft">More Videos</a>
        </div>
          
	<div class="clear"></div>


<button onclick="authenticate().then(loadClient)">authorize and load</button>
<button onclick="execute()">execute</button>


</div>