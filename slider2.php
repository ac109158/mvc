<!-- jQuery (required) -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

<!-- Optional plugins -->
<script src="js/slider/jquery.easing.1.2.js"></script>
<script src="js/slider/swfobject.js"></script>

<!-- Anything Slider -->
<!-- <link rel="stylesheet" href="css/slider/anythingslider.css"> -->
<script src="js/slider/jquery.anythingslider.js"></script>

<!-- Add the stylesheet(s) you are going to use here. All stylesheets are included below, remove the ones you don't use. -->
<link rel="stylesheet" href="css/slider/theme-metallic.css">
<link rel="stylesheet" href="css/slider/theme-minimalist-round.css">
<link rel="stylesheet" href="css/slider/theme-minimalist-square.css">
<link rel="stylesheet" href="css/slider/theme-construction.css">
<link rel="stylesheet" href="css/slider/theme-cs-portfolio.css">

<!-- AnythingSlider optional extensions -->
<script src="js/slider/jquery.anythingslider.fx.js"></script>
<script src="js/slider/jquery.anythingslider.video.js"></script>

<!-- Required -->
<script>
$(function(){
 $('#slider')
   .anythingSlider() // add any non-default options here
   .anythingSliderVideo(); // only add this if your slider includes supported videos (new v1.9)
});
</script>


 <ul id="slider">
  <li class="panel2"><object width="940" height="529"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=12280336&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00adef&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=12280336&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=00adef&amp;fullscreen=1&amp;autoplay=0&amp;loop=0" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="940" height="529"></embed></object></li>
  <li><img src="images/001.png" /></li>
  <li class="panel4"><object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/zSgiXGELjbc&amp;hl=en_US&amp;fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/zSgiXGELjbc&amp;hl=en_US&amp;fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object></li>
  <li>
   <div class="list">
    <h4>Title</h4>
    <ul>
     <li>List item #1</li>
     <li>List item #2</li>
    </ul>
   </div>
  </li>
 </ul>

<script>
$('#slider')
  .anythingSlider({
    // Appearance
    theme               : "metallic", // Theme name
    mode                : "vertical",   // Set mode to "horizontal", "vertical" or "fade" (only first letter needed); replaces vertical option
    expand              : true,     // If true, the entire slider will expand to fit the parent element
    resizeContents      : true,      // If true, solitary images/objects in the panel will expand to fit the viewport
    showMultiple        : false,     // Set this value to a number and it will show that many slides at once
    easing              : "swing",   // Anything other than "linear" or "swing" requires the easing plugin or jQuery UI

    buildArrows         : true,      // If true, builds the forwards and backwards buttons
    buildNavigation     : false,      // If true, builds a list of anchor links to link to each panel
    buildStartStop      : false,      // If true, builds the start/stop button and adds slideshow functionality

    appendForwardTo     : null,      // Append forward arrow to a HTML element (jQuery Object, selector or HTMLNode), if not null
    appendBackTo        : null,      // Append back arrow to a HTML element (jQuery Object, selector or HTMLNode), if not null
    appendControlsTo    : null,      // Append controls (navigation + start-stop) to a HTML element (jQuery Object, selector or HTMLNode), if not null
    appendNavigationTo  : null,      // Append navigation buttons to a HTML element (jQuery Object, selector or HTMLNode), if not null
    appendStartStopTo   : null,      // Append start-stop button to a HTML element (jQuery Object, selector or HTMLNode), if not null

    toggleArrows        : true,     // If true, side navigation arrows will slide out on hovering & hide @ other times
    toggleControls      : false,     // if true, slide in controls (navigation + play/stop button) on hover and slide change, hide @ other times

    startText           : "Start",   // Start button text
    stopText            : "Stop",    // Stop button text
    forwardText         : "&raquo;", // Link text used to move the slider forward (hidden by CSS, replaced with arrow image)
    backText            : "&laquo;", // Link text used to move the slider back (hidden by CSS, replace with arrow image)
    tooltipClass        : "tooltip", // Class added to navigation & start/stop button (text copied to title if it is hidden by a negative text indent)

    // Function
    enableArrows        : true,      // if false, arrows will be visible, but not clickable.
    enableNavigation    : true,      // if false, navigation links will still be visible, but not clickable.
    enableStartStop     : true,      // if false, the play/stop button will still be visible, but not clickable. Previously "enablePlay"
    enableKeyboard      : true,      // if false, keyboard arrow keys will not work for this slider.

    // Navigation
    startPanel          : 1,         // This sets the initial panel
    changeBy            : 1,         // Amount to go forward or back when changing panels.
    hashTags            : true,      // Should links change the hashtag in the URL?
    infiniteSlides      : true,      // if false, the slider will not wrap & not clone any panels
    navigationFormatter : null,      // Details at the top of the file on this use (advanced use)
    navigationSize      : false,     // Set this to the maximum number of visible navigation tabs; false to disable

    // Slideshow options
    autoPlay            : false,     // If true, the slideshow will start running; replaces "startStopped" option
    autoPlayLocked      : false,     // If true, user changing slides will not stop the slideshow
    autoPlayDelayed     : false,     // If true, starting a slideshow will delay advancing slides; if false, the slider will immediately advance to the next slide when slideshow starts
    pauseOnHover        : true,      // If true & the slideshow is active, the slideshow will pause on hover
    stopAtEnd           : false,     // If true & the slideshow is active, the slideshow will stop on the last page. This also stops the rewind effect when infiniteSlides is false.
    playRtl             : false,     // If true, the slideshow will move right-to-left

    // Times
    delay               : 3000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds)
    resumeDelay         : 15000,     // Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds).
    animationTime       : 600,       // How long the slideshow transition takes (in milliseconds)
    delayBeforeAnimate  : 0,         // How long to pause slide animation before going to the desired slide (used if you want your "out" FX to show).

    // Callbacks
    onBeforeInitialize  : function(e, slider) {}, // Callback before the plugin initializes
    onInitialized       : function(e, slider) {}, // Callback when the plugin finished initializing
    onShowStart         : function(e, slider) {}, // Callback on slideshow start
    onShowStop          : function(e, slider) {}, // Callback after slideshow stops
    onShowPause         : function(e, slider) {}, // Callback when slideshow pauses
    onShowUnpause       : function(e, slider) {}, // Callback when slideshow unpauses - may not trigger properly if user clicks on any controls
    onSlideInit         : function(e, slider) {}, // Callback when slide initiates, before control animation
    onSlideBegin        : function(e, slider) {}, // Callback before slide animates
    onSlideComplete     : function(slider) {},    // Callback when slide completes; this is the only callback without an event "e" variable

    // Interactivity
    clickForwardArrow   : "click",         // Event used to activate forward arrow functionality (e.g. add jQuery mobile's "swiperight")
    clickBackArrow      : "click",         // Event used to activate back arrow functionality (e.g. add jQuery mobile's "swipeleft")
    clickControls       : "click focusin", // Events used to activate navigation control functionality
    clickSlideshow      : "click",         // Event used to activate slideshow play/stop button
    allowRapidChange    : false,           // If true, allow rapid changing of the active pane, instead of ignoring activity during animation

    // Video
    resumeOnVideoEnd    : true,      // If true & the slideshow is active & a supported video is playing, it will pause the autoplay until the video is complete
    resumeOnVisible     : true,      // If true the video will resume playing (if previously paused, except for YouTube iframe - known issue); if false, the video remains paused.
    isVideoPlaying      : function(base){ return false; } // return true if video is playing or false if not - used by video extension

    // deprecated - use the video extension `wmode` option now
    // addWmodeToObject : "opaque",  // If your slider has an embedded object, the script will automatically add a wmode parameter with this setting
  })
  // initialize the video extension, as desired (new v1.9)
  .anythingSliderVideo({
    // video id prefix; suffix from $.fn.anythingSliderVideo.videoIndex
    videoId         : 'asvideo',
    // this option replaces the `addWmodeToObject` option in the main plugin
    wmode           : "opaque",
    // auto load YouTube api script
    youtubeAutoLoad : true,
    // YouTube iframe parameters, for a full list see:
    // https://developers.google.com/youtube/player_parameters#Parameters
    youtubeParams   : {
      modestbranding : 1,
      iv_load_policy : 3,
      fs : 1,
      wmode: 'opaque' // this is set by the wmode option above, so no need to include it here
    }
  });
  </script>
