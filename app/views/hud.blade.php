<div class="panel bottompanel animateopacity" id="traits_bar"><center>
@foreach ($traits as $trait)
	<span class="{{ $trait->t_name }} stat" title="{{ $trait->t_name }}">
	{{ HTML::image($trait->symbol, $trait->t_name) }}
	{{ $trait->value }}
	</span>
@endforeach
</center>
</div>