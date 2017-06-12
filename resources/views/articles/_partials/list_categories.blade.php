<p class="list-categories">
    @foreach($article->categories as $category)
    <a href="{{ url('categories', $category->id) }}">
            <span class="tag is-info">{{ $category->name }}</span>
        </a>

    @endforeach
</p>
