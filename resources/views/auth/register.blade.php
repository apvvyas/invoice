@extends('layouts.auth')

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
                                <li><a href="/login" id="singin-tab" >Sign In</a></li>
                                <li><a href="/register" class="active" id="signup-tab" >Sign Up</a></li>
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


                            <!-- Begin Sign Up -->
                            <div role="tabpanel" class="tab-pane show active" id="signup" aria-labelledby="signup-tab">
                                <h3>Create An Account</h3>

                                @include('layouts.sections.alerts')

                                <form method="POST" action="{{ route('register') }}" data-toggle="validator" role="form">
                                    @csrf
                                    <div class="group material-input form-group">
                                        <input id="name" type="text" class="@error('name') has-error has-danger @enderror form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Name</label>
                                       
                                            <span class=" help-block with-errors" role="alert">
                                            @error('name')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                            </span>
                                        
                                    </div>
                                    <div class="group material-input form-group">
                                        <input id="email" type="email"  class=" @error('email') has-error has-danger @enderror form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email</label>
                                        
                                            <span class="help-block with-errors" role="alert">
                                            @error('email')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                            </span>
                                    </div>
                                    <div class="group material-input form-group">
                                        <input id="phone" type="tel" class=" @error('phone') has-error has-danger @enderror form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" data-minlength="10" data-maxlength="15" pattern="[0-9]{10,15}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Phone</label>
                                            <span class="help-block with-errors" role="alert">
                                            @error('phone')
                                                <strong>{{ $message }}</strong>
                                            @enderror
                                            </span>
                                    </div>
                                    <div class="group material-input form-group">
                                        <input id="password" type="password" class="@error('password') has-error has-danger @enderror form-control" name="password" required autocomplete="new-password">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Password</label>
                                        
                                            <span class="help-block with-errors" role="alert">
                                            @error('password')
                                                <strong>{{ $message }}</strong>
                                            @enderror   
                                            </span>
                                        
                                    </div>
                                    <div class="group material-input form-group">
                                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" data-match="#password">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Confirm Password</label>

                                        <span class="help-block with-errors" role="alert">
                                            @error('password')
                                                <strong>{{ $message }}</strong>
                                            @enderror   
                                            </span>
                                    </div>
                               
                                    <div class="row">
                                        <div class="col text-left">
                                            <div class="styled-checkbox">
                                                <input type="checkbox" name="checkbox" id="agree">
                                                <label for="agree">I Accept <a href="#">Terms and Conditions</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sign-btn text-center">
                                        <button class="btn btn-lg btn-gradient-01">
                                            Sign Up
                                        </button>
                                    </div>
                                 </form>
                            </div>
                            <!-- End Sign Up -->
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