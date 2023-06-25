<!DOCTYPE html>
<html>

<head>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Parallel">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Page Title  -->
    <title>@yield('title')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('./assets/css/dashlite.css?ver=3.1.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('./assets/css/theme.css?ver=3.1.1') }}">
</head>

<body class="nk-body bg-lighter npc-default has-sidebar ui-clean">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @include('admin.layout.component.sidebar')
            <!-- wrap @s -->
            <div class="nk-wrap ">
               @include('admin.layout.component.header')
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            @include('admin.layout.component.footer')
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
     <!-- FontAwesome Icons --> 
    <link rel="stylesheet" type="text/css" href="{{ asset('./assets/css/libs/fontawesome-icons.css') }}"> 
    <script src="{{ asset('./assets/js/bundle.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('./assets/js/scripts.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('./assets/js/charts/chart-ecommerce.js?ver=3.1.1') }}"></script>
    <script src="{{ asset('assets/js/datadashboard.js') }}"></script>
</body>
</html>