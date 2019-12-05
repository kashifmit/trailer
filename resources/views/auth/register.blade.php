@extends('layouts.login')

@section('content')
    <div class="page">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <header class="heading">
                    <h3 class="title mb-2">{{ __('Welcome!') }}</h3>
                    <h5 class="title">{{ __('Account Email / Username and Password') }}</h5>
                </header>
                @include('flash::message')
                <div class="content">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        
                            <div class="col-md-7 col-xl-6">
                                <input id="email" type="email" class="form-control form-control-radius @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                @error('email')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror

                                <p class="mt-4 mb-1">Your email address is your username</p>
                            </div>
                        </div>
        
                        <div class="form-group row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        
                            <div class="col-md-7 col-xl-6">
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
        
                        <div class="form-group row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        
                            <div class="col-md-7 col-xl-6">
                                <input id="password-confirm" type="password" class="form-control form-control-radius" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <header class="heading">
                            <h3 class="title mb-2">{{ __('Personal Information') }}</h3>
                        </header>

                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
        
                            <div class="col-md-7 col-xl-6">
                                <input id="name" type="text" class="form-control form-control-radius @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
        
                                @error('name')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
        
                            <div class="col-md-7 col-xl-6">
                                <input id="name" type="text" class="form-control form-control-radius @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>
                                @error('last_name')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Organization') }}</label>
        
                            <div class="col-md-7 col-xl-6">
                                {!! Form::select('organization', ['' => 'Select Organization']+App\Helpers\DataArrayHelper::getOrganizations(), null, array('class'=>'form-control form-control-radius', 'id'=>'organization')) !!}
                                @error('organization')
                                    <p class="mt-4">
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-min-md">
                                    {{ __('Create Account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
