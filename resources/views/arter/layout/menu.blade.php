<!-- menu bar -->
<div class="art-menu-bar">

    <div class="art-menu-bar-frame">

        <!-- menu bar header -->
        <div class="art-menu-bar-header">
            <div class="art-menu-bar-btn">
                <!-- icon -->
                <span></span>
            </div>
        </div>
        <!-- menu bar header end -->

        <!-- current page title -->
        <div class="art-current-page"></div>
        <!-- current page title end -->

        <div class="art-scroll-frame">

            <nav id="swupMenu">
                <ul class="main-menu">
                    <li @class(['menu-item', 'current-menu-item' => Route::is('home')])><a href="{{ route('home') }}">@lang('Home')</a></li>
                    <li @class(['menu-item', 'current-menu-item' => Route::is('portfolios') || Route::is('portfolios.show')])><a href="{{ route('portfolios') }}">@lang('Portfolio')</a></li>
                    <li @class(['menu-item', 'current-menu-item' => Route::is('history')])><a href="{{ route('history') }}">@lang('History')</a></li>
                    <li @class(['menu-item', 'current-menu-item' => Route::is('contact')])><a href="{{ route('contact') }}">@lang('Contact')</a></li>
                    <li @class(['menu-item', 'hidden', 'current-menu-item' => Route::is('blog')])><a href="{{ route('blog') }}" data-no-swup>@lang('Blog')</a></li>
                </ul>
            </nav>

            @php
                $route = Route::getCurrentRoute();
                $routeName = $route->getName();
                $routeParameters = $route->parameters;
            @endphp
            <ul class="art-language-change font-sans">
                <li @class(['art-active-lang' => app()->getLocale() == 'fa'])><a data-no-swup href="{{ route($routeName, array_merge($routeParameters, ['lang' => 'fa'])) }}">IR</a></li>
                <li @class(['art-active-lang' => app()->getLocale() == 'en'])><a data-no-swup href="{{ route($routeName, array_merge($routeParameters, ['lang' => 'en'])) }}">EN</a></li>
            </ul>

        </div>

    </div>

</div>
<!-- menu bar end -->
