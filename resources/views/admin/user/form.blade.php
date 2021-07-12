<div class="form-group">
    <label for="firstName">{{ __('labels.general.users.profile.first_name') }}</label>
    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" placeholder="{{ __('labels.general.users.placeholder.first_name') }}" name="first_name" value="{{ @old('first_name') ?: @$user->profile->first_name }}">
    @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="lastName">{{ __('labels.general.users.profile.last_name') }}</label>
<input type="text" class="form-control @error('email') is-invalid @enderror" id="lastName" placeholder="{{ __('labels.general.users.placeholder.last_name') }}" name="last_name" value="{{ @old('last_name') ?: @$user->profile->last_name }}">
    @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="email">{{ __('labels.general.users.email') }}</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('labels.general.users.placeholder.email') }}" name="email" value="{{ @old('email') ?: @$user->email }}" {{ isset($user->email) ? 'disabled' : '' }}>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
        <input type="checkbox" class="custom-control-input" id="active" name="status" value="{{ config('model.user.status.active') }}" {{ isset($user) && $user->status === config('model.user.status.active') ? 'checked' : '' }}>
        <label class="custom-control-label" for="active">{{ __('labels.general.active') }}</label>
    </div>
</div>
<!-- /.card-body -->
