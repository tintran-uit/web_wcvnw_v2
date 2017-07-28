$(document).ready(function(){

  // $("#choose-color-theme .color-list li a").click(function(event){
  //   event.preventDefault();
  //
  //   var value = $(this).data("color");
  //
  //   if(value == "yellow"){
  //     $("link[href*='assets/stylesheets/']").attr('href','../stylesheets/all-yellow.css');
  //   }
  //
  //   else if(value == "grey"){
  //     $("link[href*='assets/stylesheets/']").attr('href','../stylesheets/all-grey.css');
  //   }
  //
  //   else if(value == "cyan"){
  //     $("link[href*='assets/stylesheets/']").attr('href','../stylesheets/all.css');
  //   }
  //
  //   else if(value == "pink"){
  //     $("link[href*='assets/stylesheets/']").attr('href','../stylesheets/all-pink.css');
  //   }
  //
  // })

  //slide box choose color
  $("#choose-color-theme").mouseenter(function(){
    Slide.run(this, {left: 0}, 300);
  });

  $("#choose-color-theme").mouseleave(function(){
    Slide.run(this, {left: -168}, 300);
  });

  $("input[type='number']").stepper();

  $("select").selecter();

  $("input[type=radio], input[type=checkbox]").picker();

  $("#owl-example").owlCarousel({
    pagination: false
  });

  $('[data-toggle="tooltip"]').tooltip();

  //slide box subscribe NL
  $("#nl-box-slider").mouseenter(function(){
    Slide.run(this, {right: 0}, 300);
  });

  $("#nl-box-slider").mouseleave(function(){
    Slide.run(this, {right: -305}, 300);
  });
  //end

  //end

  //slide box chat
  $("#chat .button-show").click(function(event){
    event.preventDefault();

    var btn = $(this).find("i");

    if($(btn).hasClass("glyphicon-plus")){
      $("#chat-title").css("display","none");
      $("#chat .content").css("display","block");
    } else{
      $("#chat .content").css("display","none");
      $("#chat-title").css("display","block");
    }

    $(btn).toggleClass("glyphicon-plus");
    $(btn).toggleClass("glyphicon-minus");

  });
  //end

  // carousel
  $('#main-slideshow, #slideshow-products').carousel({
    interval: 7000
  });
  //end

  // Modal
  $("#modal-abvertising").modal();
  // end

  // Behavior
  $("#select-amount").change(function(){
    var value = $(this).val();
    if(value === "0"){
      $("#input-other-amount").closest("div").fadeIn("fast");
    } else{
      $("#input-other-amount").closest("div").fadeOut("fast");
    }
  })

  $("button[data-button='select']").click(function(){
    $(this).closest(".wrap-address").toggleClass("selected");
  })

  $("button[data-button='remove']").click(function(){
    $(this).closest("article").remove();
  })

  //

})
;
