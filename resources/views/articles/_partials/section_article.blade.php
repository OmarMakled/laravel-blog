<div class="card-content">
    <article class="media">
        <div class="media-content">
            <div class="content">
                <h3 class="title">
                <a href="{{ url('articles', $article->id) }}">
                    <strong>{{ $article->title }}</strong>
                </a>
                </h3>
                <p>
                    <strong>{{ $article->present()->userName }}</strong>
                    <small>{!! $article->present()->created_at !!}</small>
                </p>
                <p>
                    @if(request()->route('article'))
                    {{ $article->content }}
                    @else
                    {{ str_limit($article->content, '30') }}
                    @endif
                </p>
                @include('articles/_partials/list_categories')
            </div>
            <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item" href="{{ url('articles', $article->id) }}">
                        <span class="icon is-small"><i class="fa fa-reply"></i></span>
                    </a>
                    @admin
                    <a class="level-item" href="{{ url('articles', $article->id)}}/edit">
                        <span class="icon is-small"><i class="fa fa-edit"></i></span>
                    </a>
                    @endadmin
                </div>
            </nav>
        </div>
    </article>
</div>
