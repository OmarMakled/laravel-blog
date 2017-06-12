@include('_partails/header')
<body>
    <section class="hero is-fullheight is-primary">
        <div class="hero-head">

        </div>
        <div class="hero-body">
            <div class="container has-text-centered">
                <h3 class="title is-2">
                    @yield('content')
                </h3>
            </div>
        </div>
        <div class="hero-foot">
            <div class="container">
                <div class="tabs is-centered">
                    <ul>
                        <li><a href="{{ url('/') }}">home</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
