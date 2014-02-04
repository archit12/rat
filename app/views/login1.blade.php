{{ Form::open(array('url' => '/login')) }}
    {{ Form::text('username') }}
    {{ Form::password('password') }}
    {{ Form::submit('Login') }}
{{ Form::close() }}