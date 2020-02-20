@extends ('admin.layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('user-create') }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.admin.users.create') }}</h3>
        </div>
        {{ Form::open(['route' => 'admin.user.store', 'method' => 'post']) }}
            <div class="card-body">
                @include("admin.user.form")
            </div>
            <div class="card-footer">
                {{ Form::submit(__('labels.general.buttons.save'), ['class' => 'btn btn-primary btn-md']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection