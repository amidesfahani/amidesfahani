@if (isset($brands) && $brands->count())
<!-- container -->
<div class="container-fluid mb-8">
    <div class="row">
        <div class="col lg:grow-0 lg:shrink-0 lg:basis-full">
            <div class="swiper-container art-brands-slider w-full">
                <div class="swiper-wrapper">
                    @foreach ($brands as $brand)
                    <div class="swiper-slide">
                        <img class="art-brand" src="{{$brand->image}}" alt="{{$brand->title}}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- container end -->
@endif