    @include('_partails/header')
    <body>
        <div class="container">
            @include('_partails/nav')
        </div>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column  is-8 is-offset-2">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
