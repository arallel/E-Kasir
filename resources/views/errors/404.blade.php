<!DOCTYPE html>
<html>

<head>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Page Title  -->
    <title>@yield('title')</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('./assets/css/dashlite.css?ver=3.1.1') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('./assets/css/theme.css?ver=3.1.1') }}">
</head>

<body class="nk-body bg-white npc-default pg-error">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle wide-md mx-auto">
                        <div class="nk-block-content nk-error-ld text-center">
                            <img class="nk-error-gfx" src="{{ asset('./assets/images/gfx/error-404.svg') }}" alt="">
                            <div class="wide-xs mx-auto">
                                <h3 class="nk-error-title">Halaman Tidak Ada</h3>
                                <p class="nk-error-text">Halaman Yang Dicari Tidak Ada Atau Halaman Yang Di akses Hanya Untuk Yang Berkepentingan</p>
                                <a href="{{ route('dashboard') }}" class="btn btn-lg btn-primary mt-2">Kembali Ke Halaman Utama</a>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.1.1"></script>
    <script src="./assets/js/scripts.js?ver=3.1.1"></script>
</html>