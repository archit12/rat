{{ Form::open(array('url' => 'login')) }}
	{{ Form::text('username', 'archit') }}
	{{ Form::password('password') }}
	{{ Form::submit('submit') }}
{{ Form::close() }}