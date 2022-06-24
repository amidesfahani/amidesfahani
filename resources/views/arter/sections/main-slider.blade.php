<!-- container -->
<div class="container-fluid">

    <!-- row -->
    <div class="row pt-4 md:pt-8 xl:pt-15">
        <!-- col -->
        <div class="col md:flex md:flex-col md:basis-full md:max-w-full">

            <!-- banner -->
            <div class="art-a art-banner" @if (dataFirst($images, 'banner-bg', 'image', false)) style="background-image: url({{dataFirst($images, 'banner-bg', 'image', false)}})" @endif>
                <!-- banner back -->
                <div class="art-banner-back"></div>
                <!-- banner dec -->
                <div class="art-banner-dec"></div>
                <!-- banner overlay -->
                <div class="art-banner-overlay">
                    <!-- main title -->
                    <div class="art-banner-title">
                        <!-- title -->
                        <h1 class="mb-4">
							{{dataFirst($strings, 'art-title')}}
							<br>{{dataFirst($strings, 'art-subtitle')}}
						</h1>
                        <!-- suptitle -->
                        <div class="art-lg-text art-code mb-6 lg:flex lg:justify-start lg:items-center">
                            <span class="ltr">&lt;<i>code</i>&gt; </span>
                            @if (dataFirst($strings, 'txt-rotate-title'))
                            <span class="mx-1">{{dataFirst($strings, 'txt-rotate-title')}} </span>
                            @endif
                            <span class="txt-rotate mx-1" data-period="2000" data-speed="7" data-rotate='{{_d($strings, 'txt-rotate', true, 'value', true)}}'></span>
                            <span class="ltr">&lt;/<i>code</i>&gt;</span>
                        </div>
                        <div class="art-buttons-frame">
                            <a href="{{ route('portfolios') }}" class="art-btn art-btn-md"><span>@lang('Explore now')</span></a>
                        </div>
                    </div>
                    <!-- main title end -->
                    @if ($images->where('key', 'banner-me')->first())
                    <img src="{{$images->where('key', 'banner-me')->first()->image}}" class="art-banner-photo" alt="{{$user->fullname}}">
					@endif
                </div>
                <!-- banner overlay end -->
            </div>
            <!-- banner end -->

        </div>
        <!-- col end -->
    </div>
    <!-- row end -->

</div>
<!-- container end -->