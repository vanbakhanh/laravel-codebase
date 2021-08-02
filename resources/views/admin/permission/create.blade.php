@extends ('admin.layouts.app')

@section('breadcrumb')
{{ Breadcrumbs::render('permission-create') }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.permissions.create') }}</h3>
        </div>
        <form action="{{ route('admin.permission.store')  }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                @include("admin.permission.form")
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-md" type="submit">{{ __('labels.general.save') }}</button>
            </div>
        </form>
    </div>
@endsection