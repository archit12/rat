<html>
<head>
	{{ HTML::script('assets/js/jquery-1.9.0.min.js') }}
	{{ HTML::script('assets/js/strollmarket.js') }}
	{{ HTML::script('assets/js/market_final.js') }}
	{{ HTML::script('assets/js/attack.js') }}
	{{ HTML::script('assets/js/market_n.js') }}
	{{ HTML::script('assets/js/shop.js') }}
	{{ HTML::script('assets/js/chat.js') }}
	<!-- common_a.css replaced by common.css -->
	{{ HTML::style('assets/css/common.css') }}
	{{ HTML::style('assets/css/market_f.css') }}
	
	<script>
		$(document).ready(function(){
			$('#board').hide();
			$('#leader').on("click", function(){
				//$('#board').show();
			});
			$('#close').on("click", function(){
				$('#board').hide();
			});
			$('#logout').on("click", function(){
				$.ajax({
					url: "logout.php",
					type : 'get',
					data : "logout=2",
				}).done(function(data){
					$(location).attr('href','index.php');
				});
			});
		});
	</script>
</head>
<body>
	@include('hud')
	@include('show_avatar')
	<div id="attack_table" style="display:none;">
		
	</div>
	<div id="broadcast" >
		<div id="broadcast_displaymsg" style='width: 200px;
		height: 149;
		overflow-y: scroll;'>
	</div>
	<table style='margin-left:35px;'>
		<tr>
			<td>
				<input type="text" name="broadcast_msg" id="broadcast_msg"/>
			</td>
			<td>
				<span id="broadcast_button"><img src='../public/assets/images/send.png' alt="send button" title='Send Message' /></span>
			</td>
		</tr>
	</table>
</div>
<div class="panel rightpanel">
	<div id='logot'><a id='logout' href='#' title='logout'><img src='../public/assets/images/icons/logout.png' title='Logout' alt="logout button" class='smoothbig' width='50' heigth='50'/></a></div>
	<div id='leaderboard'><a id='leader' href='lb2/scrolloffame.html' class='smoothbig' title='Leaderboard' target='_blank'><img src='../public/assets/images/icons/leaderboard.png' title='Leaderboard' alt="leaderboard button" class='smoothbig' width='50' heigth='50'/></a></div>
	<div id='st'><a id='story' href='game.php'><img src='../public/assets/images/icons/story.png' alt="show story" title='story' width='50' heigth='50' class='smoothbig'/></a></div>					


</div>
<div >
	<a id='shop' href="#"><img src='../public/assets/images/market_hover.png' title='Market' alt="Market"></a>
</div>
<div id='chatbox' style="display:none"class="panel chatbox">
	To <span id='to' class="chat_with panel"></span>
	<table class='attack_xchange'>
		<tr>
			<td>
				<input type='button'  class="chat_attack chat_btn"  name='attack' id='attack'  />
			</td>
			<td>
				<input type='button' class="chat_exchange chat_btn" name='xchange' id='xchange'  />
			</td>
			<td>
				<input type='button' class="close_message chat_btn" name='chatend' id='chatend'  />
			</td>
		</tr>
	</table>
	<div id='newchat' class="chatarea">

	</div>
	<input type='text' class="message" name='chattext' id='chattext' placeholder='Enter Message' />
	<input type='button' class="send_message chat_btn" name='chatsend' id='chatsend'  />

	<div id="x" ></div><div id="y" ></div>
</div>

<div class="maparea">

</div>

<img class="animateopacity" src="../public/assets/images/logo.png" style="position:fixed;bottom:50px;left:30px;" title="Software Incubator" alt="Reiches" />
</body>


</html>