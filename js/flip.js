<script type="text/javascript">
			$(function(){
				
				$("#flipPad a:not(.revert)").bind("click",function(){
					var $this = $(this);
					$("#flipbox").flip({
						direction: $this.attr("rel"),
						color: $this.attr("rev"),
						content: $this.attr("content"),//(new Date()).getTime(),
						onBefore: function(){$(".revert").show()}
					})
					return false;
				});
				
				$(".revert").bind("click",function(){
					$("#flipbox").revertFlip();
					return false;
				});
				

				setTimeout(changeMailTo,500);
				
			});
</script>