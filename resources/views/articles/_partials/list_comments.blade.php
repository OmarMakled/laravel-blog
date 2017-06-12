@foreach($article->comments as $comment)
<div class="card-content">
    <article class="media">
        <div class="media-content">
            <div class="content">
                <p>
                    <strong>{{ $comment->present()->userName }}</strong>
                    <small>{{ $comment->present()->created_at }}</small>
                </p>
            </p>
            {{  $comment->content }}
        </p>
    </div>
</div>
</article>
</div>
@endforeach
