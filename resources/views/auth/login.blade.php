@extends('layouts.login')

@section('content')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <header class="heading">
                    <h2 class="title">{{ __('Welcome!') }}</h2>
                </header>
        
                <div class="content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
        
                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('USERNAME') }}</label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-radius @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                @error('email')
                                    <p class="mb-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('PASSWORD') }}</label>
        
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-radius @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                @error('password')
                                    <p class="mb-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <p class="mb-4">
                                    @if (Route::has('password.request'))
                                        <a class="text-primary text-underline" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-primary mb-4">
                                    {{ __('Login') }}
                                </button>
                                <p class="mb-4">Or if you are new, please</p>

                                <a class="btn btn-primary" href="{{ route('register') }}">
                                    <span>{{ __('Create a New Account') }}</span>
                                </a>
                                
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
