@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile</div>
                <div class="card-body">
                    @include('partials.alert')

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                id="firstName" name="first_name" value="{{ old('first_name', $profile->first_name) }}" required>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                id="lastName" name="last_name" value="{{ old('last_name', $profile->last_name) }}" required>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address', $profile->address) }}">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $profile->phone) }}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control @error('birthday') is-invalid @enderror" id="birthday"
                                name="birthday" value="{{ old('birthday', $profile->birthday) }}">
                            @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="custom-select form-control @error('date') is-invalid @enderror" id="gender"
                                name="gender" value="{{ old('gender', $profile->gender) }}">
                                @foreach (config('model.profile.gender.value') as $gender)
                                    <option value="{{ $gender }}" {{ $profile->gender == $gender ? 'selected' : '' }}>
                                        {{ config('model.profile.gender.text.' . $gender) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror"
                                    id="avatarUpload avatar" name="avatar" onchange="previewAvatar(this)">
                                <label class="custom-file-label" for="avatarUpload">Choose image</label>
                            </div>
                            @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <img src="{{ $profile->avatar }}" alt="Avatar" class="img-thumbnail"
                                        id="avatarPreview">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatarPreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
