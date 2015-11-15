@extends('public.layout')

@section('content')
<div id="page-index" class="page-content">
    <h1 class="logo">&#414;&#585;m&#387;u&#424;</h1>
    @if(Auth::check())

        <ol id="select-universe">
        @forelse($universes as $universe)
            <li>
                <span class="name">{{ $universe->name }}</span>
            </li>
        @empty

        @endforelse
        </ol>

        <h2>changelog</h2>
        @if(isset($changelogs)&&$changelogs)
        <ol id="change-log">
            @forelse($changelogs as $log)
                <li><span class="date">{{ $log->dated_at }}</span> <span class="commit">{{ $log->commit }}</span><div class="notice">{{ $log->notice }}</div></li>
            @empty
                <li><span class="date">0000-00-00</span> <span class="commit">&hellip;</span><div class="notice">No changelog messages&hellip;</div></li>
            @endforelse
        </ol>
        @endif

    @endif
</div>
@stop
