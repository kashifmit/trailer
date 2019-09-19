@extends('layouts.login')

@section('content')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                <header class="header">
                    <h3 class="title">
                        {{ __('Account Support') }}
                    </h3>
                </header>
        
                <div class="content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
        
                        <div class="form-group row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-radius @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                @error('email')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <p class="mt-4 mb-0">Type in the email address you used when you created your account to receive assistance in recovering your password</p>

                            </div>
                        </div>
        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-min-md">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
