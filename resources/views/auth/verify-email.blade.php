@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $isRegistration ? __('Complete Registration') : __('Login Verification') }}
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="alert alert-info" role="alert">
                        @if($isRegistration)
                            Please enter the verification code sent to your email to complete your registration.
                        @else
                            Please enter the verification code sent to your email to complete login.
                        @endif
                    </div>

                    <form method="POST" action="{{ route('verification.verify') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $email) }}" required readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="otp" class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>

                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror"
                                    name="otp" value="{{ old('otp') }}" required autofocus
                                    placeholder="Enter 6-digit code">

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <small class="form-text text-muted">
                                    Please check your email for the verification code.
                                </small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $isRegistration ? __('Complete Registration') : __('Verify and Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('verification.resend') }}"
                                    onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                                    {{ __('Resend Code') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    <form id="resend-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', $email) }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
