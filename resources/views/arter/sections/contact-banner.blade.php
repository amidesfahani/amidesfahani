<!-- container -->
<div class="container-fluid">

    <div class="row">

        <div class="col shrink-0 grow-0 lg:basis-full">

            <!-- call to action -->
            <div class="art-a art-banner" @if (dataFirst($images, 'banner-bg', 'image', false)) style="background-image: url({{dataFirst($images, 'banner-bg', 'image', false)}})" @endif>
                <div class="art-banner-overlay">
                    <div class="art-banner-title text-center">
                        <h1 class="mb-4">{{dataFirst($strings, 'txt-contact-banner-title')}}</h1>
                        <div class="art-lg-text art-code mb-6">{{dataFirst($strings, 'txt-contact-banner-body')}}</div>
                        <a href="{{ route('contact') }}" class="art-btn art-btn-md"><span>@lang('Contact me')</span></a>
                    </div>
                </div>
            </div>
            <!-- call to action end  -->

        </div>

    </div>

</div>
<!-- container end -->
