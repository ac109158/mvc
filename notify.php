<!doctype html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <title>HTML5 Push Notifications using Pusher</title>
    
    <link rel="stylesheet/less" type="text/css" href="notifications/lib/twitter-bootstrap/lib/bootstrap.less">
    <script src="notifications/lib/less/less-1.1.5.min.js"></script>
    
    <link href="notifications/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="notifications/lib/gritter/css/jquery.gritter.css" />
    
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="notifications/lib/gritter/js/jquery.gritter.min.js"></script>
    <script src="http://js.pusher.com/1.12/pusher.min.js"></script>
    <script src="notifications/js/PusherNotifier.js"></script>
    
    <script>
      var NOTIFY_ENDPOINT = "index.php?controller=dashboard&task=notify_endpoint";
      //var NOTIFY_ENDPOINT = '/notify'; // ruby-sinatra
    
      $(function() {
        $("a[href='#notify']").click(function() {
          $.ajax({
            url: NOTIFY_ENDPOINT,
            data: {"message": "I'm a notification!"}
          });
        });
          
        $(".notify button").click(handleNotifyButtonClick);
      });
      
      function handleNotifyButtonClick() {
        var message = $.trim($("#notifyMessage").val());
        if(message) {
          $.ajax({
            url: NOTIFY_ENDPOINT,
            data: {"message": message}
          });
        }
      }
    </script>
  </head>
  <body>

    <div class="container">

      <div class="topbar">
        <div class="fill">
          <div class="container">
            <a class="brand" href="/">HTML5 Push Notifications using Pusher</a>
          </div>
        </div>
      </div>

      <div class="hero-unit">
        <h1>HTML5 Push Notifications</h1>
      </div>
      
      <section class="notify">
        
        <div class="page-header">
          <h1>Notify <small>Trigger a notification</small></h1>
        </div>
        
        <div class="row show-grid">
          <div class="span4 offset1">
            <p>Just enter some text into the <code>textarea</code> and click the 'Notify' <code>button</code> to trigger a notification containing the text you've entered.</p>
          </div>
          <div class="span4 offset1">
            <textarea id="notifyMessage">HTML5 Realtime Push Notification</textarea><br />
            <button class="btn info">Notify</button>
          </div>
        </div>
        
      </section>


      <footer>
        <p></p>
      </footer>

    </div> <!-- /container -->

    <a href="https://github.com/pusher/html5-realtime-push-notifications"><img style="position: absolute; top: 0; right: 0; border: 0;; z-index: 10000" src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png" alt="Group Chat></a>

  </body>
</html>