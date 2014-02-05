<?php
/*session_start();
if(!isset($_SESSION['uid']))
	{
		header("Location:index.php");
		die();
	}
include('core/model/modal_smith.php');
require('./core/model/modal_user.php');
if(isset($_SESSION['path']))
	header('Location:'.$_SESSION['path']);
$uid=$_SESSION['uid'];
$loc=modal_user::check_location($uid , 5);
if(!$loc)
	{
		echo mysql_error();
		die();
	}*/
?>
<html>
	<head>
		<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
		<link rel="stylesheet" href="css/common.css" type="text/css"/>
		<link rel="stylesheet" href="css/map.css" type="text/css"/>
		<link rel="stylesheet" href="css/forge.css" type="text/css"/>
		 <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/piemenu.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/ajax_v2.js"></script>
		<script src="js/jquery.menu.js"></script>
		<script src="js/jquery-ui-1.8.20.custom.min.js"></script>
		<script>
		/*$(document).ready(function(){
			$("#i1").mouseover(function(e) {
				//alert(e.pageX);
			});
			$("#consume").click(function() {PieMenuInit();});
			$('#x').hide();
			$('#board').hide();
			$('.black_div').hide();
			$('.st_thumbs').hide();
			$('.for_pic').hide();
			$('.out').hide();
			$('#consume').live('click', function () {
				$('.out').html("");
					$("#x").show();
					$('.black_div').show();
					$('.for_pic').show();
			$('#cons_an').show();
				});
			$('#equip').live('click', function () {
				$('.out').html("");
					$("#x").show();
					$('.black_div').show();
					$('.for_pic').show();
			$('#farm_an').show();
				});
			$('.hide_process').click(function(){
				$("#x").hide();
				$('#cons_an').hide();
				$('#farm_an').hide();
				$('.out').html("");
				$('#pro').attr("src","");

			});
		});			
		
		function PieMenuInit(){		
			$('#outer_container').PieMenu({
				'starting_angel':$('#s_angle').val(),
				'angel_difference' : $('#diff_angle').val(),
				'radius':$('#radius').val(),
			});			
		}
		$(function() {          
			$("#submit_button").click(function() {reset(); }); 
			
			PieMenuInit();
			
		});
		$("#consume").click(function() {PieMenuInit();});
		function reset(){
			if($(".menu_button").hasClass('btn-rotate'))
			$(".menu_button").trigger('click');
			
			$("#info").fadeIn("slow").fadeOut("slow");
			PieMenuInit();
		}
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
		
	
					
		*/
		</script>
	</head>
	<body>
		<?/*php include('hud.php')*/?>
		<div class="panel rightpanel">
				<div id='outer_container' class="outer_container" >
						<a class="menu_button" href="#" title="Equip/Consume"><img src='img/icons/equip.png' class='smoothbig' width='50' heigth='50'/></a>
						<ul class="menu_option">
						  <li style='font-size:30px;color:white;'><a id='consume' href="#"><span title='Click to Consume'>Item</span></a>Consume</li>
						  <li style='font-size:30px;color:white;'><a id='equip' href="#"><span title='Click to Equip'>Item</span></a>Equip</li>						 
						</ul> 
					<script>$("#consume").click(function() {reset();});$("#equip").click(function() {reset();});</script>	
					</div>
				<div id='logot'><a id='logout' href='#' title='Logout' class='smoothbig'><img src='img/icons/logout.png' class='smoothbig' width='50' heigth='50'/></a></div>
				<div id='leaderboard'><a id='leader' href='lb2/scrolloffame.html' class='smoothbig' title='Leaderboard' target='_blank'><img src='img/icons/leaderboard.png' class='smoothbig' width='50' heigth='50'/></a></div>
				<div id='st'><a id='story' class='smoothbig' href='game.php'><img src='img/icons/story.png' title='Story' width='50' class='smoothbig' heigth='50'/></a></div>					
				
		</div>
		<div class="maparea">
			<a href="home.php"><img src="img/house1.png" id="house1" title="Process your material here." class="places"/></a>
			<a href="market_f.php"><img src="img/market.png" id="market" title="A central trade point. Meet other players here." class="places"/></a>
			<a href="attainmenthall.php"><img src="img/school.png" id="school" title="Hone your skills here." class="places"/></a>
		</div>
		<img src="img/marker.png" class="house1 marker" />
		<img src="img/marker.png" class="school marker" style="display:none;"/>
		<img src="img/marker.png" class="market marker" style="display:none;"/>
		<div id='x' style=''>
			 <div id="st_main" class="st_main" >	
			 	<div class='black_div'><h2 style='z-index:3;position:absolute;top:10px;left:20px;font-family:"My Custom Font";font-size: 33px;'> Select an item from the list below </h2>	</div>	
			 		
					<ul id="st_nav" class="st_navigation">
							<li class="album">						

								<div class="st_wrapper st_thumbs_wrapper">

									<div id='farm_an' class="st_thumbs">
										<?php smith::get_equip_items($_SESSION['uid'])?>										
									</div>
									<div id='cons_an' class="st_thumbs">
										<?php smith::get_cons_items($_SESSION['uid'])?>										
									</div>
									
								</div>
							</li>
							
						</ul>

					</div>

					<div class='for_pic'>
						<img src="img/close.png" class="hide_process smoothbig" id="smelter_"/>
						<img  id='pro' /><br><br>
							
					</div>	
					<div class='out'></div></div>
		<img class="animateopacity" src="img/logo.png" style="position:fixed;bottom:50px;left:30px;" title="copyright - Software Incubator 2013"/>
		 <script type="text/javascript">
            /*$(function() {
            	var x="";
				//the loading image
				var $loader		= $('#st_loading');
				//the ul element 
				var $list		= $('#st_nav');
				//the current image being shown
				var $currImage 	= $('#st_main').children('img:first');
				$('<img>').load(function(){
					$loader.hide();
					$currImage.fadeIn(3000);
					//slide out the menu
					setTimeout(function(){
						$list.animate({'left':'0px'},500);
					},
					1000);
				}).attr('src',$currImage.attr('src'));
				
				//calculates the width of the div element 
				//where the thumbs are going to be displayed
				buildThumbs();
				
				function buildThumbs(){
					$list.children('li.album').each(function(){
						var $elem 			= $(this);
						var $thumbs_wrapper = $elem.find('.st_thumbs_wrapper');
						var $thumbs 		= $thumbs_wrapper.children(':first');
						//each thumb has 180px and we add 3 of margin
						var finalW 			= $thumbs.find('img').length * 127;
						$thumbs.css('width',finalW + 'px');
						//make this element scrollable
						makeScrollable($thumbs_wrapper,$thumbs);
					});
				}
				
				$list.find('.st_thumbs img').bind('click',function(){
					var $this = $(this); 
					var n=$this.attr("src").split("/");
						if(n[3]!="quest.jpg")
						 x="img/items/300x300/"+n[3];
					 	else
					 		 x=$this.attr("src");
					 	if($this.attr('id')==-1){
					 		$('.out').html("INCREASE YOUR LEVEL")	  	
							$('.out').show(1000,"linear");
					 	}
					 	else{
					 		if($this.attr('id')==34||$this.attr('id')==35||$this.attr('id')==36||$this.attr('id')==37||$this.attr('id')==38){
					 			$.ajax({
						url: "smith_process.php",
						   type : 'get',
						 // data : {//"id":$this.attr("id"),"name":$this.attr("alt"),"equip":3},
						 data : "disp1="+$this.attr("id"),
						 }).done(function(data) {						
						$('.out').hide(200,"swing");
					$('.out').removeData();
					$('.out').html("");					
					$('.out').html(data)	  	
					$('.out').show(1000,"linear");

								
						});	
					 		}

					 		else{

						$.ajax({
						url: "smith_process.php",
						   type : 'get',
						 // data : {//"id":$this.attr("id"),"name":$this.attr("alt"),"equip":3},
						 data : "disp="+$this.attr("id"),
						 }).done(function(data) {						
						$('.out').hide(200,"swing");
					$('.out').removeData();					
					$('.out').html(data)	  	
					$('.out').show(1000,"linear");

								
						});	


						}
						}//else main
		 				
								
					$('#pro').load(function(){				 		
						var $this = $(this);
						var $currImage =$this.attr("src");
						}).fadeOut(500,function(){
							$(this).attr("src",x);
							// $(this).show.fadeIn(100);
							$(this).fadeIn(200, function () {
						    $(this).fadeIn(100);
						  });
						 

						});//.attr('src',$this.attr('src'));
				}).bind('mouseenter',function(){
					$(this).stop().animate({'opacity':'1'});
				}).bind('mouseleave',function(){
					$(this).stop().animate({'opacity':'0.5'});
				});
				function makeScrollable($outer, $inner){
					var extra 			= 990;
					//Get menu width
					var divWidth = $outer.width();
					//Remove scrollbars
					$outer.css({
						overflow: 'hidden'
					});
					//Find last image in container
					var lastElem = $inner.find('img:last');
					$outer.scrollLeft(0);
					//When user move mouse over menu
					$outer.unbind('mousemove').bind('mousemove',function(e){
						var containerWidth = lastElem[0].offsetLeft + lastElem.outerWidth() + 2*extra;
						var left = (e.pageX - $outer.offset().left) * (containerWidth-divWidth) / divWidth - extra;
						$outer.scrollLeft(left);
					});
				}
            });*/
        </script>
	</body>
</html>