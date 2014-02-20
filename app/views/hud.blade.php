<div class="panel bottompanel animateopacity" id="traits_bar"><center>
<span class="{{ $money[0]->it_name }} stat" title="{{ $money[0]->it_name }}">
	{{ HTML::image('assets/images/money.png', $money[0]->it_name) }}
	{{ $money[0]->qty }}
</span>
@foreach ($traits as $trait)
	<span class="{{ $trait->t_name }} stat" title="{{ $trait->t_name }}">
	{{ HTML::image($trait->symbol, $trait->t_name) }}
	{{ $trait->value }}
	</span>
@endforeach
</center>
</div>