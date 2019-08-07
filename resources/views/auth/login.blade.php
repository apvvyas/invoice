@extends('layouts.auth')

@push('snippets')
    <script src="/js/pages/auth-login.js"></script>
@endpush

@section('content')

        <!-- Begin Container -->
        <div class="container-fluid no-padding h-100">
            <div class="row flex-row h-100 bg-white">
                <!-- Begin Left Content -->
                <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12 no-padding">
                    <div class="elisyam-bg background-03">
                        <div class="elisyam-overlay overlay-08"></div>
                        <div class="authentication-col-content-2 mx-auto text-center">
                            <div class="logo-centered">
                                <a href="db-default.html">
                                    <img src="img/logo.png" alt="logo">
                                </a>
                            </div>
                            <h1>Join Our Community</h1>
                            <span class="description">
                                Etiam consequat urna at magna bibendum, in tempor arcu fermentum vitae mi massa egestas. 
                            </span>
                            <ul class="login-nav nav-tabs mt-5 justify-content-center">
                                <li><a class="active" href="/login" id="singin-tab" >Sign In</a></li>
                                <li><a href="/register" id="signup-tab" >Sign Up</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Left Content -->
                <!-- Begin Right Content -->
                <div class="col-xl-9 col-lg-7 col-md-7 col-sm-12 col-12 my-auto no-padding">
                    <!-- Begin Form -->
                    <div class="authentication-form-2 mx-auto">
                        <div class="tab-content" id="animate-tab-content">



                            <!-- Begin Sign In -->
                            <div role="tabpanel" class="tab-pane show active" id="singin" aria-labelledby="singin-tab">

                                <h3>Sign In To Invoice</h3>

                                 @include('layouts.sections.alerts')

                                <form method="POST" action="{{ route('login') }}" data-toggle="validator" role="form">
                                    @csrf
                                    <input type="hidden" name="timezone" value="">
                                    <div class="group material-input form-group @error('email') has-error has-danger @enderror">
                                        <input id="email" type="text" class="" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email or Phone Number</label>
                                        <span class="help-block with-errors" role="alert">
                                        
                                        </span>
                                    </div>
                                    <div class="group material-input form-group @error('password') has-error has-danger @enderror">
                                        <input id="password" type="password" class="@error('password') has-error has-danger @enderror" name="password" required autocomplete="current-password">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Password</label>
                                        <span class="help-block with-errors" role="alert">
                                        @error('password')
                                        <ul class="list-unstyled">
                                            <li>
                                                <strong>{{ $message }}</strong>
                                            </li>
                                        </ul>
                                        @enderror
                                        </span>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col text-left">
                                            <div class="styled-checkbox">
                                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember"> {{ __('Remember Me') }}</label>
                                            </div>
                                        </div>
                                         @if (Route::has('password.request'))
                                        <div class="col text-right">
                                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="sign-btn text-center">
                                        <button class="btn btn-lg btn-gradient-01">
                                            Sign In
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- End Sign In -->
                        </div>
                    </div>
                    <!-- End Form -->                        
                </div>
                <!-- End Right Content -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->    
@stop