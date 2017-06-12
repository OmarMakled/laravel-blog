    @include('_partails/header')
    <body>
        <div class="container">
            @include('_partails/nav')
        </div>
        <section class="section">
            <div class="container">
                <div class="columns">
                    <div class="column">
                        @include('_partails/sessions')
                        @yield('content')
                    </div>
                    <div class="column is-one-quarter">
                        @include('_partails/sidebar')
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
