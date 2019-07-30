@extends('layouts.reset-layout')

@section('content')
        <!-- End Preloader -->
        <!-- Begin Container -->
        <div class="container-fluid h-100 overflow-y">
            <div class="row flex-row h-100">
                <div class="col-12 my-auto">
                    <div class="password-form mx-auto">
                        <div class="logo-centered">
                            <a href="db-default.html">
                                <img src="/img/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Password Recovery</h3>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="group material-input">
                                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="button text-center">
                                <button type="submit" class="btn btn-lg btn-gradient-01">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                        <div class="back">
                            <a href="/login">Sign In</a>
                        </div>

                    </div>        
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>  
@stop
        