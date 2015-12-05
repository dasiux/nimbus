@extends('public.layout')

@section('content')
    <div id="nbsTHREEmap"></div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        nimbus.init('map',{
            uni:{{ $universe->id }},
            user:{{ Auth::user()->id }}
        });
    });
</script>
@stop
