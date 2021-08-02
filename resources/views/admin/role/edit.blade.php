@extends ('admin.layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('role-edit', $role) }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.roles.edit') }}</h3>
        </div>
        <form action="{{ route('admin.role.update', ['role' => $role->id])  }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="card-body">
                @include("admin.role.form")
            </div>
            <div class="card-footer">
                <button class="btn btn-primary btn-md" type="submit">{{ __('labels.general.update') }}</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        var changePassword = function() {

            if ($("#change-password").is(":checked")) {
                $('#password').prop('disabled', false);
                $('#newPasswordConfirm').prop('disabled', false);
            } else {
                $('#password').prop('disabled', 'disabled');
                $('#newPasswordConfirm').prop('disabled', 'disabled');
            }
        };
        $(changePassword);
        $("#change-password").change(changePassword);
    </script>
@endsection