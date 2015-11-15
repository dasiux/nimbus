@extends('public.layout')

@section('content')
<div id="page-login" class="page-content">
    {{ Form::open(array('url' => 'login')) }}
        <div class="row">{{ Form::label('email', 'user/email',array('class'=>"label")) }}{{ Form::text('email') }}</div>
        <div class="row">{{ Form::label('password', 'password',array('class'=>"label")) }}{{ Form::password('password') }}</div>
        <div class="row">{{ Form::submit('login',array('class'=>"label")) }}</div>
    {{ Form::close() }}
</div>
@stop
