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
        <script src="http://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Montserrat:400,500,600,700","Noto+Sans:400,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{url('img/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{url('img/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{url('img/favicon-16x16.png')}}">
        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{url('vendors/css/base/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{url('vendors/css/base/elisyam-1.5.min.css')}}">

        <link rel="stylesheet" href="{{url('css/app.css')}}">
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    </head>
    <body id="page-top">


    	<div class="page">
    		<div class="page-content d-flex align-items-stretch">

    			<div class="content-inner">
                    <!-- Begin Container -->
                    <div class="container-fluid calendar">
                    	@yield('content')
                	</div>

                </div>

            </div>
        
        </div>

        <script src="{{url('vendors/js/base/jquery.min.js')}}"></script>
        <script src="{{url('js/app.js')}}"></script>
        <script src="{{url('vendors/js/base/core.min.js')}}"></script>
        
        
        <!-- End Vendor Js -->

        <!-- Begin Page Vendor Js -->
        <script src="{{url('vendors/js/nicescroll/nicescroll.min.js')}}"></script>
        <script src="{{url('vendors/js/calendar/moment.min.js')}}"></script>
        
        <script src="{{url('vendors/js/app/app.min.js')}}"></script>
        <!-- End Page Vendor Js -->
        
        <!-- Begin Page Snippets -->
       
        
        <!-- End Page Snippets -->
    </body>
</html>