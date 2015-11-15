<div class="container">
    <div class="row footer">
        @if(Auth::check())
            <div class="col-md-3">
                {{ link_to('logout', 'Abmelden') }}
            </div>
        @endif
    </div>
</div>