<form action='{{ url("articles/{$article->id}/comment") }}' class="form-comment" method="POST" >

    @include('/_partails/form_errors')

    <div class="field">
        <label class="label">Content</label>
        <p class="control">
            <textarea class="textarea" name="content" placeholder="Content"></textarea>
        </p>
    </div>

    <div class="field is-grouped">
        <p class="control">
            <button class="button is-primary">Submit</button>
        </p>
    </div>
    {{ csrf_field() }}
</form>
