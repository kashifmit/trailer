@extends('layouts.login')

@section('content')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <header class="heading">
                    <h3 class="title">
                        {{ __('Reset Password asdk') }}
                    </h3>
                </header>
        
                <div class="content">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
        
                        <input type="hidden" name="token" value="{{ $token }}">
        
                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-radius @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
        
                                @error('email')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-radius @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        
                                @error('password')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form-control-radius" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-min-md">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
