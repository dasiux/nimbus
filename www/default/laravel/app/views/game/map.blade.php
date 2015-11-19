@extends('public.layout')

@section('content')
<script type="text/javascript">
    jQuery(document).ready(function(){
        nimbus.init('game',{
            uni:{{ $universe->id }},
            user:{{ Auth::user()->id }}
        });
    });
</script>
@stop
