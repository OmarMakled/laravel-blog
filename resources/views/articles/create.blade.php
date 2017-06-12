@extends('layout')

@section('content')
<form action="{{ url('articles') }}" method="POST">
  @include('articles/_partials/form_article')
</form>

@stop
