@include('/_partails/form_errors')

<div class="field form-article">
  <label class="label">Title</label>
  <p class="control">
    <input class="input" name="title" value="{{ old('title') ?? $article->title }}" type="text" placeholder="Title">
  </p>
</div>

<div class="field">
  <label class="label">Content</label>
  <p class="control">
    <textarea class="textarea" name="content" placeholder="Content">{{old('content') ?? $article->content}}</textarea>
  </p>
</div>

<div class="field">
    <p class="control">
      @foreach($categories as $category)
          <label class="checkbox">
            <input
              type="checkbox"
              name="categories[]"
              value="{{ $category->id }}"
              @if(old('categories'))
                {{ in_array($category->id, old('categories')) ? 'checked' : ''}}
              @else
                {{ in_array($category->id, $article->categoryIds) ? "checked" : ""}}
              @endif
            >
              {{ $category->name }}
          </label>
      @endforeach
    </p>
</div>

<div class="field is-grouped">
  <p class="control">
    <button class="button is-primary">Submit</button>
  </p>
</div>

{{ csrf_field() }}
