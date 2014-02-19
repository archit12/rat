<?php
	/*
	require_once('./core/view/view_school.php');
	require('./core/model/modal_user.php');
	$loc=modal_user::check_location($uid , 4);
	if(!$loc)
		{
			echo mysql_error();
			die();
		}
	*/
	?>
<!doctype html>
<html>
<head>
{{HTML::style('assets/css/common.css')}}
{{HTML::style('assets/css/school.css')}}
{{HTML::script('assets/js/jquery-1.9.0.min.js')}}
{{HTML::script('assets/js/turn.min.js')}}
		<script type="text/javascript">
		$('#board').hide();
		function initTimer(t){
					$(".container").show();
					$(".wait").animate(	{width:$(".container").width()},t*1000);
					setTimeout(function(){$(".container").fadeOut(1000);},t*1000);
		}
		function notify(msg,timeout,redirectTo){
			timeout = typeof timeout !== 'undefined' ? timeout : 5000;
			redirectTo = typeof redirectTo !== 'undefined' ? redirectTo : "";
			$("#notify #msg").html(msg);
			$("#notify").fadeIn(500);
			setTimeout(function(){$("#notify").fadeOut(1000);},timeout);
			if(redirectTo != ""){
				$("#popup #button").click(function(){
					alert('hoo');
					$(location).attr("href",redirectTo);
				});
				setTimeout(function(){$(location).attr("href","map")},timeout);
			}
		}
				$(document).ready(function(){
					$('#board').hide();

					<?php 
						/*echo view_school::checkForTimer();*/
					?>
					$(".lea").click(function(e){
						 data="skill="+$(this).attr('id');
						 $.post('./school.php',data , function(data){					
							if(data.length!=0)
								{
									if(data==1)
										notify("Skill Learnt succesfully. You can not learn any skill for some time now. You can move to the map now",5000,"attainmenthall.php");
									else if(data==2)
										notify("Some of the items required for this skill are missing.You need to gather them and come back to school");
									else if(data==3)
										notify("You cannot learn the next skill for certain period of time.Come back later");
									else if(data==4)
										notify("You need to attain a higher level of wisdom to learn this skill. Upgrade your Wisdom first");
									else if(data==5)
										notify("Maximam level of the skill achieved..");
								}
						 });
						setTimeout(function(){ $.post('./school.php','update_trait=update',function(data){
							if(data.length!=0)
							{
								$('#traits_bar').html("<center>"+data+"<center>");
							}
						 })},100);
										e.preventDefault();
									});
									$('#leader').click(function(){

							//$('#board').show();
						});
						$('#close').click(function(){

							$('#board').hide();
						});
				});
		</script>
</head>
<body>
		@include('hud')
		@include('show_avatar')
		<div class="panel rightpanel">
		<div id='logot'><a id='logout' href='rat_logout' title='logout'>
		{{HTML::image('assets/images/icons/logout.png', 'logout', array('class' => 'smoothbig', 'width' => 50, 'height' => 50))}}
		</a></div>
      <div id='leaderboard'>
        <a id='leader' href='lb2/scrolloffame.html' class='smoothbig' title='Leaderboard' target='_blank'>
          {{HTML::image('assets/images/icons/leaderboard.png', 'leaderboard', array('class' => 'smoothbig', 'width' => 50, 'height' => 50))}}
        </a>
      </div>
				<div id='st'><a id='story' href='story'>
				{{HTML::image('assets/images/icons/story.png', 'story', array('title' => 'story', 'class' => 'smoothbig', 'width' => 50, 'height' => '50'))}}
				</a></div>					
				
	</div>
<br/>
<div class="container" style="display:none;">
		<div class="wait">
			
		</div>
</div>
	<div id="notify">
		<div id="msg">
		</div>
		<!--<a id="button" href="#">OK</a>-->
	</div>

<center>

	<div id="flipbook">
		<div class="hard big own-size" id="hardfront1">
			<h1>br/></h1>
		</div>
		<div class="hard big own-size " id="hardfront2">
			<!-- {{HTML::image('assets/images/star.png', 'star', array('class' => 'learnt'))}} -->
			<?php
			/*$msg1=view_school::constellation();
			$msg=explode('@',$msg1);
			echo $msg[0]."</div><div style='background-image:url(img/pages/i.png)'>".$msg[1];*/
			?>
		</div>
		<div style="background-image:url('assets/images/pages/i.png');"></div>
		<div style="background-image:url('assets/images/pages/ii.png');"></div>
		<?php
		/*echo view_school::show_info();*/
		?>
		<div style="background-image:url('assets/images/pages/01.png');">
			<h1 class="chapter">Contents</h1>
			<ul>
				@foreach ($skills as $skill)
					{{ '<li>'.$skill->name.'</li>' }}
				@endforeach
			</ul>
		</div>
		<div style="background-image:url('assets/images/pages/01.png');"></div>
		<div class="hard big own-size fixed" id="hardback2"></div>
		<div class="hard big own-size" id="hardback1"></div>
	</div>
<div id="ok_again" >
	
</div>
</center>
<script type="text/javascript">
	$("#flipbook").turn({
		width: 856,
		height: 547,
		autoCenter: true
	});
	$('#flipbook').bind('turning', function(event, page, view) { 
		if (page>=2){
			$('#hardfront2,#hardback2').addClass('fixed');
		}
		if (page>=$(this).turn('pages')){
			$('#hardback2').removeClass('fixed');
		}
		if(page==1){
			$('#hardfront2').removeClass('fixed');
		}
	});
</script>
<script type="text/javascript">
	$(window).bind('keydown', function(e){

		if (e.keyCode==37)
			$('#flipbook').turn('previous');
		else if (e.keyCode==39)
			$('#flipbook').turn('next');

	});
	function jump(id){
		var page = new Array();
		page['alchemy']=8;
		page['warcraft']=12;
		page['farming']=6;
		page['smithing']=10;
		page['wisdom']=14;
		$("#flipbook").turn("page", page[id]);
	}
</script>
	<img src="../public/assets/images/logo.png" alt="reiches" style="position:fixed;bottom:50px;left:30px;" title="copyright - Software Incubator 2014">
</body>
</html>