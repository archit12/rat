<html>
<head>
	<title>Reiches | Elders Scroll</title>
	 <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
	<script type="text/javascript">
		var index = 1;
		$(document).ready(function(){
			$('.divv').each(function(){
				$(this).hide();
			});
			$('#div0').show();
			$('.tab').click(function(){
				$('.tab').each(function(){
					$(this).removeClass("selected");
				});
				$(this).addClass("selected");
				$('.divv').each(function(){
					$(this).hide();
				});
				$('#div'+$(this).attr("id")).slideDown(200);
			});
		});
	</script>
	<style>
	.smoothbig
{
	-webkit-transition: all 200ms ease-in-out;
-moz-transition: all 200ms ease-in-out;
-ms-transition: all 200ms ease-in-out;
-o-transition: all 200ms ease-in-out;
transition: all 200ms ease-in-out;
	
}
.smoothbig:hover
{
-moz-transform: scale(1.2) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-webkit-transform: scale(1.2) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-o-transform: scale(1.2) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
-ms-transform: scale(1.2) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg);
transform: scale(1.2) rotate(0deg) translateX(0px) translateY(0px) skewX(0deg) skewY(0deg); 	
}
		body{
			background-image:url('{{URL::to("assets/images/storybg.jpg")}}');
			background-repeat: no-repeat;
			background-size: 100%;
			overflow: hidden;
			color:white;
		}
		h5{
			padding:0px;
			padding-bottom:5px;
			margin:0px;
		}
		.desc{
			text-align:left;
			padding:0px;
			margin:3px 0px;
			font-size:0.9em;
			clear:both;
			
		}
		.help{
			float:left;
			margin-right:10px;
		}
		#box{
			/*background-image: url(blackgrad.png);*/
			background-size: 1090px;
			width: 710px;
			height: 630px;
			position: absolute;
			top: 30px;
			right: 50px;
			padding: 10px;
			padding-left: 5px;
			color: #eee;
			font-size: 1.2em;
			overflow-y: auto;
			overflow-x:hidden;
			background: -moz-linear-gradient(top,  rgba(0,0,0,0.74) 12%, rgba(0,0,0,0.42) 50%, rgba(0,0,0,0) 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(12%,rgba(0,0,0,0.74)), color-stop(50%,rgba(0,0,0,0.42)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  rgba(0,0,0,0.74) 12%,rgba(0,0,0,0.42) 50%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  rgba(0,0,0,0.74) 12%,rgba(0,0,0,0.42) 50%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  rgba(0,0,0,0.74) 12%,rgba(0,0,0,0.42) 50%,rgba(0,0,0,0) 100%); /* IE10+ */
			background: linear-gradient(to bottom,  rgba(0,0,0,0.74) 12%,rgba(0,0,0,0.42) 50%,rgba(0,0,0,0) 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#bd000000', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */

			-webkit-border-radius: 30px 0px 0px 30px;
    		border-radius: 30px 0px 0px 30px;

    		-webkit-box-shadow:  5px 5px 10px 10px rgba(12, 31, 14, 0.5);
        	box-shadow:  5px 5px 10px 10px rgba(12, 31, 14, 0.5);

        	text-shadow: 1px 2px 2px #121012;
			filter: dropshadow(color=#121012, offx=2, offy=3);

        	font-family: helvetica;
		}
					*::-webkit-scrollbar {
				width: 12px;
			}

			*::-webkit-scrollbar-track {
				-webkit-box-shadow: inset 0 0 6px rgba(255,255,255,0.4);
				border-radius: 10px;
			}

			*::-webkit-scrollbar-thumb {
				border-radius: 10px;
				-webkit-box-shadow: inset 0 0 6px rgba(255,255,255,0.8);
			}
		.divv
		{
			margin: auto;
			text-align: justify;
			position: relative;
			width:520px;
			margin-top:50px;
		}
		.divv h3{
			text-align: center;
			text-shadow: 2px 3px 3px #121012;
        filter: dropshadow(color=#121012, offx=2, offy=3);
		}
		#next_div{
			display: inline;
			position: relative;
			top: 60px;
			left: 480px;
			height: 50px;
			width: 200px;
		}
		.tab{
			padding:5px 8px;
			float:left;
			background:rgba(12,31,25,0.5);
			margin-right:10px;
			cursor:pointer;
			-webkit-border-radius: 5px;
			border-radius: 5px;
			-webkit-transition: all 200ms ease-in-out;
			-moz-transition: all 200ms ease-in-out;
			-ms-transition: all 200ms ease-in-out;
			-o-transition: all 200ms ease-in-out;
			transition: all 200ms ease-in-out;
			margin-bottom:10px;
		}
		.tab:hover{
			background:rgba(42,21,20,1);
		}
		#clear{
			clear:both;
		}
		#menu{
			position:relative;
			top:30px;
			left: 30px;
		}
		.selected{
			background:rgba(42,21,20,1);
		}
		
		#logo{
			position:relative;
			top:570px;
			height:80px;
			width:280px;
		}
		#logo img{
			height:80px;
			width:280px;
		}
		#game
		{
			position: absolute;
			top: 220px;
			left:110px;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<a id="game" href="map">
		{{HTML::image('assets/images/gotogame.png', 'play', array('height' => '280px', 'class' => 'smoothbig'))}}
	</a>
	
	<div id="box">
		<div id="menu">
			<div class="tab" id="1">Map</div>
			<div class="tab" id="2">Home</div>
			<div class="tab" id="3">Attainment Hall</div>
			<div class="tab" id="4">Market</div>
			<div class="tab" id="5">Farm</div>
			<div class="tab" id="6">Smelting</div>
			<div class="tab" id="7">Smelter</div>
			<div class="tab" id="8">Forge</div>
			<div class="tab" id="9">Alchemy</div>
			<div class="tab" id="10">Skills</div>
			<div class="tab" id="11">Traits</div>
			<div class="tab" id="12">Chat</div>
			<div class="tab" id="13">Result</div>
			<div class="tab" id="14">Gameplay Tips</div>
			<div id="clear"></div>
			
		</div>
		<div class="divv" id="div0">
			<h3>Welcome to Reiches Evolution.</h3>
			This guide will explain to you the basic structure of the game and it's components in brief.
			We advice that you read this guide before you start playing, for a better experience.
			
			Reiches starts with assigning you with a username and an avatar that will be used throughout the game.
			After entering these basic details, you will then be taken to the central map in the game.
			Click Next to Continue.
		</div>
		
		<div class="divv" id="div1">
			<h3><b>Map</b></h3>
			The Map is the starting point of your journey and serves as the hub from where you can reach all the locations
			in the game. There are 3 locations present on the map viz. The Attainment Hall, Market and Home. You can travel to any of these
			locations by clicking on them.
		<div class="info">
		{{HTML::image('assets/images/story/map.png', 'map', array('style' => 'width: 523px;height: 280px;','class'=>'info_img'))}}
		</div>		
		</div>
		
		<div class="divv" id="div2">
			<h3><b>Home</b></h3>
				The home is the place from where you can reach your house, farm and Smelter workshop.
				You can travel to the desired location just by clicking on it's image.
				You can also rest here when depleted of energy.
				The chest is a safe locker where you can store your treasured posesions safely.
				Alchemy Shop is the place where you can craft potions that can have powerful effects specially when used in combinations.
				<div class="info">
				{{HTML::image('assets/images/story/home.png', 'Home', array('style' => 'width: 329px;height: 250px;position: absolute;left: 20%;','class'=>'info_img'))}}
				</div>
		</div>
		
		<div class="divv" id="div3">
			<h3><b>Attainment Hall</b></h3>
				Here you can learn various kinds of skills that will decide the role you go on to play in the game. 
				Skills can be learnt in exchange for some money or stamina.
				After learning these skills, you will be able to produce your own assets and can trade your invention in the market						
				<div class="info">{{HTML::image('assets/images/story/hall.png', 'Hall', array('style' => 'position: absolute;left: 9%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div4">
			<h3><b>Market</b></h3>
				Market is the trade centre in the game. Here you can purchase goods from shopkeepers as well as other players.
				You can also exchange and borrow goods as well as bargain for their price. It must be noted that the market,
				being a warehouse of costly assets and centre for trade, is not completely safe.
				It is advised that when visiting here you lock away your treasured assets safely,
				in the chest at your home and carry only those that are required.
				You can also attack unsuspecting players and loot them of their assets.
				
			<div class="info">{{HTML::image('assets/images/story/market.png', 'Market', array('style' => 'position: absolute;width: 82%;height: 77%;left: 12%;top: 106%;','class'=>'info_img'))}}</div>	
		</div>
		
		<div class="divv" id="div5">
			<h3><b>Farm</b></h3>
				Here you can plant crops and vegetables after achieving the required farming skills. 
				The products grown can be used to regain health or to trade with others.

				<div class="info">{{HTML::image('assets/images/story/farm.png', 'Farm', array('style' => 'position: absolute;left: 24%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div6">
			<h3><b>Smelting</b></h3>
				In this shop you can craft weapons and other implements from raw materials.
				It comprises of a smelter and a Forge that can be are used for the same.
				Clicking on the image will lead, to the right shop.

				<div class="info">{{HTML::image('assets/images/story/smelting.png', 'Smelting', array('style' => 'height: 308px;position: absolute;left: 22%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div7">
			<h3><b>Smelter</b></h3>
				In this shop you can convert raw metal ores to metal ingots.
				These ores are then used to create weapons and other finished products.				
			<div class="info">{{HTML::image('assets/images/story/smelter.png', 'Smelter', array('style' => 'position: absolute;left: 27%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div8">
			<h3><b>Forge</b></h3>
				In this shop you can convert metal ingots and other materials to finished products.
				Use this shop to craft weapons and other implements like shields etc.

				<div class="info">{{HTML::image('assets/images/story/forge.png', 'Forge', array('style' => 'height: 340px;position: absolute;left: 21%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div9">
			<h3><b>Alchemy</b></h3>
				Here you can craft potions using ingredients that can be collected or crafted.
				These potions can be consumed for various advantageous effects on the user. 
				The potions can also be traded to others.				
				<div class="info">{{HTML::image('assets/images/story/alchemy.png', 'Alchemy', array('style' => 'position: absolute;left: 25%;','class'=>'info_img'))}}</div>
		</div>
		
		<div class="divv" id="div10">
			<h3><b>Skills</h3></b>
				<ul>
				<li><b>Wisdom</b>
				<ul>
				<li>Wisdom will increase your Respect enable you to learn skills of higher levels.</li>
				</ul>
				</li>
				<li><b>Farming</b>
				<ul>
				<li>You will learn to produce vegetables and other edible products to sell or consume.</li>
				</ul>
				</li>
				<li><b>Alchemy</b>
				<ul>
				<li>It will help you make potions for yourself which will increase your strength, stamina and other ratings.</li>
				</ul>
				</li>
				<li><b>Smelting</b>
				<ul>
				<li>It will help you to convert raw material into refined and usable products like ingots, weapons etc.</li>
				</ul>
				</li>
				<li><b>Warcraft</b>
				<ul>
				<li>It will help you gain respect and resistance, hence improving your chance to win in fights.</li>
				</ul>
				</li>
				</ul>

		</div>
		
		<div class="divv" id="div11">
			<h3><b>Traits</b></h3>
				<ul>
				<li>
				<b>Stamina</b><br/>
				Stamina will be your energy level. Every act that you perform like farming, fighting etc. will require stamina.
				Resting at your home will restore it back.
				</li>
				<br/>
				<li>
				<b>Money</b><br/>
				The currency used in Reiches Evolution is called Stark and it is the basic unit in which transactions will be conducted involving money.
				</li>
				<br/>
				<li>
				<b>Strength</b><br/>
				Strength is useful in fights as it increases the chance of winning in fights.
				</li>
				<br/>
				<li>
				<b>Resistance</b><br/>
				Resistance is the property that provides protection against attacks by others.
				</li>
				<br/>
				<li>
				<b>Respect</b><br/>
				Respect is an attribute that specifies your status in the society and depends on your actions and their consequences.
				</li>
				<br/>
				<li>
				<b>Health</b><br/>
				Health is an attribute that defines your fitness. It can be lost in fights etc and can be restored by eating, sleeping etc.
				</li>
				</ul>
		</div>
		
		<div class="divv" id="div12">
			<h3><b>Chat</b></h3>
				Chat allows you to communicate with other players when you're in the market. You can also send, recieve goods and money from other players using chat.
				Attacking a player is also available through this portal.<br/><br/>
				Broadcast is a shoutbox where you can broadcast messages that will be visible to all players in the game.				
				<div class="info">{{HTML::image('assets/images/story/chat.png', 'Chat', array('style' => 'height: 250px;position: absolute;left: 30%;','class'=>'info_img'))}}</div>
		</div>
		<div class="divv" id="div13">
			<h3><b>Result</b></h3>
				The final result will be calculated at the end of the game.
				It would take into account all the parameters like Respect, Money, Skill Levels, total assets etc and then generate a final score.<br/><br/>
				*There would be only one final winner in the end.
		</div>
		<div class="divv" id="div14">
			<h3><b>Gameplay Tips</b></h3>
				<center>
					<h5><i>-' What you do is what defines you! '-</i></h5>
					<hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Invest on skills</span>
					{{HTML::image('assets/images/gameplay/school.jpg', 'School', array('class'=>'help'))}}
					<p class="desc">	
						Start with a basic skill like 'Farming' to increase your economy.<br/>
						When the money starts flowing you can aim for Master skills like 'Alchemy'.
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Low on money?</span>
					{{HTML::image('assets/images/gameplay/poor.jpg', 'Poor', array('class'=>'help'))}}
					<p class="desc">	
						Process cheap materials like vegetables on your 'farm'.
					</p>
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">High on money?</span>
					{{HTML::image('assets/images/gameplay/rich.jpg', 'Rich', array('class'=>'help'))}}
					<p class="desc">	
						Process costly materials on your 'smelter and forge' or try 'alchemy'.
						Also Equip yourself with good quality gear that adds to your stats to have a good chance of winning.
					</p>
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Need some money?</span>
					{{HTML::image('assets/images/gameplay/shop.jpg', 'Shop', array('class'=>'help'))}}
					<p class="desc">	
						Once geared up with material head to the shops in market to trade your items to multilpy your money.
					</p>
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Store your gear</span>
					{{HTML::image('assets/images/gameplay/home.jpg', 'Home', array('class'=>'help'))}}
					<p class="desc">	
						You can always store all you are carrying in your home chest where it stays safe.
						Travelling to market with less inventory can prevent you from suffering heavy losses when attacked by others.
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Battle, Trade or talk your opponents into a deal!</span>
					{{HTML::image('assets/images/gameplay/chat.jpg', 'Chat', array('class'=>'help'))}}
					<p class="desc">	
						You can negotiate deals with your mates. Spot them in the market and try striking a deal. If not happy, and sufficiently strong you can attack and loot them.
						But beware while strolling in the market, cause you too can fall prey.
					</p><hr/>
					<span style="float:right;width:100px;font-size:1.3em;text-align:right;color:#fff">Condition your self regularly.</span>
					{{HTML::image('assets/images/gameplay/stats.jpg', 'Stats', array('class'=>'help'))}}
					<p class="desc">	
						Be aware of your stats displayed at the stat bar. Keep them up and engage with you game. 
						You can enhance your stat upper limits by learning from attainment hall. You can also replenish them when they fall down.
					</p><hr/>
				
		</div>
	</div>
	</body>
</html>