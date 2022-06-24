@if (isset($testimonials) && $testimonials->count())
<!-- container -->
<div class="container-fluid">

    <div class="row">

        <div class="col shrink-0 grow-0 lg:basis-full">
            @include('arter.components.section-title', ['title' => isset($title) ? $title : __('Recommendations')])
        </div>

        <div class="col shrink-0 grow-0 lg:basis-full">

            <!-- slider container -->
            <div @class(['swiper-container art-testimonial-slider', 'overflow-visible' => isset($overflow) && $overflow])>
                <!-- slider wrapper -->
                <div class="swiper-wrapper">
					@foreach ($testimonials as $testimonial)
					 <div class="swiper-slide">
                        <div class="art-a art-testimonial">
                            @include('arter.components.testimonial')
                        </div>
                    </div>
					@endforeach
                </div>
                <!-- slider wrapper end -->
            </div>
            <!-- slider container end -->

        </div>

        <div class="col shrink-0 grow-0 lg:basis-full mb-8">
            <!-- slider navigation -->
            <div class="art-slider-navigation">
                <div class="art-sn-left">
                    <div class="swiper-pagination"></div>
                </div>
                <div class="art-sn-right">
                    <div class="art-slider-nav-frame ltr">
                        <!-- prev -->
                        <div class="art-slider-nav art-testi-swiper-prev"><i class="fas fa-chevron-left"></i></div>
                        <!-- next -->
                        <div class="art-slider-nav art-testi-swiper-next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>
            </div>
            <!-- slider navigation end -->
        </div>

    </div>

</div>
<!-- container end -->
@endif