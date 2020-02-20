@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change password</div>
                <div class="card-body">
                    @include('partials.alert')

                    <form action="{{ route('change-password.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="currentPassword">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                id="currentPassword" placeholder="Current password" name="current_password"
                                value="{{ old('current_password') }}" required>
                            @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="newPassword" placeholder="Password" name="password" value="{{ old('password') }}"
                                required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="newPasswordConfirm">Confirm New Password</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="newPasswordConfirm" placeholder="Password" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
