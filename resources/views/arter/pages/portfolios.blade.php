@extends('arter.master')

@section('content')
<!-- container -->
<div class="container-fluid">

    <div class="row pt-8">

        <div class="col shrink-0 grow-0 lg:basis-full">

            <!-- filter -->
            <div class="art-filter mb-8">
                <a href="#" data-filter="*" class="art-link art-current">@lang('All Categories')</a>
                @foreach ($portfolios->pluck('categories')->collapse()->unique('id') as $category)
                    <a href="#" data-filter=".{{$category->slug}}" class="art-link">{{___($category, 'title')}}</a>
                @endforeach
            </div>
            <!-- filter end -->

        </div>

        <div class="art-grid art-grid-3-col art-gallery">

            @foreach ($portfolios as $portfolio)
            <div class="art-grid-item {{$portfolio->categories->pluck('slug')->join(' ')}}">
                <div @class([
                    'art-grid-item-wrap' => true,
                    'art-grid-item-no-image' => !$portfolio->image_url,
                ])>
                    @if ($portfolio->image_url)
                    <a class="art-a art-portfolio-item-frame art-horizontal" data-no-swup href="{{ route('portfolios.show', ['portfolio' => $portfolio->id, 'slug' => $portfolio->slug]) }}">
                        <img src="{{$portfolio->image_url}}" alt="item">
                        {{-- <span class="art-item-hover"><i class="fas fa-expand"></i></span> --}}
                    </a>
                    @endif
                    <div class="art-item-description">
                        <h5 class="mb-4">{{___($portfolio, 'title')}}</h5>
                        <div class="mb-4">{{___($portfolio, 'about')}}</div>
                        <a href="{{ route('portfolios.show', ['portfolio' => $portfolio->id, 'slug' => $portfolio->slug]) }}" class="art-link art-color-link art-w-chevron">@lang('Read more')</a>
                    </div>
                </div>
            </div>
			@endforeach

        </div>

    </div>

</div>
<!-- container end -->

@endsection