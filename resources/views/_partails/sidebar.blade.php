<div class="card-content">
@foreach($side_bar_categories as $category)
    <a href="{{ url('categories', $category->id) }}">
            <span class="tag is-info">
                {{ $category->name }}
                <span class="tag is-white">{{ $category->articles->count() }}</span>
            </span>
        </a>
@endforeach
</div>

@foreach($side_bar_latest_articles as $article)
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
            </div>
        </div>
    </article>
</div>
@endforeach
