// =============================================================================
// JS/X-SHORTCODES.JS
// -----------------------------------------------------------------------------
// Custom shortcode scripts for the X Shortcodes plugin.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Custom Shortcode Scripts
// =============================================================================

// Custom Shortcode Scripts
// =============================================================================

jQuery(document).ready(function($) {

  //
  // Parallax effect.
  //

  var windowObj    = $(window);
  var windowHeight = windowObj.height();
  var body         = $('body');
  var thisObj      = $(this);

  windowObj.resize(function () {
    windowHeight = windowObj.height();
  });

  $.fn.parallaxContentBand = function(xAxis, parallaxSpeed) {
    var thisObj = $(this);
    var contentBandFirstTop;

    thisObj.each(function(){
      contentBandFirstTop = thisObj.offset().top;
    });

    windowObj.resize(function(){
      thisObj.each(function(){
        contentBandFirstTop = thisObj.offset().top;
      });
    });

    function windowUpdate(){
      var windowPosition = windowObj.scrollTop();

      thisObj.each(function(){
        var contentBandOffsetTop = thisObj.offset().top;
        var contentBandHeight    = thisObj.outerHeight();

        if (contentBandOffsetTop + contentBandHeight < windowPosition || contentBandOffsetTop > windowPosition + windowHeight) {
          return;
        }

        thisObj.css('background-position', xAxis + ' ' + Math.floor((contentBandFirstTop - windowPosition) * parallaxSpeed) + 'px');
      });
    }

    windowObj.bind('scroll', windowUpdate).resize(windowUpdate);
    windowUpdate();
  };

  if (Modernizr.touch) {
    $('.x-content-band.bg-image.parallax, .x-content-band.bg-pattern.parallax').css('background-attachment', 'scroll');
  } else {
    $('.x-content-band.bg-image.parallax').each(function(){
       var id = $(this).attr('id');
       $('#' + id + ".parallax").parallaxContentBand('50%', 0.1);
    });
    $('.x-content-band.bg-pattern.parallax').each(function(){
       var id = $(this).attr('id');
       $('#' + id + ".parallax").parallaxContentBand('50%', 0.3);
    });
  }


  //
  // Waypoint: fade.
  //

  $('.x-column[data-fade="true"]').each(function() {
    $(this).waypoint(function() {
      if ($(this).attr('data-fade-animation') === 'in-from-top') {
        $(this).animate({
          'opacity' : '1',
          'top'     : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).attr('data-fade-animation') === 'in-from-left') {
        $(this).animate({
          'opacity' : '1',
          'left'    : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).attr('data-fade-animation') === 'in-from-right') {
        $(this).animate({
          'opacity' : '1',
          'right'   : '0'
        }, 750, 'easeOutExpo');
      } else if ($(this).attr('data-fade-animation') === 'in-from-bottom') {
        $(this).animate({
          'opacity' : '1',
          'bottom'  : '0'
        }, 750, 'easeOutExpo');
      } else {
        $(this).animate({ 'opacity' : '1' }, 750, 'easeOutExpo');
      }
    }, { offset: '65%' });
  });


  //
  // Waypoint: recent posts.
  //

  $('.x-recent-posts[data-fade="true"]').each(function() {
    $(this).waypoint(function() {
      $(this).find('a').each(function(i) {
        $(this).delay(i * 90).animate({ 'opacity' : '1' }, 750, 'easeOutExpo');
      });
      setTimeout(function() {
        $(this).addClass('complete');
      }, ($(this).find('a').length * 90) + 400);
    }, { offset: '75%' });
  });


  //
  // Waypoint: skill bar.
  //

  $('.x-skill-bar').each(function(){
    $(this).waypoint(function() {
      var percentage = $(this).attr('data-percentage');
      $(this).find('.bar').animate({ 'width' : percentage }, 750, 'easeInOutExpo');
    }, { offset: '100%' });
  });


  //
  // Ensure accordion collapse class.
  //

  $('.x-accordion-toggle[data-parent]').click(function(){
    $(this).closest('.x-accordion').find('.x-accordion-toggle:not(.collapsed)').addClass('collapsed');
  });

});