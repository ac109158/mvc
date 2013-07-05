<!doctype>
<html>
	<head>
		<title>Flip! A jQuery plugin v0.9.9</title>
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<link rel="stylesheet" type="text/css" href="/lab/flip/flip_ie.css"/>
		<![endif]-->		
		<script src="http://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  // Load jQuery
		  google.load("jquery", "1");	
		</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(function(){
				
				$("#flipPad a:not(.revert)").bind("click",function(){
					var $this = $(this);
					$("#flipbox").flip({
						direction: $this.attr("rel"),
						color: $this.attr("rev"),
						content: $this.attr("title"),//(new Date()).getTime(),
						onBefore: function(){$(".revert").show()}
					})
					return false;
				});
				
				$(".revert").bind("click",function(){
					$("#flipbox").revertFlip();
					return false;
				});
				
				var changeMailTo = function(){
					var mArr = ["@","smashup","luca",".it"];
					$("#email").attr("href","mailto:"+mArr[2]+mArr[0]+mArr[1]+mArr[3]);
				}
				
				$(".downloadBtn").click(function(){
					pageTracker._trackPageview('download_flip');
				});	
				
				setTimeout(changeMailTo,500);
				
			});
		</script>					
	</head>
	<body>
	
		<section class="container">
			<header>

			<div class="clearfix">
				<article class="main">
					
					<h3>
						What is Flip?
					</h3>
					<p>
						<strong>Flip</strong> is a <a href="http://www.jquery.com" title="jQuery">jQuery</a> plugin that will flip easily your elements in four directions. Try it
					</p>
					
					<div id="flipbox">Hello! I'm a flip-box! :)</div>
					<div id="flipPad">
						<a href="#" class="left" rel="rl" rev="#39AB3E" title="Change content as <em>you</em> like!">left</a>
						<a href="#" class="top" rel="bt" rev="#B0EB17" title="Ohhh yeah!">top</a>
						<a href="#" class="bottom" rel="tb" rev="#82BD2E" title="Hey oh let's go!">bottom</a>
						<a href="#" class="right" rel="lr" rev="#C8D97E" title="Waiting for css3...">right</a>
						<a href="#" class="revert">revert!</a>
					</div>					

					<div class="usage">
						<h3>How to use?</h3>
						<p>
							Like every jquery plugin, just chain it:
<pre style="font-size:12px;line-height:18px;margin-left:20px;">$("#flipbox").flip({
	direction:'tb'
})</pre>							
						</p>
						<h3>How to change content?</h3>
						<p>
							Add <strong style="font-family:monospace">content</strong> params in this way:
<pre style="font-size:12px;line-height:18px;margin-left:20px;">$("#flipbox").flip({
	direction:'tb',
	<strong>content:</strong>'this is my new content'
})</pre>
						</p>
						<h3>How to add callbacks?</h3>
						<p>
							There are three available callbacks: <strong>onBefore</strong>, <strong>onAnimation</strong>, <strong>onEnd</strong>
<pre style="font-size:12px;line-height:18px;margin-left:20px;">$("#flipbox").flip({
	direction:'tb',
	onBefore: function(){
			console.log('before starting the animation');
	},
	onAnimation: function(){
			console.log('in the middle of the animation');
	},
	onEnd: function(){
			console.log('when the animation has already ended');
	}
})</pre>
						</p>
						<h3>How to revert a flip?</h3>
						<p>
							There's an "hidden" method called <strong>revertFlip</strong>: as it says, revert a flip to the previous state
<pre style="font-size:12px;line-height:18px;margin-left:20px;">$("#flipbox").revertFlip()</pre>
						</p>						
						<h3>All options</h3>
						<p>
							Here are all options available:
							<ul class="options">
								<li><strong>content</strong>define the new content of the flipped box. It works with: html, text or a jQuery object ex:$("selector")</li>
								<li><strong>direction</strong>the direction where to flip. Possible values: 'tb', 'bt', 'lr', 'rl' (default:'tb')</li>
								<li><strong>color</strong>Flip element ending background color</li>
								<li><strong>speed</strong>Speed of the two parts of the animation</li>
								<li><strong>onBefore</strong>Synchronous function excuted before the animation starts</li>
								<li><strong>onAnimation</strong>Synchronous function excuted at half animation</li>
								<li><strong>onEnd</strong>Synchronous function excuted after animation's end</li>
							</ul>
						</p>						
					</div>

				</article>

			</div>
			<footer>
				Hey! oh! Let's go!
			</footer>
		</section>
<!--
		<a class="tweetThis" href="http://twitter.com/home?status=Flip!%20A%20(flipping)%20jQuery%20plugin%20http%3A%2F%2Fbit.ly%2F1mgCX7"><img src="/lab/flip/img/tweet.png"/><span>Tweet this!</span></a>
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-181608-11");
		pageTracker._trackPageview();
		</script>	
-->	
	</body>
</html>