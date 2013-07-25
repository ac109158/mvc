
<style>
    /* demo style */
    body{color: #333;font-family:arial, verdana, sans-serif;}
    small{color:#ccc ; font-size: 14px}
    .account a{ color :#333; background: #eee; border: 1px solid #ccc;padding: 5px; border-radius: 5px;display: inline-block;}
    pre{line-height: 11px;font-size: 11px;background: #fafafa;border: 1px solid #ccc; padding: 10px}
    .hide{font-size: 19px ;color:red ; font-weight: bold;display: none}
    .connexion {font-size: 19px ;color:green ; font-weight: bold;}
</style>

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
                    <img src="images/assets/pencil.gif" />
                </span>
                <span class="quote">
                    <img src="images/assets/quote.gif" />
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
        <span id="slideLeft"> <img src="images/assets/quote.gif" />&#x25C0;</span> 
        <span id="slideRight">&#x25B6; <img src="images/assets/quote.gif" /></span>
    </div>
</div>
<!--***************************************************** end pusher chat html *******************************************************-->
        
        
        


