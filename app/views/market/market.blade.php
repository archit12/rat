<html>
	<head>
		<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
		<script type="text/javascript" src="js/strollmarket.js"></script>
		<script type="text/javascript" src="js/market_final.js" ></script>
		<script type="text/javascript" src="js/attack.js" ></script>
		<script type="text/javascript" src="js/market_n.js" ></script>
		<script type="text/javascript" src="js/shop.js" ></script>
		<script type="text/javascript" src="js/chat.js" ></script>
		<link rel="stylesheet" href="css/common_a.css" type="text/css"/>
		<link rel="stylesheet" href="css/market_f.css" type="text/css"/>
		<script>
		$(document).ready(function(){
			$('#board').hide();
		$('#leader').live('click',function(){

			//$('#board').show();
		});
		$('#close').live('click',function(){

			$('#board').hide();
		});
		$('#logout').live('click',function(){
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
	@include(hud)
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
					<span id="broadcast_button"><img src='img/send.png' /></span>
				</td>
			</tr>
		</table>
		</div>
		<div class="panel rightpanel">
			<div id='logot'><a id='logout' href='#' title='logout'><img src='img/icons/logout.png' class='smoothbig' width='50' heigth='50'/></a></div>
				<div id='leaderboard'><a id='leader' href='lb2/scrolloffame.html' class='smoothbig' title='Leaderboard' target='_blank'><img src='img/icons/leaderboard.png' class='smoothbig' width='50' heigth='50'/></a></div>
				<div id='st'><a id='story' href='game.php'><img src='img/icons/story.png' title='story' width='50' heigth='50' class='smoothbig'/></a></div>					
				
		
		</div>
		<div >
			<a id='shop' href="#"><img src='img/market_hover.png' ></a>
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
		
		<img class="animateopacity" src="img/logo.png" style="position:fixed;bottom:50px;left:30px;" title="copyright - Software Incubator 2013"/>
	</body>
		
		
</html>