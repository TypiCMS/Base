@section('main')

    <h1>
        @include('core::admin._button-back', ['table' => $model->getTable()])
        @lang($model->getTable() . '::global.New')
    </h1>

    {{ BootForm::open()->action(route('admin.' . $model->getTable() . '.index'))->multipart()->role('form') }}
        @include($model->getTable() . '.admin._form')
    {{ BootForm::close() }}

@stop
