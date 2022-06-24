@extends('arter.master')

@section('content')
    <!-- container -->
    <div class="container-fluid">

        <div class="row pt-8">

            <div class="col shrink-0 grow-0 lg:basis-full">
                @php
                $categories_title = '';
                @endphp
                @foreach ($portfolio->categories as $category)
                @php
                $categories_title .= ___($category, 'title');
                @endphp
                @if(!$loop->last)
                @php
                $categories_title .= ",  ";
                @endphp
                @endif
                @endforeach
                @include('arter.components.section-title', [
                    'title' => ___($portfolio, 'title'),
                    'subtitle' => $portfolio->images->count() ? ___($portfolio, 'subtitle') : null,
                    'titleRight' => $categories_title
                ])
            </div>

            @if ($portfolio->images->count())
            <div class="col shrink-0 grow-0 lg:basis-full">

                <div class="swiper-container art-works-slider">
                    <div class="swiper-wrapper">
                        @foreach ($portfolio->images as $image)
                        <div class="swiper-slide">
                            <a data-fancybox="gallery" data-no-swup href="{{$image->image_url}}"
                                class="art-a art-portfolio-item-frame art-horizontal">
                                <img src="{{$image->image_url}}" alt="item">
                                <span class="art-item-hover"><i class="fas fa-expand"></i></span>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col shrink-0 grow-0 lg:basis-full">
                <div class="art-slider-navigation">
                    <div class="art-sn-left">
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="art-sn-right">
                        <div class="art-slider-nav-frame ltr">
                            <!-- prev -->
                            <div class="art-slider-nav art-works-swiper-prev"><i class="fas fa-chevron-left"></i></div>
                            <!-- next -->
                            <div class="art-slider-nav art-works-swiper-next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

    </div>
    <!-- container end -->

    <!-- container -->
    <div class="container-fluid">

        <div class="row pt-8">

            @if ($portfolio->images->count())
            <div class="col shrink-0 grow-0 lg:basis-full">
                <div class="art-section-title">
                    <div class="art-title-frame">
                        <h3>{{___($portfolio, 'title')}}</h3>
						<h4>{{___($portfolio, 'subtitle')}}</h4>
                    </div>
                </div>
            </div>
            @endif

            @if ($portfolio->description)
            <div class="col shrink-0 grow-0 lg:basis-2/3 lg:max-w-2/3">
                <div class="art-a art-card art-fluid-card">
                    <h5 class="mb-4">@lang('Description')</h5>
                    <div class="mb-4">{!! ___($portfolio, 'description') !!}</div>
                </div>
            </div>
            @endif

            <div class="col shrink-0 grow-0 lg:basis-1/3 lg:max-w-1/3">

                <div class="art-a art-card">
                    <div class="art-table py-4">
                        <ul>
                            @if ($portfolio->order_date)
                            <li>
                                <h6>@lang('Order Date')</h6><span>{{ __date($portfolio->order_date, 'd.m.Y', ['fa' => '%d %B %y']) }}</span>
                            </li>
                            @endif
                            @if ($portfolio->final_date)
                            <li>
                                <h6>@lang('Final Date')</h6><span>{{ __date($portfolio->final_date, 'd.m.Y', ['fa' => '%d %B %y']) }}</span>
                            </li>
                            @endif
                            @if ($portfolio->status)
                            <li>
                                <h6>@lang('Status')</h6><span>{{ ___($portfolio->status, 'title') }}</span>
                            </li>
                            @endif
                            @if ($portfolio->city)
                            <li>
                                <h6>@lang('Location')</h6><span>{{ __($portfolio->city->CountryName()) }}, {{ ___($portfolio->city, 'title') }}</span>
                            </li>
                            @endif
                            @if ($portfolio->client)
                            <li>
                                <h6>@lang('Client')</h6><span>{{ ___($portfolio->client, 'title') }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <!-- row end -->

    </div>
    <!-- container end -->

    @if ($portfolio->testimonials->count())
    <!-- container -->
    @include('arter.sections.testimonials', [
        'title' => __('Client reviews'),
        'testimonials' => $portfolio->testimonials,
        'overflow' => true
    ])
    <!-- container end -->
    @endif

    <!-- container -->
    @include('arter.sections.numbers')
    <!-- container end -->

    <!-- container -->
    @include('arter.sections.contact-banner')
    <!-- container end -->

    <!-- container -->
    <div class="container-fluid">
        <div class="row">
            <div class="col shrink-0 grow-0 lg:basis-full">
                <!-- projects navigation -->
                <div class="art-a art-pagination">
                    <a href="{{ $prevProject ? route('portfolios.show', ['portfolio' => $prevProject, 'slug' => $prevProject->slug]) : '#' }}" @class(['art-link art-color-link art-w-chevron art-left-link', 'pointer-events-none opacity-30' => !$prevProject])><span>@lang('Previous project')</span></a>
                    <div class="art-pagination-center art-m-hidden">
                        <a class="art-link" href="{{ route('portfolios') }}">@lang('All projects')</a>
                    </div>
                    <a href="{{ $nextProject ? route('portfolios.show', ['portfolio' => $nextProject, 'slug' => $nextProject->slug]) : '#' }}" @class(['art-link art-color-link art-w-chevron', 'pointer-events-none opacity-30' => !$nextProject])><span>@lang('Next project')</span></a>
                </div>
                <!-- projects navigation end -->
            </div>
        </div>
    </div>
    <!-- container end -->

@endsection
