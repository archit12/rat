<html>
<head>
	{{ HTML::script('assets/js/jquery-1.9.0.min.js') }}
	{{--
	{{ HTML::script('assets/js/strollmarket.js') }}
	{{ HTML::script('assets/js/market_final.js') }}
	{{ HTML::script('assets/js/attack.js') }}
	{{ HTML::script('assets/js/market_n.js') }}
	{{ HTML::script('assets/js/shop.js') }}
	{{ HTML::script('assets/js/chat.js') }}
	--}}
	<!-- common_a.css replaced by common.css -->
	{{ HTML::style('assets/css/common.css') }}
	{{ HTML::style('assets/css/market_f.css') }}

	<script>
		$(document).ready(function(){
			$('#board').hide();
			$('#close').on("click", function(){
				$('#board').hide();
			});
			//send broadcast message
			$('#send_broadcast').on("click", function(){
				var broadcast = $('#broadcast_msg').val();
				if (broadcast !== '') {
					$.ajax({
						   'type': 'POST',
						    'url': 'broadcast_save',
						   'data': {'broadcast': broadcast},
						'success': function(data) {
							$('#broadcast_msg').val('');
							$('#send_broadcast').fadeOut("1000");
							window.setTimeout(function() {
								$('#send_broadcast').fadeIn();
							}, 30000);
						},
					});
				}
				else {
					alert("Please enter a valid message");
				}
			});
			//display broadcast messages in broadcast window
			//receive array of JSON objects as data! improvement required
			var last_id = 0;
			window.setInterval(function() {
				$.ajax({
				       'type': 'POST',
				        'url': 'broadcast_get',
				       'data': {'last_id': last_id},
					'success': function(data) {
						data = JSON.parse(data);
						for(x in data) {
							if(data.hasOwnProperty(x)) {
								last_id = data[x].b_id;
								if (data[x].msg !== "") {
									$('#broadcast_displaymsg').append('<p style="margin: 0px; display: inline;"><span class="chat_received">'+data[x].aname+'</span></p> : <span class="broadcast_msg">'+data[x].msg+"</span><br>");
									last_id = data[x].b_id;
								}
							}
							$('#broadcast_displaymsg')[0].scrollTop = $('#broadcast_displaymsg')[0].scrollHeight;
						}
					},
				});
			}, 2000);
		});
	</script>

</head>
<body>
	@include('hud')
	@include('show_avatar')
	<div id="attack_table" style="display:none;"></div>
	<div id="broadcast" >
		<div id="broadcast_displaymsg" style='width: 200px; height: 149; overflow-y: scroll;'></div>
		<table style='margin-left:35px;'>
			<tr>
				<td>
					<input type="text" name="broadcast_msg" id="broadcast_msg"/>
				</td>
				<td>
					{{ HTML::image('assets/images/send.png', 'send', array('id' => 'send_broadcast', 'title' => 'Send Message')) }}
				</td>
			</tr>
		</table>
	</div>
	<div class="panel rightpanel">
		<div id='logot'>
			<a id='logout' href='rat_logout' title='logout'>
				{{ HTML::image('assets/images/icons/logout.png', 'logout', array('class' => 'smoothbig', 'width' => 50, 'height' => 50)) }}
			</a>
		</div>
		<div id='leaderboard'>
        <a id='leader' href='lb2/scrolloffame.html' class='smoothbig' title='Leaderboard' target='_blank'>
          {{ HTML::image('assets/images/icons/leaderboard.png', 'leaderboard', array('class' => 'smoothbig', 'width' => 50, 'height' => 50)) }}
        </a>
      </div>
		<div id='st'>
			<a id='story' href='story'>
				{{ HTML::image('assets/images/icons/story.png', 'story', array('title' => 'story', 'class' => 'smoothbig', 'width' => 50, 'height' => '50')) }}
			</a>
		</div>
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
		<div id='newchat' class="chatarea"></div>
		<input type='text' class="message" name='chattext' id='chattext' placeholder='Enter Message' />
		<input type='button' class="send_message chat_btn" name='chatsend' id='chatsend'  />
		<div id="x" ></div><div id="y" ></div>
	</div>
	<div class="maparea"></div>
	<img class="animateopacity" src="../public/assets/images/logo.png" style="position:fixed;bottom:50px;left:30px;" title="Software Incubator" alt="Reiches" />
</body>
</html>