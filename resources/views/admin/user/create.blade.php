@extends ('admin.layouts.app')

@section('breadcrumb')
{{ Breadcrumbs::render('user-create') }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.admin.users.create') }}</h3>
        </div>
        <form action="{{ route('admin.user.store')  }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
                @include("admin.user.form")
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-md" type="submit">{{ __('labels.general.buttons.save') }}</button>
            </div>
        </form>
    </div>
@endsection