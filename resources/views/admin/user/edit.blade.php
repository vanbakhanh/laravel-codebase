@extends ('admin.layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('user-edit', $user) }}
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ __('labels.admin.users.edit') }}</h3>
        </div>
        {{ Form::open(['route' => ['admin.user.update', 'id' => $user->id], 'method' => 'PUT']) }}
            <div class="card-body">
                @include("admin.user.form")
            </div>
            <div class="card-footer">
                {{ Form::submit(__('labels.general.buttons.save'), ['class' => 'btn btn-primary btn-md']) }}
            </div>
        {{ Form::close() }}
    </div>
@endsection

@section('scripts')
    <script> 
        var changePassword = function () {

            if ($("#change-password").is(":checked")) {
                $('#password').prop('disabled', false);
                $('#newPasswordConfirm').prop('disabled', false);
            }
            else {
                $('#password').prop('disabled', 'disabled');
                $('#newPasswordConfirm').prop('disabled', 'disabled');
            }
        };
        $(changePassword);
        $("#change-password").change(changePassword);
    </script>
@endsection
