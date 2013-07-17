<link href="pusher/css/chat-style.css" rel="stylesheet">
<script src="http://js.pusher.com/2.1/pusher.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="pusher/js/jquery.pusherchat.js" type="text/javascript"></script>
<style>
    /* demo style */
    body{color: #333;font-family:arial, verdana, sans-serif;}
    small{color:#ccc ; font-size: 14px}
    .account a{ color :#333; background: #eee; border: 1px solid #ccc;padding: 5px; border-radius: 5px;display: inline-block;}
    pre{line-height: 11px;font-size: 11px;background: #fafafa;border: 1px solid #ccc; padding: 10px}
    .hide{font-size: 19px ;color:red ; font-weight: bold;display: none}
    .connexion {font-size: 19px ;color:green ; font-weight: bold;}
</style>

        <!--
<h2>To start the demo , first connect as..  <small>click on link to connect & open at least 2 account in different window</small> :</h2>
        <div class="connexion"></div>
        <div class="account">
            <a href="?user_id=133&name=Elvis"  id="user_133">Elvis</a>
            <a href="?user_id=244&name=Kurt%20Cobain" id="user_244">Kurt Cobain</a>
            <a href="?user_id=3&name=Hendrix" id="user_3">Hendrix</a>
            <a href="?user_id=666&name=Satan" id="user_666">Satan</a>
            <a href="?user_id=999&name=God" id="user_999">God</a>
            <a href="?user_id=111&name=Jesus" id="user_111">Jesus</a>
            <a href="?user_id=1&name=Homer%20Simpson" id="user_1">Homer Simpson</a>
            <a href="?user_id=2&name=Roger" id="user_2">Roger</a>
            <a href="?user_id=4&name=Snoopy" id="user_4">Snoopy</a>
            <div class="hide">
                Please wait until one of testers leaves the demo , or download the plugin & try it on your own host , thx
            </div>
        </div>
        <hr/>
-->

        <!--***************************************************** pusher chat html *******************************************************-->
        <div id="pusherChat">
            <div id="membersContent">                
                <span id="expand"><span class="close">&#x25BC;</span><span class="open">&#x25B2;</span></span>
                <h2><span id="count">0</span> online</h2>
                <div class="scroll">
                    <div id="members-list"></div>
                </div>
            </div>

            <!-- chat box template -->
            <div id="templateChatBox">
                <div class="pusherChatBox">
                    <span class="state">
                        <span class="pencil">
                            <img src="pusher/assets/pencil.gif" />
                        </span>
                        <span class="quote">
                            <img src="pusher/assets/quote.gif" />
                        </span>
                    </span>
                    <span class="expand"><span class="close">&#x25BC;</span><span class="open">&#x25B2;</span></span>
                    <span class="closeBox">x</span>
                    <h2><a href="#" title="go to profile"><img src="" class="imgFriend" /></a> <span class="userName"></span></h2>
                    <div class="slider">
                        <div class="logMsg">
                            <div class="msgTxt">
                            </div>
                        </div>
                        <form method="post" name="#123">
                            <textarea  name="msg" rows="3" ></textarea>
                            <input type="hidden" name="from" class="from" />
                            <input type="hidden" name="to"  class="to"/>
                            <input type="hidden" name="typing"  class="typing" value="false"/>
                        </form>
                    </div>
                </div>
            </div>
            <!-- chat box template end -->

            <div class="chatBoxWrap">
                <div class="chatBoxslide"></div>
                <span id="slideLeft"> <img src="pusher/assets/quote.gif" />&#x25C0;</span> 
                <span id="slideRight">&#x25B6; <img src="pusher/assets/quote.gif" /></span>
            </div>
        </div>
        <!--***************************************************** end pusher chat html *******************************************************-->
        
        
        

        <script type="text/javascript">
            /*
             * this part is only for demo you don't need this
             */
           /*
 function getUrlVars() {
                var vars = {};
                var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                    vars[key] = value;
                });
                return vars;
            }
*/

            var id = "<?php echo $_SESSION['user_id']; ?>";
            //var id = getUrlVars()['user_id'];
            var name = "<?php echo $_SESSION['name_of_user']; ?>";
            //var name = getUrlVars()['name'];

            if (id=="undefined") {
                id=""; 
            } else $('#user_'+id).hide();
            if (name=="undefined") name="";
            if (!id) $('#pusherChat').remove();
            if (name)
                $('.connexion').html('You are connected as '+name.replace('%20',' '));
            /*
             * this part is only for demo you don't need this
             */
        </script>

        <script>
            $.fn.pusherChat({
                'pusherKey':'71d3c4ea25f712272ad3',
                //'authPath':'?controller=pusher$task=auth&user_id='+id+'&name='+name,
                'authPath':'pusher/server/pusher_auth.php?user_id='+id+'&name='+name,
                'friendsList' : 'pusher/ajax/friends-list.json',
                'serverPath' : 'pusher/server/server.php',
                'profilePage':true,
                'onFriendConnect': function(member){
                    if (member.id) $('#user_'+member.id).hide();  
                    if (!$('.account a:visible').html()) $('.hide').show();
                },
                'onFriendLogOut': function(member){
                    if (member.id) $('#user_'+member.id).show();  
                    if ($('.account a:visible').html()) $('.hide').hide();
                },
                'onSubscription':function(members){
                    if ($('.account a:visible').html()) $('.hide').hide();
                    $.each(members._members_map, function(val){
                        $('#user_'+val).hide();
                    });            
                }
            });
        </script>

