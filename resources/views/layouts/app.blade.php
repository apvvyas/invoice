<!DOCTYPE html>
<!--
Item Name: Elisyam - Web App & Admin Dashboard Template
Version: 1.5
Author: SAEROX

** A license must be purchased in order to legally use this template for your project **
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Google Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="/vendors/css/base/bootstrap.min.css">
        <link rel="stylesheet" href="/vendors/css/base/elisyam-1.5.min.css">
        <link rel="stylesheet" href="/css/animate/animate.min.css">

        @stack('css')

        <link rel="stylesheet" href="/css/app.css">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">
        <!-- Begin Preloader -->
        <div id="preloader">
            <div class="canvas">
                <img src="/img/logo.png" alt="logo" class="loader-logo">
                <div class="spinner"></div>   
            </div>
        </div>
        <!-- End Preloader -->
        

        <div class="page">

            @include('layouts.sections.header')

            <div class="page-content d-flex align-items-stretch">

                @include('layouts.sections.sidebar')

                <div class="content-inner">
                    <!-- Begin Container -->
                    <div class="container-fluid calendar">

                        @yield('content')

                    </div>

                    @include('layouts.sections.footer')

                    @include('layouts.sections.rsidebar')
                </div>

            </div>
        
        </div>

        @stack('modal')


        

        @routes

        <!-- Begin Vendor Js -->
        <script src="/vendors/js/base/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        
        @stack('datatable-js')
        
        <script src="/vendors/js/base/core.min.js"></script>
        <script src="/vendors/js/b4alert/boot4alert.min.js"></script>
        <script src="/js/bootstrap.js"></script>
        @stack('vendor-js')
        
        <!-- End Vendor Js -->

        <!-- Begin Page Vendor Js -->
        <script src="/vendors/js/nicescroll/nicescroll.min.js"></script>
        <script src="/vendors/js/noty/noty.min.js" type="text/javascript"></script>
        <script src="/vendors/js/calendar/moment.min.js"></script>
        
        @stack('page-vendor-js')
        
        <script src="/vendors/js/app/app.min.js"></script>
        
        <!-- End Page Vendor Js -->
        
        <!-- Begin Page Snippets -->
        
        @stack('snippets')
        
        <!-- End Page Snippets -->
    </body>
</html>