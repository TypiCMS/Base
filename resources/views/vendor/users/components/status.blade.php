@if ($message = session('status'))
    <div class="alert alert-info" role="alert">
        {{ $message }}
    </div>
@endif
