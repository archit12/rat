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
<!DOCTYPE html>
<html>
<head>
{{HTML::style('assets/css/common.css')}}
{{HTML::style('assets/css/school.css')}}
{{HTML::script('assets/js/jquery-1.9.0.min.js')}}
{{HTML::script('assets/js/turn.min.js')}}
		<script type="text/javascript">
		$('#board').hide();
		$(window).on('beforeunload', function(){
			console.log("ok");
        	return "You will be logged out!";
     	});
		/*function initTimer(t){
					$(".container").show();
					$(".wait").animate(	{width:$(".container").width()},t*1000);
					setTimeout(function(){$(".container").fadeOut(1000);},t*1000);
		}
		function notify(msg,timeout,redirectTo){
			timeout = typeof timeout !== 'undefined' ? timeout : 5000;
			redirectTo = (typeof redirectTo !== 'undefined') ? redirectTo : "";
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
		}*/
				/*$(document).ready(function(){
					$('#board').hide();

					$('.lea').click(function(event) {
						$.post('learnSkill', data: {'skill': ''}, function(data, textStatus, xhr) {
							/*optional stuff to do after success */
						/*});
					});
				});*/
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
		</div>
		<div class="hard big own-size " id="hardfront2">
			@foreach ($contents as $skill)
				@for ($i=1; $i <= 4; $i++)
				
					
					@if (!($skill->name == 'smithing' && $i == 4) && ($skill->name != 'wisdom') ) 
					@if ($i <= $skill->level) 
							{{ HTML::image('assets/images/stared.png', 'star', array('class' => 'learnt',
										 'id' => "$skill->name"."$i",
										 'title' => 'Level '.$i)) }}

					@elseif($skill->name != 'wisdom')
						{{ HTML::image('assets/images/stared.png', 'star', array('class' => 'learn',
										 'id' => "$skill->name"."$i",
										 'title' => 'Level '.$i)) }}			 
					@endif
					@endif
					
					
				@endfor
			@endforeach		
		</div>
		<div style="background-image:url('assets/images/pages/i.png');">
			@foreach ($contents as $skill)
				@for ($i=1; $i <= 4; $i++)
					@if ($i <= $skill->level) 
						@if(($skill->name == 'smithing' && $i == 4) || $skill->name == 'wisdom' )
							{{ HTML::image('assets/images/stared.png', 'star', array('class' => 'learnt',
										 'id' => "$skill->name"."$i",
										 'title' => 'Level '.$i)) }}
						@endif
					@elseif($skill->name == 'wisdom' || $skill->name == 'smithing')
						{{ HTML::image('assets/images/stared.png', 'star', array('class' => 'learn',
										 'id' => "$skill->name"."$i",
										 'title' => 'Level '.$i)) }}
					@endif
				@endfor
			@endforeach
		</div>
		<div style="background-image:url('assets/images/pages/ii.png');"></div>
		<?php
		/*echo view_school::show_info();*/
		?>
		<div style="background-image:url('assets/images/pages/01.png');">
			<h1 class="chapter">Contents</h1>
			<ul>
				@foreach ($contents as $content)
					<li>
					<a href="#{{ $content->name }}" onclick="jump('{{$content->name}}')">{{ $content->name }}</a>
					</li>
				@endforeach
			</ul>
		</div>
			@foreach ($contents as $content)
				<div style="background-image:url('assets/images/pages/02.png');">
					<p class="aboutskill">{{ $content->text }}</p>
					<p class="aboutskill"><span style="color:black;display: block;">current level</span><span class="level">{{ $content->level }}</span></p>
				</div>
				<div style="background-image:url('assets/images/pages/01.png');">
					<h1 class="chapter">{{ $content->name }}</h1>
					{{ HTML::image($content->url, $content->name, array('class'=>'skillicon')) }} <br/><br />
					<span class="upgrade">
					@if ($content->level != 4)
						<a href="#" style="color:green" class="lea" id="{{ $content->name }}">Learn</a>
					@else
						<a style="color:green" class="lea">Completed</a>
					@endif
					</span>
				</div>
			@endforeach
		<div style="background-image:url('assets/images/pages/01.png');"></div>
		<div class="hard big own-size fixed" id="hardback2"><h1 style="margin-top: 50%;">The End</h1></div>
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
		page['alchemy']=9;
		page['warcraft']=13;
		page['farming']=7;
		page['smithing']=11;
		page['wisdom']=15;
		$("#flipbook").turn("page", page[id]);
	}
</script>
	<img src="../public/assets/images/logo.png" alt="reiches" style="position:fixed;bottom:50px;left:30px;" title="copyright - Software Incubator 2014">
</body>
</html>