@extends('layout')

@section('content')
    @foreach($articles as $article)
    <section>
        @include('articles/_partials/section_article')
    </section>
    @endforeach
    {{ $articles->links('vendor/pagination/bulma') }}
@stop
