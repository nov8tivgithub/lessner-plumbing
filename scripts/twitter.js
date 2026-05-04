//Twitter
window.onload = function() {
	var ajax_load = "Loading...";
	//var url = 'https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=DRI_Intl&count=2&callback=twitterCallback2';
	var url = 'https://www.thewildpea.com/scripts/twitter.php?url='+encodeURIComponent('statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name=WildPeaHummous&callback=twitterCallback2');
	var script = document.createElement('script');
	$("#twitter_feed").html(ajax_load);
	script.setAttribute('src', url);
	document.body.appendChild(script);
}

function twitterCallback2(twitters) {
  var statusHTML = [];
  for (var i=0; i<twitters.length; i++){
    var username = twitters[i].user.screen_name;
    var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g,
	function(url) { return '<a href="'+url+'">'+url+'</a>';
    }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return  reply.charAt(0)+'<a href="http://twitter.com/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
    });
	//alert(status);
    //statusHTML.push('<li><div class="twitrow"><div class="twitstatus"><p>'+status+'</p></div><div class="twitter_date"><a href="http://twitter.com/'+username+'/statuses/'+twitters[i].id+'">'+relative_time(twitters[i].created_at)+'</a></div></div></li>');
    statusHTML.push('<li>'+status+'</li>');
  }
  $("#twitter_feed").html(statusHTML.join(''));
  // alert("hi");
   activate();
}

function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + " " + values[5] + " " + values[3];
  var parsed_date = new Date();
  parsed_date.setTime(Date.parse(time_value));
  var months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
	'Sep', 'Oct', 'Nov', 'Dec');
  var m = parsed_date.getMonth();
  var postedAt = '';
  postedAt = months[m];
  postedAt += " "+ parsed_date.getDate();
  postedAt += ","
  postedAt += " "+ parsed_date.getFullYear();
  return postedAt;
}

function activate(){



				$("#slider2").easySlider({
					auto: true, 
					continuous: true
					//nextId: "slider1next",
					//prevId: "slider1prev"
		
				});

	/* $('#twitter_update_list').bjqs({
          'animation' : 'fade',
		  continuous: true
        });*/
	/*$("#slider").easySlider({
		auto: true, 
		continuous: true
	});*/
	
  /* $(".news_flip").newsFade({
      auto:true,
      interval:6000
    });*/
  
}
