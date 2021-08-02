<div class="form-group">
    <label for="firstName">{{ __('labels.general.name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{ __('labels.general.name') }}" name="name" value="{{ @old('name') ?: @$role->name }}">
    @error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="firstName">{{ __('labels.general.guard_name') }}</label>
    <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guardName" placeholder="{{ __('labels.general.guard_name') }}" name="guard_name" value="web" disabled>
    @error('guard_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    <label for="permission">{{ __('labels.general.permission') }}</label>
    @foreach($permissions as $id => $permission)
    <div class="form-check">
        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $id }}" id="permission{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($gavePermission) && $gavePermission->has($id)) ? 'checked' : '' }}>
        <label class="form-check-label" for="permission{{ $id }}">
            {{ $permission }}
        </label>
    </div>
    @endforeach
</div>
<!-- /.card-body -->