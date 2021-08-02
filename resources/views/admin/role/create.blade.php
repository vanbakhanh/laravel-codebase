@extends ('admin.layouts.app')

@section('breadcrumb')
{{ Breadcrumbs::render('role-create') }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.roles.create') }}</h3>
        </div>
        <form action="{{ route('admin.role.store')  }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                @include("admin.role.form")
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-md" type="submit">{{ __('labels.general.save') }}</button>
            </div>
        </form>
    </div>
@endsection