<div class="container">
    <div class="row header">
        <h1>base</h1>
        <div class="col-md-12">
            @if(Auth::check())

            @endif
        </div>
    </div>

    <div class="alert alert-success hide" id="messageAjax" ></div>

    @forelse($errors->all() as $error)
        <div class="alert alert-warning">{{$error}}</div>
    @empty

    @endforelse

    @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-warning">{{Session::get('error')}}</div>
    @endif

</div>