<div id="page-header">
    <ul id="page-navigation">
        <li class="index">{{ link_to('/', "nimbus") }}</li>
    @if(Auth::check())
        <li class="profile">{{ link_to('profile', Auth::user()->name) }}</li>
        <li class="logout">{{ link_to('logout', "logout") }}</li>
    @else
        <li class="login">{{ link_to('login', "login") }}</li>
    @endif
    </ul>

    <ul id="page-messages" class="sqfUiMessages">
    @if (Session::has('message'))
        <li class="notice">{{ Session::get('message') }}</li>
    @else
        <li>&hellip;</li>
    @endif
    </ul>

    {{ link_to('contact', "&copy;", array('id'=>"page-contact")) }}
</div>