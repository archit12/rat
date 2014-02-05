<?php
/*include_once('mysql.inc.php');
include_once('core/model/db.php');
session_start();
	if(!isset($_SESSION['uid']))
	{
		header("Location:index.php");
		die();
	}
	if(isset($_SESSION['avatar']) && isset($_SESSION['aname']))
		{
		header("Location:map.php");
		die();
		}
		
*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        
   
		<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        {{ HTML::style('assets/css/style.css') }}
        {{ HTML::style('assets/css/common.css') }}
        
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
		{{ HTML::script('assets/js/cufon-yui.js') }}
		{{ HTML::script('assets/js/Quicksand_Book_400.font.js') }}
		<script type='text/javascript'>
		function notify(msg,timeout,redirectTo){
			timeout = typeof timeout !== 'undefined' ? timeout : 5000;
			redirectTo = typeof redirectTo !== 'undefined' ? redirectTo : "";
			$("#notify #msg").html(msg);
			$("#notify").fadeIn(500);
			setTimeout(function(){$("#notify").fadeOut(timeout);});
			if(redirectTo != ""){
				$("#notify #button").click(function(){
					$(location).attr("href","home.php");
				});
			}
		}
		</script>
		
		<style>
		#uname:focus,#uname:active
		{
			outline-style: hidden;
			outline:none;
			padding-left:100;
		}
		#ij{
			z-index: 1;
		}
		#ij:hover{
			cursor:pointer;
		}
		#uname{
			font-family: My Custom Font;background: url('{{ URL::to("assets/images/txtbox.png")}}') no-repeat;height: 80PX;border: none;width: 390PX;position: absolute;top: 180px;left: -125px;padding-left: 60px;font-size:30px;color: #520606;
		}
		#emp{
			font-family: My Custom Font;color:white;font-size: 20px;position: absolute;width: 300px;left: -70px;top: 151px;}
		#submit{
			position: absolute;top: 270px;background: none;border: none;
		}
		#sel
		{
			font-family: My Custom Font;color:white;font-size: 40px;position: absolute;width: 800px;left: 320px;top: 240px;}	
		</style>
		
    </head>

    <body>

		<div id="st_main" class="st_main">
			
			<ul id="st_nav" class="st_navigation">
				<li class="album">
					
					<div class="st_wrapper st_thumbs_wrapper">
						<div class="st_thumbs">
							@for ($i=1; $i <= 24; $i++)
								{{ HTML::image('assets/images/avatars/'.$i.'.jpg', 'avatar') }}
							@endfor

						</div>
					</div>
				</li>
				
			</ul>
		</div>
		<div class='avatar'>
			{{HTML::image('assets/images/avatars/24.jpg', 'avatar', array('id'=>'pro'))}}<br><br>
			<label id='emp' >YOUR AVATAR NAME.<BR> KEEP IT ANONYMOUS.</label><br><br>
			<input type='text' id="uname" style= /><br><br>
			<button id='submit'> {{HTML::image('assets/images/btn.png', 'button', array('id'=>'ij'))}}</button>
		
		</div>	
		<div id="sel">
			
			Select an image from above to choose your avatar.

		</div>	
		<div id="notify">
		<div id="msg" >
		</div>		
		</div>
        

        <!-- The JavaScript -->
        <script type="text/javascript">
            $(function() {
				//the loading image
				var $loader		= $('#st_loading');
				//the ul element 
				var $list		= $('#st_nav');
				//the current image being shown
				var $currImage 	= $('#st_main').children('img:first');
				
				//let's load the current image 
				//and just then display the navigation menu
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
				$('#ij').mouseover(function(e) {
				$('#ij').attr('src','{{URL::to("assets/images/btn_hov.png")}}');
				});
				$('#ij').mouseout(function(e) {
				$('#ij').attr('src','{{URL::to("assets/images/btn.png")}}');
				});
				
				function buildThumbs(){
					$list.children('li.album').each(function(){
						var $elem 			= $(this);
						var $thumbs_wrapper = $elem.find('.st_thumbs_wrapper');
						var $thumbs 		= $thumbs_wrapper.children(':first');
						//each thumb has 180px and we add 3 of margin
						var finalW 			= $thumbs.find('img').length * 103;
						$thumbs.css('width',finalW + 'px');
						//make this element scrollable
						makeScrollable($thumbs_wrapper,$thumbs);
					});
				}
				
				
				$list.find('.st_thumbs img').bind('click',function(){
					var $this = $(this);
					$('#pro').load(function(){
						var $this = $(this);
						var $currImage =$this.attr("src");
						}).fadeOut(500,function(){
							$(this).attr('src',$this.attr('src'));
							// $(this).show.fadeIn(100);
							$(this).fadeIn(200, function () {
						    $(this).fadeIn(100);
						  });
						 

						});//.attr('src',$this.attr('src'));
				}).bind('mouseenter',function(){
					$(this).stop().animate({'opacity':'1'});
				}).bind('mouseleave',function(){
					$(this).stop().animate({'opacity':'0.7'});
				});
				
				//function to hide the current opened menu
				$('#submit').live('click',function(){
				 if($('#uname').val()=="")
					notify('Please enter your avatar name');
				else{	
					//alert($('#pro').attr('src'));
					$.ajax({
					  url: "user_login.php",
					  type : 'post',
					 data : {'pic':$('#pro').attr('src'),'name':$('#uname').val()},
					}).done(function(data) {
						//alert(data);
						window.location = "game.php";
						});
					}	
				});

				//makes the thumbs div scrollable
				//on mouse move the div scrolls automatically
				function makeScrollable($outer, $inner){
					var extra 			= 1000;
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
            });
        </script>
    </body>
</html>
<?php
 if((isset($_SESSION['avatar']) && isset($_SESSION['aname']) && !empty($_SESSION['avatar'])))
 { 
	//echo "item";
	 // $res=mysql_fetch_array($r);
	 // $_SESSION['avatar']=$res['avatar'];
	 // $_SESSION['aname']=$res['aname'];
	
	header('Location:map.php');
}
	
?>