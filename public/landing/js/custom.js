$(document).ready(function() {

"use strict";

// $(".ais-refinement-list__item.ref-all").click(function(){

        
//         $(this).addClass("text-primary");
//         // $(this).next().find(".ais-refinement-list__item").click();
//         // console.log($(this).next().find(".ais-refinement-list__checkbox")[0]);
//         // $(this).next().find(".ais-refinement-list__checkbox").prop('checked', true).trigger();
//         console.log($(this).next().find("label"));
//         $(this).next().find("label").click();

//         // console.log("featured");
//         // $(".ref-all").removeClass("text-primary");
   
// });


// Request form:
$("input[name='data_use']").change(function(){
    if($(this).val() == "personal") {
        $(".orgz-type").hide();
    } else {
        $(".orgz-type").show();
    }
});
//
$("input[name=response_type]").change(function(){
    var via = $(this).val();
    if( via == "via_fax") {
        // required
        $("input#fax").attr("required",true);
        $("input#address").removeAttr("required");
        $("input#email").removeAttr("required");
        // star
        $("input#fax").prev().find("i").html("*");
        $("input#address").prev().find("i").html("");
        $("input#email").prev().find("i").html("");
    } else if ( via == "via_email") {
        // required
        $("input#email").attr("required",true);
        $("input#address").removeAttr("required");
        $("input#fax").removeAttr("required");
        // star
        $("input#email").prev().find("i").html("*");
        $("input#address").prev().find("i").html("");
        $("input#fax").prev().find("i").html("");
    } else {
        // required
        $("input#address").attr("required",true);
        $("input#email").removeAttr("required");
        $("input#fax").removeAttr("required");
        // star
        $("input#address").prev().find("i").html("*");
        $("input#email").prev().find("i").html("");
        $("input#fax").prev().find("i").html("");
    }
});


var filtered = false;

$(document).on("change", ".ais-refinement-list input", function(){
    filtered = !filtered;

    if( !filtered ) {
        // console.log("All");
        $(".ref-all").addClass("text-primary");
        // $(this).change();
    } else {
        $(".ref-all").removeClass("text-primary");
    }

    // console.log(filtered);
});


/* =================================
   LOADER                     
=================================== */
// makes sure the whole site is loaded
$(window).on('load', function() {
    console.log('Page loaded about to fade out the blue screen');
    // will first fade out the loading animation not applicable
    //$(".loader-inner").fadeOut();
    // will fade out the whole DIV that covers the website.
    $(".loader").fadeOut("slow");

});


/* =================================
   NAVBAR COLLAPSE ON SCROLL
=================================== */
$(window).on('scroll', function(){
    var b = $(window).scrollTop();
    if( b > 60 ){
        $(".navbar").addClass("top-nav-collapse");
    } else {
        $(".navbar").removeClass("top-nav-collapse");
    }

    if ( b > 316 && $(".library-filters").length > 0 ) {
        $(".library-filters").addClass("fixed");
        $(".grid-wrapper").css("padding-top", "250px");
    } else {
        $(".library-filters").removeClass("fixed");
        $(".grid-wrapper").css("padding-top", 0);
    }
});

/* ===========================================================
   MAGNIFIC POPUP
============================================================== */
$('.mp-singleimg').magnificPopup({
    type: 'image'
});

$('.mp-gallery').magnificPopup({
    type: 'image',
    gallery:{enabled:true},
});

$('.mp-iframe').magnificPopup({
    type: 'iframe'
});

/* ===========================================================
    WOW ANIMATIONS                   
============================================================== */
new WOW().init();


/* ===========================================================
   HIDE MOBILE MENU AFTER CLICKING 
============================================================== */
$('.navbar-nav>li>a:not(#dLabel)').on('click', function(){
    $('#navbar-collapse').removeClass("in").addClass("collapse"); 
});


/* ===========================================================
   BOOTSTRAP FIX FOR IE10 in Windows 8 and Windows Phone 8  
============================================================== */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style');
    msViewportStyle.appendChild(
        document.createTextNode(
            '@-ms-viewport{width:auto!important}'
            )
        );
    document.querySelector('head').appendChild(msViewportStyle);
}

// Social Share
$("#share").jsSocials({
    shares: [
    {
        share: "email",
        logo: "fas fa-at",
    },
    {
        share: "facebook",
        logo: "fab fa-facebook",
    }, 
    {
        share: "twitter",
        logo: "fab fa-twitter",
    },
    {
        share: "linkedin",
        logo: "fab fa-linkedin",
    },
    {
        share: "whatsapp",
        logo: "fab fa-whatsapp",
    },
    ],
showLabel: false,
showCount: false,
shareIn: "popup",
});
    

}); // End $(document).ready Function
