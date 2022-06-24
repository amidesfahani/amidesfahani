@if (isset($services) && $services->count())

<!-- container -->
<div class="container-fluid">

    <div class="row">

        <div class="col grow-0 shrink-0 lg:basis-full">
            @include('arter.components.section-title', ['title' => __('My Services')])
        </div>

        @foreach ($services as $service)
		<div class="col grow-0 shrink-0 basis-full md:basis-1/2 lg:basis-1/3 md:max-w-1/2 lg:max-w-1/3">
            <div class="art-a art-service-icon-box">
                <div class="art-service-ib-content">
                    <h5 class="mb-4">{{$service->title}}</h5>
                    <div class="leading-loose">
                    {{\Illuminate\Support\Str::limit($service->description, 145, $end='...')}}
                    </div>
                    @if (mb_strlen($service->description) > 145)
                    <div class="art-buttons-frame mt-4">
						<a data-fancybox="services" data-no-swup href="#art-service-popup-{{ $service->id }}" class="art-link art-color-link art-w-chevron">@lang('Read more')</a>
					</div>
                    @endif
                </div>
            </div>

            @if (mb_strlen($service->description) > 145)
            <div class="art-popup hidden" id="art-service-popup-{{ $service->id }}">
                <div class="art-a art-service-icon-box">
                    <div class="art-service-ib-content">
                        <h5 class="mb-4">{{ $service->title }}</h5>
                        <div class="leading-loose">{{ $service->description }}</div>
                    </div>
                </div>
            </div>
            @endif
        </div>
		@endforeach

    </div>

</div>
<!-- container end -->
@endif