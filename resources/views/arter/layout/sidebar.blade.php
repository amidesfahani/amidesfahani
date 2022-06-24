<!-- info bar -->
<div class="art-info-bar">

    <!-- info bar frame -->
    <div class="art-info-bar-frame">

        <!-- info bar header -->
        <div class="art-info-bar-header">
            <div class="art-info-bar-btn">
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>
        <!-- info bar header end -->

        <!-- info bar header -->
        <div @class(['art-header', 'art-avatar-exists' => isset($user->avatar)])>
            @if ($user->avatar)
            <div class="art-avatar">
                <a data-fancybox="avatar" data-no-swup="" href="{{$user->avatar_url}}" class="art-avatar-curtain">
                    <img src="{{$user->avatar_url}}" alt="{{$user->fullname}}">
                    <i class="fas fa-expand"></i>
                </a>
                <div class="art-lamp-light">
                    @if ($user->available)
                    <div class="art-available-lamp"></div>
                    @else
                    <div class="art-available-lamp art-not-available"></div>
                    @endif
                </div>
            </div>
            @endif

            <h1 class="art-name mb-3"><a href="{{ route('home') }}">{{___($user, 'fullname')}}</a></h1>

            <div class="art-sm-text art-user-titles">
				@foreach ($titles as $title)
				<span>{{___($title, 'title')}}</span>
				@if($loop->first) <br> @endif
                @if(!$loop->first && !$loop->last) ,  @endif
				@endforeach
			</div>
        </div>
        <!-- info bar header end -->

        <!-- scroll frame -->
        @include('arter.layout.sideframe')
        <!-- scroll frame end -->

        <!-- sidebar social -->
        <div class="art-ls-social">
			@foreach ($links as $link)
				@if ($link->icon && $link->url)
				<a href="{{$link->url}}" target="_blank" data-no-swup><i class="fab {{$link->icon}}"></i></a>
				@endif
			@endforeach
        </div>
        <!-- sidebar social end -->

    </div>
</div>
<!-- info bar end -->
