<!-- container -->
<div class="container-fluid">

    <div class="row lg:justify-center lg:items-center pt-8">

        @if (dataFirst($numbers, 'Experience'))    
        <div class="col max-w-half shrink-0 grow-0 basis-1/2 lg:basis-1/4 lg:max-w-1/4">
            <div class="art-counter-frame">
                <div class="art-counter-box">
                    <span class="art-counter">{{dataFirst($numbers, 'Experience')}}</span><span class="art-counter-plus">+</span>
                </div>
                <h6>@lang('Years Experience')</h6>
            </div>
        </div>
        @endif

        @if (dataFirst($numbers, 'Projects'))    
        <div class="relative w-full px-4 max-w-half shrink-0 grow-0 basis-1/2 lg:basis-1/4 lg:max-w-1/4">
            <div class="art-counter-frame">
                <div class="art-counter-box">
                    <span class="art-counter">{{dataFirst($numbers, 'Projects')}}</span>
                </div>
                <h6>@lang('Completed Projects')</h6>
            </div>
        </div>
        @endif

        @if (dataFirst($numbers, 'HappyCustomers'))    
        <div class="relative w-full px-4 max-w-half shrink-0 grow-0 basis-1/2 lg:basis-1/4 lg:max-w-1/4">
            <div class="art-counter-frame">
                <div class="art-counter-box">
                    <span class="art-counter">{{dataFirst($numbers, 'HappyCustomers')}}</span>
                </div>
                <h6>@lang('Happy Customers')</h6>
            </div>
        </div>
        @endif

        @if (dataFirst($numbers, 'Awards'))
        <div class="relative w-full px-4 max-w-half shrink-0 grow-0 basis-1/2 lg:basis-1/4 lg:max-w-1/4">
            <div class="art-counter-frame">
                <div class="art-counter-box">
                    <span class="art-counter">{{dataFirst($numbers, 'Awards')}}</span>
                </div>
                <h6>@lang('Awards')</h6>
            </div>
        </div>
        @endif

    </div>

</div>
<!-- container end -->