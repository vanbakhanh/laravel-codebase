<div class="form-group">
    <label for="firstName">{{ __('labels.general.name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="{{ __('labels.general.name') }}" name="name" value="{{ @old('name') ?: @$permission->name }}">
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
<!-- /.card-body -->
