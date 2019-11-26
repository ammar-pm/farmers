$(document).ready(function (){

  $(".dropdown").click(function(){
    $(this).toggleClass("show");
    $(this).find(".dropdown-menu").toggleClass("show");
  });

  $(".dataset-actions .btn-group-toggle .btn").click(function(){
    if($(this).hasClass("list-switch")) {
      $(".grid-view").addClass("hidden");
      $(".list-view").removeClass("hidden");
      $(".dataset-actions .filters #sort_option_type, .dataset-actions .filters #sort_option").addClass("hidden");
    } else {
      $(".list-view").addClass("hidden");
      $(".grid-view").removeClass("hidden");
      $(".dataset-actions .filters #sort_option_type, .dataset-actions .filters #sort_option").removeClass("hidden");
    }
  });

});

function fullScreen(elId) {
  /* Get the element you want displayed in fullscreen mode (a video in this example): */
  var elem = document.getElementById(elId);
  console.log(elem); 

  /* When the openFullscreen() function is executed, open the video in fullscreen.
    Note that we must include prefixes for different browsers, as they don't support the requestFullscreen method yet */
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}
