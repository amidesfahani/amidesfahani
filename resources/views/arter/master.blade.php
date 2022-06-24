<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{___($user, 'fullname')}}</title>

    <link href="/assets/fonts/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @if (app()->getLocale() == 'fa')
    <link rel="stylesheet" href="/assets/fonts/peyda/font-face.css">
    @endif
</head>

<body class="antialiased" data-theme="dark">

    <!-- app -->
    <div id="app" class="art-app">

        <!-- mobile top bar -->
        <div class="art-mobile-top-bar"></div>

        <!-- app wrapper -->
        <div class="art-app-wrapper">

            <!-- app container -->
            <div class="art-app-container">

                <!-- info bar -->
                @include('arter.layout.sidebar')
                <!-- info bar end -->

                <!-- curtain -->
                <div class="art-content">
                    <!-- curtain -->
                    <div class="art-curtain"></div>
                    
                    <!-- top background -->
                    <div class="art-top-bg" @if (dataFirst($images, 'section-bg', 'image', false)) style="background-image: url({{dataFirst($images, 'section-bg', 'image', false)}})" @endif>
                        <!-- overlay -->
                        <div class="art-top-bg-overlay"></div>
                        <!-- overlay end -->
                    </div>
                    <!-- top background end -->

                    <!-- swup container -->
                    <div class="transition-fade" id="swup">

                        <!-- scroll frame -->
                        <div id="scrollbar" class="art-scroll-frame">

							@yield('content')

                        </div>
                        <!-- scroll framne end -->

                    </div>
                    <!-- swup container end -->
                </div>
                <!-- curtain end -->


                <!-- menu bar -->
                @include('arter.layout.menu')
                <!-- menu bar end -->

            </div>
            <!-- app container end -->

        </div>
        <!-- app wrapper end -->

        <!-- preloader -->
        <div class="art-preloader">
            <div class="art-preloader-content">
                <h4>{{___($user, 'fullname')}}</h4>
                <div id="preloader" class="art-preloader-load"></div>
            </div>
        </div>
        <!-- preloader end -->
    </div>
    <!-- app end -->

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
