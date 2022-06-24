@extends('arter.master')

@section('content')
    <!-- container -->
    <div class="container-fluid">

        <div class="row pt-8">

            <div class="col lg:basis-full lg:shrink-0 lg:grow-0">
                @include('arter.components.section-title', ['title' => __('Contact information')])
            </div>

            <div class="col basis-full shrink-0 grow-0 xl:basis-1/3 xl:max-w-1/3">
                <div class="art-a art-card">
                    <div class="art-table py-4">
                        <ul class="mb-0">
                            <li>
                                <h6>@lang('Email')</h6>
                                <span class="inline-block ltr">
                                    {{ $links->where('slug', 'yahoo')->first()->account }}
                                </span>
                            </li>
                            <li>
                                <h6>@lang('Mobile')</h6>
                                <span class="inline-block ltr">
                                    {{ \App\Helpers\FarsiHelper::formatPhone($links->where('slug', 'mobile')->first()->account) }}
                                </span>
                            </li>
                            <li>
                                <h6>@lang('Whatsapp')</h6>
                                <span class="inline-block ltr">
                                    <a href="{{ $links->where('slug', 'whatsapp')->first()->url }}">
                                        {{ \App\Helpers\FarsiHelper::formatPhone($links->where('slug', 'whatsapp')->first()->account) }}
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col basis-full shrink-0 grow-0 xl:basis-1/3 xl:max-w-1/3">
                <div class="art-a art-card">
                    <div class="art-table py-4">
                        <ul class="mb-0">
                            <li>
                                <span class="art-card-icon">
                                    @if ($links->where('slug', 'github')->first()->svg)
                                        {!! $links->where('slug', 'github')->first()->svg !!}
                                    @else
                                        <i class="fas {{ $links->where('slug', 'github')->first()->icon }}"></i>
                                    @endif
                                </span>
                                <span class="inline-block ltr">
                                    <a href="{{ $links->where('slug', 'github')->first()->url }}">
                                        @lang('Github')
                                    </a>
                                </span>
                            </li>
                            <li>
                                <span class="art-card-icon">
                                    @if ($links->where('slug', 'stack-overflow')->first()->svg)
                                        {!! $links->where('slug', 'stack-overflow')->first()->svg !!}
                                    @else
                                        <i class="fas {{ $links->where('slug', 'stack-overflow')->first()->icon }}"></i>
                                    @endif
                                </span>
                                <span class="inline-block ltr">
                                    <a href="{{ $links->where('slug', 'stack-overflow')->first()->url }}">
                                        @lang('Stackoverflow')
                                    </a>
                                </span>
                            </li>

                            <li>
                                <span class="art-card-icon">
                                    @if ($links->where('slug', 'instagram')->first()->svg)
                                        {!! $links->where('slug', 'instagram')->first()->svg !!}
                                    @else
                                        <i class="fas {{ $links->where('slug', 'instagram')->first()->icon }}"></i>
                                    @endif
                                </span>
                                <span class="inline-block ltr">
                                    <a href="{{ $links->where('slug', 'instagram')->first()->url }}">
                                        @lang('Instagram')
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- col -->
            <div class="col lg:basis-full lg:shrink-0 lg:grow-0">

                @include('arter.components.section-title', ['title' => __('Get in touch')])

                <div class="art-a art-card">

                    <form id="contact-form" class="art-contact-form">
                        <div class="art-form-field">
                            <input id="name" name="name" class="art-input" type="text" placeholder="@lang('Name')" required>
                            <label for="name"><i class="fas fa-user"></i></label>
                        </div>
                        <div class="art-form-field">
                            <input id="email" name="email" class="art-input" type="email" placeholder="@lang('Email')" required>
                            <label for="email"><i class="fas fa-at"></i></label>
                        </div>
                        <div class="art-form-field">
                            <textarea id="message" name="text" class="art-input" placeholder="@lang('Message')" required></textarea>
                            <label for="message"><i class="far fa-envelope"></i></label>
                        </div>
                        <div class="art-submit-frame">
                            <button class="art-btn art-btn-md art-submit" type="submit"><span>@lang('Send message')</span></button>
                            <div class="art-success">@lang('Done') <i class="fas fa-check"></i></div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
    <!-- container end -->
@endsection
