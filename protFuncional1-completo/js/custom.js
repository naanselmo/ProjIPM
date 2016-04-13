var heads_rotated = 0;

$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("force-collapse");
    $("#menu-toggle").blur();
});
$("#sidebar-wrapper").hover(function(e) {
    e.preventDefault();
    if (!$("#wrapper").hasClass("force-collapse")){
      //$("#menu").toggleClass("hidden");
      $("#menu-label").toggleClass("hidden");
      $("#wrapper").toggleClass("collapsed");
    }
});
$(".alumni").hover(function(e) {
    e.preventDefault();
    //$(this).find(".alumni-contact").toggleClass("hidden");
});
$(".alumni-image").click(function(e) {
  e.preventDefault();
  $(this).rotate({
    angle: $(this).getRotateAngle(),
    animateTo: Number($(this).getRotateAngle()) + (180 - Number($(this).getRotateAngle())%180)
  });

  // Set the number of rotated heads
  if ($(this).getRotateAngle()%360 === 180){
    heads_rotated -= 1;
  }
  else if ($(this).getRotateAngle()%360 === 0){
    heads_rotated += 1;
  }

  if (heads_rotated === 3){
    var css = 'html {-webkit-filter: invert(100%);' +
    '-moz-filter: invert(100%);' +
    '-o-filter: invert(100%);' +
    '-ms-filter: invert(100%); }';

    var style = document.createElement('style');

    style.type = 'text/css';
    style.id = 'invert';

    if (style.styleSheet)
      style.styleSheet.cssText = css;
    else
      style.appendChild(document.createTextNode(css));

    //injecting the css to the head
    $('head')[0].appendChild(style);
  }
  else if ($('#invert')[0]){
    $('head')[0].removeChild($('#invert')[0]);
  }

});
