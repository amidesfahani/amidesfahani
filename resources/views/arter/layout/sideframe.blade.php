<!-- scroll frame -->
<div id="scrollbar2" @class(['art-scroll-frame', 'art-avatar-exists' => isset($user->avatar)])>

    <!-- info bar about -->
    <div class="art-table py-4">
        <ul>
            <li>
                <h6>@lang('Residence')</h6><span>{{___($user->profile, 'country')}}</span>
            </li>
            <li>
                <h6>@lang('City'):</h6><span>{{___($user->profile, 'city')}}</span>
            </li>
            <li>
                <h6>@lang('Age'):</h6><span>{{$user->age}}</span>
            </li>
        </ul>
    </div>
    <!-- info bar about end -->

    <div class="art-ls-divider"></div>

    <!-- language skills -->
    <div class="art-lang-skills pt-8 pb-4">

        @foreach ($languages as $language)
        <div class="art-lang-skills-item">
            <div class="art-cirkle-progress" data-value="{{$language->power}}"></div>
            <h6>{{ ___($language, 'title') }}</h6>
        </div>
		@endforeach

    </div>
    <!-- language skills end -->

    <div class="art-ls-divider"></div>

    <!-- hard skills -->
    <div class="art-hard-skills pt-8 pb-4">

    @foreach ($skills as $key => $skills)
        <div class="art-skills-icons">
            @foreach ($skills as $skill)
            <div class="icon">
                <img src="{{$skill->image_url}}" alt="{{$skill->title}}">
            </div>
            @endforeach
        </div>
    @endforeach

    {{-- <picture title="Moby-Logo" class="wp-image-32612">
    <source type="image/webp" data-lazy-srcset="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png.webp 601w, https://www.docker.com/wp-content/uploads/2022/03/Moby-logo-480x344.png.webp 480w" srcset="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png.webp 601w, https://www.docker.com/wp-content/uploads/2022/03/Moby-logo-480x344.png.webp 480w" data-lazy-sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 601px, 100vw" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 601px, 100vw">
    <img src="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png" alt="Moby logo" data-lazy-srcset="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png 601w, https://www.docker.com/wp-content/uploads/2022/03/Moby-logo-480x344.png 480w" data-lazy-sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 601px, 100vw" data-lazy-src="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png" data-ll-status="loaded" class="entered lazyloaded" sizes="(min-width: 0px) and (max-width: 480px) 480px, (min-width: 481px) 601px, 100vw" srcset="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png 601w, https://www.docker.com/wp-content/uploads/2022/03/Moby-logo-480x344.png 480w" width="601" height="431">
    </picture> --}}

    </div>
    <!-- hard skills end -->

    <div class="art-ls-divider"></div>

    <!-- knowledge list -->
    <ul class="art-knowledge-list mb-4 pt-4 pb-0">
        @foreach ($extra_skills as $skill)
		<li>{{ ___($skill, 'title') }}</li>
		@endforeach
    </ul>
    <!-- knowledge list end -->

    {{-- <div class="art-ls-divider"></div>

    <!-- links frame -->
    <div class="art-links-frame py-4 hidden">
        <a href="files/cv.txt" class="art-link" download data-no-swup>@lang('Download cv') <i class="fas fa-download"></i></a>
    </div>
    <!-- links frame end --> --}}

</div>
<!-- scroll frame end -->
