@extends('login')

@section('content')
        @include('_partails/form_errors')
        <form action="{{ url('login') }}" method="post">
            <div class="field form-article">
              <p class="control">
                <input class="input is-large" name="email" value="" type="text" placeholder="Email">
              </p>
            </div>
            <div class="field form-article">
              <p class="control">
                <input class="input is-large" name="password" value="" type="password" placeholder="Password">
              </p>
            </div>
            <p class="control">
              <button class="button is-primary is-large is-fullwidth">Submit</button>
            </p>
            {{ csrf_field() }}
        </form>
@stop
