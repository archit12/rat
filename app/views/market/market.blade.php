<html>
<head>
	{{ HTML::script('assets/js/jquery-1.9.0.min.js') }}
	{{ HTML::script('assets/js/arch_broadcast.js') }}
	{{ HTML::script('assets/js/arch_market_users.js') }}
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
		$(window).on('beforeunload', function(){
			return "Your Chat session will expire!";
		});
		$(document).ready(function() {
			// var map_area = $('.maparea'),
			//   chat_area = $('.chatarea'),
			//             chat_last_id = 0,
			//                    sender_id;
			//initialising function
			var init = function () {
				$('#board').hide();
				$('#close').on("click", function(){
					$('#board').hide();
				});
			};
			init();

		// 	var chat_seen = function () {
		// 		$.ajax({
		// 			url: 'market/chat_seen',
		// 			type: 'POST',
		// 			data: {'last_id': chat_last_id, 'sender_id': sender_id}
		// 		})
		// 		.done(function() {
		// 			console.log("success");
		// 		})
		// 		.fail(function() {
		// 			console.log("error");
		// 		})
		// 		.always(function() {
		// 			console.log("complete");
		// 		});
		// 	};
		// 	//display chat messages in chat window from any sender
		// 	var chat_get_all = function () {
		// 		$.ajax({
		// 			url: 'market/chat_getall',
		// 			type: 'POST',
		// 			'data': {'last_id': chat_last_id},
		// 		})
		// 		.done(function(data) {
		// 			data = JSON.parse(data);
		// 			for (x in data) {
		// 				if (data.hasOwnProperty(x)) {
		// 					chat_area.append('<p title="Sender Name"><span class="chat_received">'+ data[x].aname +' : </span>'+ data[x].msg +'</p>');
		// 					chat_last_id = data[x].chat_id;
		// 					sender_id = data[x].send_id;
		// 				}
		// 				if ($('#chatbox').css('display') === "none") {
		// 					clearInterval(chat_all_poll);
		// 					$('#chatbox').css('display', "block");

		// 				}
		// 				$('.chatarea')[0].scrollTop = $('.chatarea')[0].scrollHeight;
		// 			};
		// 			console.log("chat_last "+chat_last_id);
		// 			chat_seen();
		// 		})
		// 		.fail(function() {
		// 			console.log("error");
		// 		})
		// 		.always(function() {
		// 			console.log("complete");
		// 		});
		// 	};
		// 	var chat_all_poll = setInterval(function () {
		// 		chat_get_all();
		// 	}, 2000);

		
		// 	//check if receiver is not busy to open chatbox
		// 	var chat_syn = function (rec_id) {
		// 		$.ajax({
		// 				url: 'market/chat_syn',
		// 				type: 'POST',
		// 				data: {'rec_id': rec_id},
		// 			})
		// 			.done(function (data) {
		// 				if (data) {
		// 					clearInterval(chat_all_poll);
		// 					$('#chatbox').show();
		// 				}
		// 				else {
		// 					alert("Player Busy");
		// 				}
		// 			})
		// 			.fail(function() {
		// 				console.log("error");
		// 			})
		// 			.always(function() {
		// 				console.log("complete");
		// 			});
		// 	};
		// 	//send chat message
		// 	var chat_send = function () {
		// 		var chat_msg = $('#chattext').val();
		// 		$('#chattext').val('');
		// 		$.ajax({
		// 			url: 'market/chat_save',
		// 			type: 'POST',
		// 			data: {'chat_msg': chat_msg},
		// 		})
		// 		.done(function (data) {
		// 			console.log(data);
		// 		})
		// 		.fail(function() {
		// 			console.log("error");
		// 		})
		// 	};
		// 	$('#chatsend').click(function() {
		// 		chat_send();
		// 	});
		// 	var chat_end = function () {
		// 		$.ajax({
		// 			url: 'market/chat_fin',
		// 			type: 'POST'
		// 		})
		// 		.done(function(data) {
		// 			if (data) {
		// 				$('#chatbox').hide();
		// 				chat_all_poll = window.setInterval(chat_get_all(), 2000);
		// 			}
		// 			else {
		// 				alert("Failed to end chat!");
		// 			}
		// 		})
		// 		.fail(function() {
		// 			console.log("Retry");
		// 		});
		// 	};
		// 	$('#chatend').click(function() {
		// 		chat_end();
		// 	});
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