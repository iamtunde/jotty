<nav class="orange accent-2" role="navigation">
    <div class="nav-wrapper container">
        <a id="logo-container" href="#" class="brand-logo black-text">{{ env('APP_NAME') }}</a>
        <ul class="right hide-on-med-and-down">
            @if(\Auth::user())
                <li><a href="{{ url('logout') }}" class="waves-effect waves-light blue-grey darken-3 btn">Log out</a></li>
            @endif
        </ul>
    </div>
</nav>