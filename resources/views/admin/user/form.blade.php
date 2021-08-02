<div class="form-group">
    <label for="firstName">{{ __('labels.general.first_name') }}</label>
    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" placeholder="{{ __('labels.general.first_name') }}" name="first_name" value="{{ @old('first_name') ?: @$user->profile->first_name }}">
    @error('first_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="lastName">{{ __('labels.general.last_name') }}</label>
<input type="text" class="form-control @error('email') is-invalid @enderror" id="lastName" placeholder="{{ __('labels.general.last_name') }}" name="last_name" value="{{ @old('last_name') ?: @$user->profile->last_name }}">
    @error('last_name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<div class="form-group">
    <label for="email">{{ __('labels.general.email') }}</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="{{ __('labels.general.email') }}" name="email" value="{{ @old('email') ?: @$user->email }}" {{ isset($user->email) ? 'disabled' : '' }}>
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
<div class="form-group">
    <label for="role">{{ __('labels.general.role') }}</label>
    @foreach($roles as $id => $role)
    <div class="form-check">
        <input class="form-check-input" name="roles[]" type="checkbox" value="{{ $id }}" id="role{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($gaveRole) && $gaveRole->has($id)) ? 'checked' : '' }}>
        <label class="form-check-label" for="role{{ $id }}">
            {{ $role }}
        </label>
    </div>
    @endforeach
</div>
<!-- /.card-body -->
