@extends('layouts.reset-layout')

@section('content')
 <div class="container-fluid h-100 overflow-y">
    <div class="row flex-row h-100">
        <div class="col-12 my-auto">
            <div class="password-form mx-auto">
                <div class="logo-centered">
                    <a href="db-default.html">
                        <img src="/img/logo.png" alt="logo">
                    </a>
                </div>

                <h3>{{ __('Reset Password') }}</h3>

                <form method="POST" action="{{ route('password.update') }}" data-toggle="validator" role="form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="group material-input form-group @error('email') has-error has-danger @enderror"">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('E-Mail Address') }}</label>
                       
                        <span class="help-block with-errors" role="alert">
                             @error('email')
                            <strong>{{ $message }}</strong>
                             @enderror
                        </span>
                       
                    </div>

                    <div class="group material-input form-group @error('password') has-error has-danger @enderror"">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('Password') }}</label>
                        
                        <span class="help-block with-errors" role="alert">
                            @error('password')
                            <strong>{{ $message }}</strong>
                             @enderror
                        </span>
                       
                    </div>

                    <div class="group material-input form-group @error('password_confirmation') has-error has-danger @enderror"">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label>{{ __('Confirm Password') }}</label>

                        <span class="help-block with-errors" role="alert">
                             @error('password_confirmation')
                            <strong>{{ $message }}</strong>
                             @enderror
                        </span>
                    </div>

                    <div class="button text-center">
                        <button type="submit" class="btn btn-lg btn-gradient-01">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
