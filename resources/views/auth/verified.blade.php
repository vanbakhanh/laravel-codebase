@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Congratulations!') }}</div>

                <div class="card-body">
                    <p class="card-text">{{ __('Your account has been verified.') }}</p>

                    @auth
                        <a href="/" class="btn btn-primary">{{ __('Go home') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Login') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
