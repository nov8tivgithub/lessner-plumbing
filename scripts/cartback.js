var ajaxurl = 'frontend/cart';
var paymenturl = 'frontend/payment';

function userlogin() {
    if ($("#login").valid()) {
        $("#login").submit();
    }
}


$(document).ready(function () {
    $("#login").validate({

        rules: {

            password: 'required',

            email: {
                required: true,
                email: true
            }


        },
        messages: {

            email: {
                required: "Please enter Email",
                email: "Please enter a valid Email"

            },

            password: 'Please enter Password'

        }

    });

    $("#shipping").validate({

        rules: {
            shipfname: 'required',
            shiplname: 'required',

            shipaddress: 'required',
            shipcity: 'required',


            shipzip: {
                required: true,
                postalcode: true
            },
            shipphone: {
                required: true,
                phoneUS: true
            },

            shipemail: {
                required: true,
                email: true
            },
            shipcountry: {
                required: true,
            },
            ship_state_other: {
                required: function () {
                    return $("#shipcountry").val() != "United States of America";
                }
            },
            shipstate: {
                required: function () {
                    return $("#shipcountry").val() == "United States of America";
                }
            },
            paymenttype: {
                required: function () {
                    return $("#shipcountry").val() == "United States of America";
                }
            },
            paymenttype_int: {
                required: function () {
                    return $("#shipcountry").val() != "United States of America";
                }
            }


        },
        messages: {
            shipfname: 'Please enter First Name',
            shiplname: 'Please enter Last Name',
            shipaddress: 'Please enter Address',
            shipcity: 'Please enter City',
            shipcountry: 'Please select Country',
            shipstate: 'Please select State',
            ship_state_other: 'Please enter State',
            shipzip: 'Please enter valid Zip',
            shipphone: 'Please enter valid Phone#',
            shipemail: {
                required: "Please enter Email",
                email: "Please enter a valid Email"

            },
            paymenttype: 'Please select shipping type',
            paymenttype_int: 'Please select shipping type'

        }

    });

    $("#billing").validate({

        rules: {
            billfname: 'required',
            billlname: 'required',

            billaddress: 'required',
            billcity: 'required',
            billcountry: {
                required: true,
            },
            bill_state_other: {
                required: function () {
                    return $("#billcountry").val() != "United States of America";
                }
            },
            billstate: {
                required: function () {
                    return $("#billcountry").val() == "United States of America";
                }
            },

            billzip: {
                required: true,
                zip: true
            },
            billphone: {
                required: true,
                phone: true
            },

            billemail: {
                required: true,
                email: true
            }


        },
        messages: {
            billfname: 'Please enter First Name',
            billlname: 'Please enter Last Name',
            billaddress: 'Please enter Address',
            billcity: 'Please enter City',
            billcountry: 'Please select Country',
            billstate: 'Please select State',
            bill_state_other: 'Please enter State',
            billzip: 'Please enter valid Zip',
            billphone: 'Please enter valid Phone no#',
            billemail: {
                required: "Please enter Email",
                email: "Please enter a valid Email"

            }

        }

    });
    jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
		 if ( $("#shipcountry").val() == "United States of America" ){
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}
			else{
				return true;
			}
    });
	 jQuery.validator.addMethod("phone", function (phone_number, element) {
		 if ( $("#billcountry").val() == "United States of America" ){
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
		}
			else{
				return true;
			}
    });

    jQuery.validator.addMethod("postalcode", function (postalcode, element) {
       if ( $("#shipcountry").val() == "United States of America" ){
				return this.optional(element) || postalcode.match(/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXYabceghjklmnpstvxy]{1}\d{1}[A-Za-z]{1} ?\d{1}[A-Za-z]{1}\d{1})$/);
			}
			else{
				return true;
			}
    });
	jQuery.validator.addMethod("zip", function (postalcode, element) {
       if ( $("#billcountry").val() == "United States of America" ){
				return this.optional(element) || postalcode.match(/(^\d{5}(-\d{4})?$)|(^[ABCEGHJKLMNPRSTVXYabceghjklmnpstvxy]{1}\d{1}[A-Za-z]{1} ?\d{1}[A-Za-z]{1}\d{1})$/);
			}
			else{
				return true;
			}
    });

    $('.loginenter').keydown(function (event) {

        if (event.keyCode == 13) {
            if ($("#email").val() && $("#password").val()) {
                userlogin();
            } else {
                $("#login").valid();
            }
        }
    });


    $("input[name='cart_paymenttype']").click(function () {
        if ($(this).val() == "authorize" || $(this).val() == "paypal") {

            if ($(this).val() == "paypal") {
                $("#credit_dash").hide();

            } else {
                $("#credit_dash").show();


            }
        }

    });
    $("#payment").validate({

        rules: {


            card_type: {
                required: function () {
                    return $("input[name='cart_paymenttype']:checked").val() == "authorize";
                }
            },
            card_number: {
                required: function () {
                    return $("input[name='cart_paymenttype']:checked").val() == "authorize";
                }
            },
            cvvnumber: {
                required: function () {
                    return $("input[name='cart_paymenttype']:checked").val() == "authorize";
                }
            },
            paymonth: {
                required: function () {
                    return $("input[name='cart_paymenttype']:checked").val() == "authorize";
                }
            },
            payyear: {
                required: function () {
                    return $("input[name='cart_paymenttype']:checked").val() == "authorize";
                }
            },

        },
        messages: {


            card_type: 'Please select Card Type',
            card_number: 'Please enter  Card Number',
            cvvnumber: 'Please enter  CVV Number',
            paymonth: 'Please select Month',
            payyear: 'Please select Year'
        }
    });

});

function viewpack(rowid) {

    if (!$("#packslid_"+rowid).hasClass("pks")) {

        $("#packslid_"+rowid).slideDown().addClass("pks");
       

    } else {
        $("#packslid_"+rowid).slideUp().removeClass("pks");


    }

}
function addnewshipping() {

    if (!$("#shippinginfo").hasClass("meera")) {

        $("#shippinginfo").slideDown().addClass("meera");
       
		 $("html, body").animate({
            scrolltop: $("#shippinginfo").height()+106
        }, 1000);
		$("#shipfname").val('');
        $("#shiplname").val('');
        $("#shipaddress").val('');
        $("#shipcity").val('');
        $("#shipzip").val('');
        //$("#shipemail").val('');
        $("#shipphone").val('');
        //$("#shipmobile").val('');
        $("#shipstate").val('');
        $("#shipcountry").val('');
        $("#ship_state_other").val('');
		$("#addship").hide();

    } else {
        $("#shippinginfo").slideUp().removeClass("meera");


    }

}

function cancelshippinginfo() {
    
    $("#shippinginfo").slideUp().removeClass("meera");
    $("#addship").show();

}

function addshippinginfo() {
    if ($("#shipping").valid()) {
		
		var shpHTML = '<div id="shppreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'shippinginfo';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#shippinginfo").css({'position':'relative'});
		
		if (!$("#shippinginfo #shppreload").length){
			$("#shippinginfo").append(shpHTML);
		}
		
		$("#shppreload").css('left',divMidWidth+'px');
		$("#shppreload").css('top',divMidheight+'px');
		
		$("#shppreload").show();
		$("#shipping").fadeTo( "slow", 0.33 );
		
       
        $.post(ajaxurl + '/addaddressinfo', {
            shippingInfo: $("#shipping").serializeArray(),
            act: 'addshipping'
        }, function (data) {
			$("#shipping").fadeTo( "slow", 1 );	
			$("#shppreload").hide();
            if (data.success == '1') {
                $(".myship").removeClass("shpselact").addClass("shpseldeact");
                $("#shippingdata").html(data.shipdata);
				$("#shipmethoddiv").show();
				$("#shipmethoddiv").html(data.shipmethod);
                $('#shippinginfo').delay(4000).fadeOut(6000);
                $("#shippinginfo").hide();
				$("#addship").show();
				//$("#cancelshippinginfo").html('<a class="crtitmrmvqt" onclick="cancelshippinginfo(\'' + data.shipkey + '\')">X</a>');
				if (data.billkey == '' || data.billcount==0) {
                  // $("#billininfo").delay(0).fadeIn(6000);
				    //$("#sameship").html('<a class="selctshpadrs sameships" onclick="sameasshipping(\'' + data.shipkey + '\')">Same as Shipping Address</a>')
                }else{
					 //$("#billingdata").delay(0).fadeIn(6000);
					  //$("#paymentinfo").delay(0).fadeIn(6000);
				}
               
                //$("#billininfo").delay(0).fadeIn(6000);

            } 

        }, "json");
    }
}

function deleteship(shipkey) {
    if (confirm('Are you sure you want to remove this shipping address?')) {

        $.post(ajaxurl + '/deleteship', {

            act: 'deleteship',
            shipkey: shipkey
        }, function (data) {
            if (data.success == '1') {

                $("#shiprow_" + shipkey).fadeOut(function () {
                    $("#shiprow_" + shipkey).remove();
                });

                if ($("shiprow").length < 1) {
                    if (!$("#shippinginfo").hasClass("meera")) {

                        $("#shippinginfo").slideDown().addClass("meera");
						$("html, body").animate({
							scrolltop: $("#shippinginfo").height()+106
						}, 1000);
                       
						$("#cancelshippinginfo").html('');
						$("#shipmethoddiv").hide();
						$("#addship").hide();
						$("#shipfname").val('');
						$("#shipkey").val('');
						$("#shiplname").val('');
						$("#shipaddress").val('');
						$("#shipcity").val('');
						$("#shipzip").val('');
						//$("#shipemail").val('');
						$("#shipphone").val('');
						//$("#shipmobile").val('');
						$("#shipstate").val('');
						$("#shipcountry").val('');
						$("#ship_state_other").val('');
						$("#billingdata").hide();
						 $("#paymentinfo").hide();
						 $("#paymentreviewinfo").hide();

                    } else {
                        $("#shippinginfo").slideUp().removeClass("meera");


                    }
                }
                //if($(".shiprow").length)
            }

        }, "json");
    }

}

function editship(val) {
    if (!$("#shippinginfo").hasClass("meeras")) {
        $("#shippinginfo").slideDown().addClass("meeras");
		$("html, body").animate({
            scrolltop: $("#shippinginfo").height()+106
        }, 1000);
       
        $("#shipkey").val(val);
        $("#typeofship").val('edit');
        $("#shipfname").val($("#shipf_" + val).html());
        $("#shiplname").val($("#shipl_" + val).html());
        $("#shipaddress").val($("#shipa_" + val).html());
        $("#shipcity").val($("#shipc_" + val).html());
        $("#shipzip").val($("#shipz_" + val).html());
        //$("#shipemail").val($("#shipe_" + val).html());
        $("#shipphone").val($("#shipp_" + val).html());
        //$("#shipmobile").val($("#shipm_" + val).html());
        //$("#shipstate").val($("#ships_" + val).html());
        $("#shipcountry").val($("#shipcon_" + val).html());
        $("#shipmethoddiv").hide();
		$("#billininfo").hide();
		if($("#shipcon_" + val).html()!='United States of America'){
		 $("#state_other").show();
		 $("#ship_state_other").val($("#ships_" + val).html());
		 $("#state").hide();
		 
	}else{
		 $("#state_other").hide();
		 $("#state").show();
		 $("#shipstate").val($("#ships_" + val).html());
		 
	}


    } else {
        $("#shippinginfo").slideUp().removeClass("meeras");
        $("#typeofship").val('add');
        $("#shipkey").val('');
        $("#shipfname").val('');
        $("#shiplname").val('');
        $("#shipaddress").val('');
        $("#shipcity").val('');
        $("#shipzip").val('');
       //$("#shipemail").val('');
        $("#shipphone").val('');
        //$("#shipmobile").val('');
        $("#shipstate").val('');
        $("#shipcountry").val('');
        $("#ship_state_other").val('');


    }




}

function slectship(shipkey) {

    if (!$("#slectship_" + shipkey).hasClass("shpselact")) {
        $(".myship").removeClass("shpselact").addClass("shpseldeact");
        $("#shpselactkey").val('sessionadd');

        $("#slectship_" + shipkey).removeClass("shpseldeact").addClass("shpselact");


    } else {
        $("#slectship_" + shipkey).removeClass("shpselact").addClass("shpseldeact");
        $("#shpselactkey").val('sessionremove');

    }
    var session = $("#shpselactkey").val();
    $.post(ajaxurl + '/slectship', {

        act: 'slectship',
        shipkey: shipkey,
        setsession: $("#shpselactkey").val()
    }, function (data) {
        if (data.success == '1') {
            if (data.shipkey) {
				$("#shipmethoddiv").show();
				$("#shipmethoddiv").html(data.shipmethod);
				
				//$("#cancelshippinginfo").html('<a class="crtitmrmvqt" onclick="cancelshippinginfo(\'' + data.shipkey + '\')">X</a>');
                //$("#sameship").html('<a class="selctshpadrs sameships" onclick="sameasshipping(\'' + data.shipkey + '\')">Same as Shipping Address</a>')
                $("#shippinginfo").slideUp().removeClass("meeras");
            } else {
                alert('Please select your shipping address');
                $("#shippinginfo").slideDown().addClass("meeras");
				 $("#billingdata").hide();
				 $("#paymentinfo").hide();
				 $("#billininfo").hide();
				 $("#paymentreviewinfo").hide();
				 $("#shipmethoddiv").hide();
				 $("#shipkey").val('');
				  $("#shipfname").val('');
				  $("#shiplname").val('');
				  $("#shipaddress").val('');
				  $("#shipcity").val('');
				  $("#shipzip").val('');
				 //$("#shipemail").val('');
				  $("#shipphone").val('');
				  //$("#shipmobile").val('');
				  $("#shipstate").val('');
				  $("#shipcountry").val('');
				  $("#ship_state_other").val('');
            }
            if (data.billkey == '' && data.billcount==0) {
                //$("#billininfo").delay(0).fadeIn(6000);
            }else if(data.billkey && data.billcount>0 && data.shipkey ){
				 //$("#billingdata").delay(0).fadeIn(6000);
				 //$("#paymentinfo").delay(0).fadeIn(6000);
				}


        }

    }, "json");
}

function addnewbilling() {

    if (!$("#billininfo").hasClass("meerash")) {

        $("#billininfo").slideDown().addClass("meerash");

        $("html, body").animate({
            scrolltop: $("#billininfo").height()+106
        }, 1000);
		$("#billkey").val('');
        $("#billfname").val('');
        $("#billlname").val('');
        $("#billaddress").val('');
        $("#billcity").val('');
        $("#billzip").val('');
        $("#billemail").val('');
        $("#billphone").val('');
       
        $("#billstate").val('');
        $("#billcountry").val('');
        $("#bill_state_other").val('');
		$("#addbill").hide();

    } else {
        $("#billininfo").slideUp().removeClass("meerash");


    }

}

function cancelbillinginfo() {
 if ($(".billrow").length >= 1) { 
 $("html, body").animate({
            scrolltop: $("#addbill").height()+106
        }, 1000);
    
    $("#billininfo").slideUp().removeClass("meerash");
	$("#addbill").show();
 }
 else{
	 alert('Please add Billing Info');
 }
}

function addbillinginfo() {
    if ($("#billing").valid()) {

		var shpHTML = '<div id="billpreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'billininfo';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#billininfo").css({'position':'relative'});
		
		if (!$("#billininfo #billpreload").length){
			$("#billininfo").append(shpHTML);
		}
		
		$("#billpreload").css('left',divMidWidth+'px');
		$("#billpreload").css('top',divMidheight+'px');
		
		$("#billpreload").show();
		$("#billing").fadeTo( "slow", 0.33 );
		
        $.post(ajaxurl + '/addaddressinfo', {
            billingInfo: $("#billing").serializeArray(),
            act: 'addbilling'
        }, function (data) {
			$("#billing").fadeTo( "slow", 1 );
			$("#billpreload").hide();	
            if (data.success == '1') {
				$("#billingdata").show();
                $("#billingdata").html(data.billdata);
                $('#billininfo').delay(0).fadeOut(6000);
                $("#billininfo").hide();
                $("#paymentinfo").delay(0).fadeIn(6000);

            }

        }, "json");
    }
}

function deletebill(billkey) {
    if (confirm('Are you sure you want to remove this billing address?')) {

        $.post(ajaxurl + '/deletebill', {

            act: 'deletebill',
            billkey: billkey
        }, function (data) {
            if (data.success == '1') {

                $("#billrow_" + billkey).fadeOut(function () {
                    $("#billrow_" + billkey).remove();

                });

                if (data.billcount<1) {
                    if (!$("#billininfo").hasClass("meerash")) {

                        $("#billininfo").slideDown().addClass("meerash");

                        $("html, body").animate({
                            scrolltop: $("#billininfo").height()+106
                        }, 1000);
						$("#addbill").hide();
						$("#billkey").val('');
						$("#billfname").val('');
						$("#billlname").val('');
						$("#billaddress").val('');
						$("#billcity").val('');
						$("#billzip").val('');
						$("#billemail").val('');
						$("#billphone").val('');
					   
						$("#billstate").val('');
						$("#billcountry").val('');
						$("#bill_state_other").val('');
						$("#paymentinfo").hide();
				        $("#paymentreviewinfo").hide();

                    } else {
                        $("#billininfo").slideUp().removeClass("meerash");


                    }
                }
            }

        }, "json");
    }

}

function editbill(val) {
    
    if (!$("#billininfo").hasClass("ms")) {
        $("#billininfo").slideDown().addClass("ms");
        //$.scrollTo('#billininfo', 1000);
		$("html, body").animate({
            scrolltop: $("#billininfo").height()+106
        }, 1000);
        $("#billkey").val(val);
        $("#typeofbill").val('edit');
        $("#billfname").val($("#billf_" + val).html());
        $("#billlname").val($("#billl_" + val).html());
        $("#billaddress").val($("#billa_" + val).html());
        $("#billcity").val($("#billc_" + val).html());
        $("#billzip").val($("#billz_" + val).html());
        $("#billemail").val($("#bille_" + val).html());
        $("#billphone").val($("#billp_" + val).html());
        
        //$("#billstate").val($("#bills_" + val).html());
        $("#billcountry").val($("#billcon_" + val).html());
        //$("#bill_state_other").val($("#bills_" + val).html());
		if($("#billcon_" + val).html()!='United States of America'){
		 $("#state_otherbill").show();
		 $("#bill_state_other").val($("#bills_" + val).html());
		 $("#statebill").hide();
	}else{
		 $("#state_otherbill").hide();
		 $("#statebill").show();
		 $("#billstate").val($("#bills_" + val).html());
		 
	}


    } else {
        $("#billininfo").slideUp().removeClass("ms");
        $("#typeofbill").val('add');
        $("#billkey").val('');
        $("#billfname").val('');
        $("#billlname").val('');
        $("#billaddress").val('');
        $("#billcity").val('');
        $("#billzip").val('');
        $("#billemail").val('');
        $("#billphone").val('');
       
        $("#billstate").val('');
        $("#billcountry").val('');
        $("#bill_state_other").val('');


    }




}

function slectbill(billkey) {

    if (!$("#slectbill_" + billkey).hasClass("shpselact")) {
        $(".mybill").removeClass("shpselact").addClass("shpseldeact");
        $("#billselactkey").val('sessionadd');

        $("#slectbill_" + billkey).removeClass("shpseldeact").addClass("shpselact");


    } else {
        $("#slectbill_" + billkey).removeClass("shpselact").addClass("shpseldeact");
        $("#billselactkey").val('sessionremove');

    }
    var session = $("#billselactkey").val();
    $.post(ajaxurl + '/slectbill', {

        act: 'slectbill',
        billkey: billkey,
        setsession: $("#billselactkey").val()
    }, function (data) {
        if (data.success == '1') {

            if (data.billkey == '') {
                alert('Please select your billing address');
                $("#billininfo").slideDown().addClass("ms");
				 $("#paymentinfo").hide();
				 $("#paymentreviewinfo").hide();
				 $("#billkey").val('');
				$("#billfname").val('');
				$("#billlname").val('');
				$("#billaddress").val('');
				$("#billcity").val('');
				$("#billzip").val('');
				$("#billemail").val('');
				$("#billphone").val('');
			   
				$("#billstate").val('');
				$("#billcountry").val('');
				$("#bill_state_other").val('');
            }else{
				 $("#billininfo").slideUp().removeClass("ms");
				 $('#paymentinfo').delay(0).fadeIn(6000);
				  $("#paymentreviewinfo").hide();
			}

        }

    }, "json");
}

function sameasshipping(val) {
	
	if (!$(".sameships").hasClass("selctshpadrspani")) {
		
        $(".sameships").removeClass("selctshpadrs").addClass("selctshpadrspani");
		
		$("#billfname").val($("#shipf_" + val).html());
		$("#billlname").val($("#shipl_" + val).html());
		$("#billaddress").val($("#shipa_" + val).html());
		$("#billcity").val($("#shipc_" + val).html());
		$("#billzip").val($("#shipz_" + val).html());
		$("#billemail").val($("#shipe_" + val).html());
		$("#billphone").val($("#shipp_" + val).html());
		//$("#billmobile").val($("#shipm_" + val).html());
		if($("#shipcon_" + val).html()!='United States of America'){
			 $("#state_otherbill").show();
			 $("#bill_state_other").val($("#ships_" + val).html());
			 $("#statebill").hide();
		}else{
			 $("#state_otherbill").hide();
			 $("#statebill").show();
			 $("#billstate").val($("#ships_" + val).html());
			 
		}
		//$("#billstate").val($("#ships_" + val).html());
		$("#billcountry").val($("#shipcon_" + val).html());
		$("#bill_state_other").val($("#ships_" + val).html());


    } else {
        $(".sameships").removeClass("selctshpadrspani").addClass("selctshpadrs");
		$("#billfname").val('');
		$("#billlname").val('');
		$("#billaddress").val('');
		$("#billcity").val('');
		$("#billzip").val('');
		$("#billemail").val('');
		$("#billphone").val('');
		//$("#billmobile").val('');
		if($("#shipcon_" + val).html()!='United States of America'){
			 $("#state_otherbill").show();
			 $("#bill_state_other").val('');
			 $("#statebill").hide();
		}else{
			 $("#state_otherbill").hide();
			 $("#statebill").show();
			 $("#billstate").val('');
			 
		}
		//$("#billstate").val($("#ships_" + val).html());
		$("#billcountry").val('');
		$("#bill_state_other").val('');
       

    }
	
    
}

function editcart() {

    if (!$("#editcart").hasClass("meera")) {
		
         $(".carteditbtn").html("Save");
        $("#editcart").slideDown().addClass("meera");
        //$.scrollTo('#editcart',100);
		// $('#paymentreviewinfo').delay(0).fadeOut(1000);
		//$('#paymentinfo').delay(0).fadeIn(6000);
		$("#viewcart").slideUp();
		

    } else {

        $("#editcart").slideUp().removeClass("meera");
		$(".carteditbtn").html("Edit");
		$("#viewcart").slideDown();

    }
}

function add(rowid, price) {
	var sizeid ='';
  if($("#prsizeid_"+rowid).val()){
		sizeid = $("#prsizeid_"+rowid).val();
	}
    var v = parseInt($("#pr_cnt" + rowid).val());
    v += 1;

    var pr = parseFloat(price);


    var n_p = (pr * v).toFixed(2);


    $.post(ajaxurl + '/update_to_cart', {
        cartid: rowid,
        sizeid: sizeid,
		 qty: v,
        act: 'update'
    }, function (data) {
		$('#shppreload').hide();
        if (data.success == '1') {
            
            $(".singletot_" + rowid).html("$" + n_p);
            $("#pr_cnt" + rowid).val(v);
            $("#qty_" + rowid).html("Quantity: " + v);
            var grtot = data.total.toFixed(2);
            $(".pr_price").html("<b>$" + grtot + "</b>");
			if(data.billkey && data.shipkey){
				$('#paymentreviewinfo').delay(0).fadeOut(1000);
		         $('#paymentinfo').delay(0).fadeIn(6000);
			}
            //$("#editcart").slideUp().removeClass("meera");
            //$.scrollTo('#showcart', 1000);

        }

    }, "json");
}

function minus(rowid, price) {
	var sizeid ='';
	 if($("#prsizeid_"+rowid).val()){
		sizeid = $("#prsizeid_"+rowid).val();
	}
    var v = parseInt($("#pr_cnt" + rowid).val());
    v -= 1;
    if (v < 1) {
        alert('The quantity should atleast be one');
        $("#pr_cnt" + rowid).focus();

    } else {

        var pr = parseFloat(price);

        var n_p = (pr * v).toFixed(2);


        $.post(ajaxurl + '/update_to_cart', {
            cartid: rowid,
            qty: v,
			sizeid: sizeid,
            act: 'update'
        }, function (data) {
			$('#shppreload').hide();
            if (data.success == '1') {
                $(".singletot_" + rowid).html("$" + n_p);
                $("#pr_cnt" + rowid).val(v);
                $("#qty_" + rowid).html("Quantity: " + v);
                var grtot = data.total.toFixed(2);
                $(".pr_price").html("<b>$" + grtot + "</b>");
				if(data.billkey && data.shipkey){
				 $('#paymentreviewinfo').delay(0).fadeOut(1000);
		         $('#paymentinfo').delay(0).fadeIn(6000);
			}
                //$("#editcart").slideUp().removeClass("meera");
                //$.scrollTo('#showcart', 1000);

            }

        }, "json");
    }
}
function addsize(rowid, sizeid) {
	
    var v = parseInt($("#pr_cnt" + rowid).val());
    
        $.post(ajaxurl + '/update_to_cart', {
            cartid: rowid,
            qty: v,
			sizeid: sizeid,
            act: 'update'
        }, function (data) {
            if (data.success == '1') {
                $("#sizerow_" + rowid).html("Size: " + data.sizename);
               
                //$("#editcart").slideUp().removeClass("meera");
                //$.scrollTo('#showcart', 1000);

            }

        }, "json");
    
}

function deletecart(rowid) {
if(confirm('Are you sure you want to delete this item?')){
    $.post(ajaxurl + '/update_to_cart', {
        cartid: rowid,
        act: 'delete'
    }, function (data) {
        if (data.success == '1') {
            if (data.cartCount == 0) {
                window.location.href = "estore";

            } else {
                var grtot = data.total.toFixed(2);
                $(".pr_price").html("<b>$" + grtot + "</b>");
                //$("#editcart").slideUp().removeClass("meera");
               // $.scrollTo('#showcart', 1000);
                $("#prods1_" + rowid).remove();
                $("#prods_" + rowid).remove();
            }

        }

    }, "json");
}

}

function paymentrevw() {
    if ($("#payment").valid()) {

        var shpHTML = '<div id="shppreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'paymentinfo';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#paymentinfo").css({'position':'relative'});
		
		if (!$("#paymentinfo #shppreload").length){
			$("#paymentinfo").append(shpHTML);
		}
		
		$("#shppreload").css('left',divMidWidth+'px');
		$("#shppreload").css('top',divMidheight+'px');
		
		$("#shppreload").show();
		$("#payment").fadeTo( "slow", 0.33 );
		
        $.post(ajaxurl + '/paymentinfo', {
            paymentinfo: $("#payment").serializeArray()

        }, function (data) {
			$("#shppreload").hide();
			if(data.shiperror=='1'){
				alert(data.errormsg);
				if ($(".shiprow").length < 1) {
					    $("#shippinginfo").slideDown().addClass("meera");
						$("html, body").animate({
							scrolltop: $("#shippinginfo").height()+106
						}, 1000);
                        //$("#shippinginfo").animate({ scrollTop: $("#shippinginfo")[0].scrollHeight }, 1000);
				}else if($(".shiprow").length > 1){
					$("html, body").animate({
							scrolltop: $("#shippingdata").height()+106
						}, 1000);
					//$("#shippingdata").animate({ scrollTop: $("#shippingdata")[0].scrollHeight }, 1000);
				}
				$("#payment").fadeTo( "slow", 1 );	
			}
			if(data.billerror=='1'){
				alert(data.errormsg);
				
				if ($(".billrow").length < 1) {
					$("#billinginfo").slideDown().addClass("meera");
					$("html, body").animate({
							scrolltop: $("#billinginfo").height()+106
						}, 1000);
					//$("#billinginfo").animate({ scrollTop: $("#billinginfo")[0].scrollHeight }, 1000);
					    
				}else if($(".billrow").length > 1){
					$("html, body").animate({
							scrolltop: $("#billingdata").height()+106
						}, 1000);
					//$("#billingdata").animate({ scrollTop: $("#billingdata")[0].scrollHeight }, 1000);
				}
				 $("#payment").fadeTo( "slow", 1 );	
			}
			
			
			
            if (data.success == '1') {
				$("#payment").fadeTo( "slow", 1 );	

                $('#paymentinfo').hide();

                $("#paymentreviewinfo").delay(0).fadeIn(6000);
                $("#paymentreviewinfo").html(data.paydata);


            }

        }, "json");
    }
}

function changepay() {
    $("#paymentreviewinfo").hide();
    $('#paymentinfo').delay(0).fadeIn(6000);


}

function select_state(ths) {
    //alert(ths.value);
    if (ths.value == '') {
        $("#state_other").hide();
        $("#state").hide();
        return false;
    }

    if (ths.value != "United States of America") {
        $("#shippingtype").hide();
        $("#shippingtype_int").show();
        $("#state_other").show();
        $("#state").hide();
        $("#ship_state_other").val('');

        $("#shipping_method").val("Package");
    } else {
        $("#shippingtype").show();
        $("#shippingtype_int").hide();
        $("#state_other").hide();
        $("#state").show();
        $("#shipping_method").val($("input[name='paymenttype']:checked").val());
    }
}

function select_statebill(ths) {
    //alert(ths.value);
    if (ths.value == '') {
        $("#state_otherbill").hide();
        $("#statebill").hide();
        return false;
    }

    if (ths.value != "United States of America") {

        $("#state_otherbill").show();
        $("#statebill").hide();
        $("#bill_state_other").val('');

    } else {

        $("#state_otherbill").hide();
        $("#statebill").show();

    }
}
function authorize() {
   

        var shpHTML = '<div id="shppreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'paymentreviewinfo';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#paymentreviewinfo").css({'position':'relative'});
		
		if (!$("#paymentreviewinfo #shppreload").length){
			$("#paymentreviewinfo").append(shpHTML);
		}
		
		$("#shppreload").css('left',divMidWidth+'px');
		$("#shppreload").css('top',divMidheight+'px');
		$("#authorize").hide();
		
		$("#shppreload").show();
		$("#paymen").fadeTo( "slow", 0.33 );
		
        $.post(paymenturl + '/authorize', {
           
        }, function (data) {
				
			$("#shppreload").hide();
            if (data.success == '1') {
                
                $('#paymentinfo').hide();

                $("#paymentreviewinfo").delay(0).fadeIn(6000);
                $("#paymentreviewinfo").html(data.paydata);


            }else{
				$("#authorize").show();
			}

        }, "json");
   
}
function viewpackedit(rowid) {

    if (!$("#packslidedit_"+rowid).hasClass("pmks")) {

        $("#packslidedit_"+rowid).slideDown().addClass("pmks");
       

    } else {
        $("#packslidedit_"+rowid).slideUp().removeClass("pmks");


    }

}
function selectshipping() {
   if($('input[name=shippingmethod]:checked', '#shippingmethod').val()){
	   $("#paymentinfo").hide();
		$("#paymentreviewinfo").hide();
		$("#billininfo").hide();
		 var shpHTML = '<div id="shppreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'shipmethoddiv';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#shipmethoddiv").css({'position':'relative'});
		
		if (!$("#shipmethoddiv #shppreload").length){
			$("#shipmethoddiv").append(shpHTML);
		}
		
		$("#shppreload").css('left',divMidWidth+'px');
		$("#shppreload").css('top',divMidheight+'px');
		
		
		$("#shppreload").show();
        $.post(ajaxurl + '/selectshipping', {
          shipp: $("#shippingmethod").serializeArray() 
        }, function (data) {
			$("#shppreload").hide();
            if (data.success == '1') {
				 $("#shipmethoddiv").html(data.shipview);
                $("#meership").html(data.shipmethod);
				$("#cancelshippinginfo").html('<a class="crtitmrmvqt" onclick="cancelshippinginfo(\'' + data.shipkey + '\')">X</a>');
				if(data.billcount > 0){
					$("#billingdata").show();
					$("#billingdata").html(data.billdata);
					$('#paymentinfo').delay(0).fadeIn(6000);
				}
				else if (data.billkey == '') {
                   $("#billininfo").delay(0).fadeIn(6000);
				    $("#sameship").html('<a class="selctshpadrs sameships" onclick="sameasshipping(\'' + data.shipkey + '\')">Same as Shipping Address</a>')
                }
				else{
					 $("#billingdata").delay(0).fadeIn(6000);
					  $("#paymentinfo").delay(0).fadeIn(6000);
				}
                
            }else{
				alert(data.error);
			}

        }, "json");
   }else{
	   alert('Select one shipping method');
   }
   
}
function Changeship() {
       $("#paymentinfo").hide();
		$("#paymentreviewinfo").hide();
		$("#billininfo").hide();
		 var shpHTML = '<div id="shppreload" style="padding:35px;position:absolute;z-index:9999"><span class="prelod"></span></div>';
		var div = 'shipmethoddiv';
		
		var divWidth = $("#"+div).width();
		var divHeight = $("#"+div).height();
		var divMidWidth = ( divWidth / 2 ) - 40;
		var divMidheight = ( divHeight / 2 ) - 40;
		
		
		$("#shipmethoddiv").css({'position':'relative'});
		
		if (!$("#shipmethoddiv #shppreload").length){
			$("#shipmethoddiv").append(shpHTML);
		}
		
		$("#shppreload").css('left',divMidWidth+'px');
		$("#shppreload").css('top',divMidheight+'px');
		
		
		$("#shppreload").show();
		
		
        $.post(ajaxurl + '/changeship', {
         
        }, function (data) {
			$("#shppreload").hide();
            if (data.success == '1') {
				 //$("#shipmethoddiv").delay(0).fadeIn(6000);
                $("#shipmethoddiv").html(data.shipmethod);
                
            }else if(data.error==1){
				alert(data.error);
			}else if(data.shiperror==1){
				$("#shippinginfo").slideDown().addClass("meera");
				$("#cancelshippinginfo").html('');
				$("#paymentinfo").hide();
				$("#paymentreviewinfo").hide();
			}

        }, "json");
   
}