@extends('layout')
@section('content')
<form action="{{ url('articles', $article->id) }}" method="POST">
  @include('articles/_partials/form_article')
  {{ method_field('put') }}
</form>
@stop
