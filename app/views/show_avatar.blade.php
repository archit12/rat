<div class="top">
	<div class="panel toppanel animateopacity">
		<span ><img src='{{ $avatar["avatar"] }}' alt="avatar" title="{{ $avatar['aname'] }}"></span>
	</div>
	<div class="panel toptitle animateopacity">
		<span class="name">{{ $avatar['aname'] }}</span>
	</div>
	<div class="mapicon animateopacity">
		<a href="map">{{ HTML::image('assets/images/map.png', 'map', array('class' => 'smoothbig')) }}</a>
	</div>
</div>