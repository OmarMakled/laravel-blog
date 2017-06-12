@if(session('success'))
<div class="notification is-success">
  <a href="javascript:;" class="delete"></a>
  {{ session('success') }}
</div>
@endif

@if(session('error'))
    <div class="notification is-danger">
      <a href="javascript:;" class="delete"></a>
      {{ session('error') }}
    </div>
@endif
