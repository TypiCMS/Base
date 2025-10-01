@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        {{ __('The form contains errors:') }}
        <ul class="mb-0">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="@lang('Close')"></button>
    </div>
@endif