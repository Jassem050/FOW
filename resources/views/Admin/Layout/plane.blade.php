<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard :: FreshOnWheel</title>
    <link rel="apple-touch-icon" href="{{ asset('admincss/app-assets/images/ico/apple-icon-120.png') }}" type="image/x-icon" href="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i%7COpen+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/vendors/css/extensions/unslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/vendors/css/weather-icons/climacons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/fonts/meteocons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/vendors/css/charts/morris.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/components.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/core/menu/menu-types/horizontal-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{[ asset('admincss/app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/fonts/simple-line-icons/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/core/colors/palette-gradient.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/pages/timeline.min.css') }}">
    <!-- END: Page CSS-->

    <!-- FontAwesome -->
     <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/fonts/font-awesome/css/fontawesome.min.css') }}">
    <!-- End -->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <!-- Toastr Notificatio -->
    <script type="text/javascript" src="{{ asset('admincss/app-assets/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admincss/app-assets/js/toastr.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('admincss/app-assets/css/toastr.min.css') }}">
    <!-- End -->

    

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="horizontal-layout horizontal-menu 2-columns  " data-open="click" data-menu="horizontal-menu" data-col="2-columns">
<script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
          @endif
    </script>

@yield('body')

    
<!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admincss/app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admincss/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/vendors/js/charts/raphael-min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/vendors/js/charts/morris.min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/vendors/js/extensions/unslider-min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/vendors/js/timeline/horizontal-timeline.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admincss/app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/js/scripts/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admincss/app-assets/js/scripts/ui/breadcrumbs-with-stats.min.js') }}"></script>
    <script src="{{ asset('admincss/app-assets/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
    <!-- END: Page JS-->

  </body>
  <!-- END: Body-->
</html>