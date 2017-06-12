<nav class="nav">
    <div class="nav-left">
        <a class="nav-item is-brand" href="{{ url('/') }}">
            <img src="http://bulma.io/images/bulma-logo.png" alt="Bulma: a modern CSS framework based on Flexbox">
        </a>
    </div>
    <span id="nav-toggle" class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
    </span>
    <div id="nav-menu" class="nav-right nav-menu">
        <div class="nav-item">
            <div class="field is-grouped">
                @guest
                <p class="control">
                    <a class="button" href="{{ url('login') }}">
                        <span class="icon">
                            <i class="fa fa-sign-in"></i>
                        </span>
                        <span>login</span>
                    </a>
                </p>
                @endguest
                @admin
                <p class="control">
                    <a class="button is-primary" href="{{ url('articles/create') }}">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span>Add Article</span>
                    </a>
                </p>
                <p class="control">
                    <a class="button" href="{{ url('logout') }}">
                        <span class="icon">
                            <i class="fa fa-sign-out"></i>
                        </span>
                        <span>logout</span>
                    </a>
                </p>
                @endadmin
            </div>
        </div>
    </div>
</nav>
