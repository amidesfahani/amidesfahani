@extends('arter.master')

@section('content')
<!-- container -->
<div class="container-fluid">
	<!-- row -->
	<div class="row pt-8">

		<div class="col shrink-0 grow-0 lg:basis-1/2">

			@include('arter.components.section-title', ['title' => __('Education')])

			<!-- timeline -->
			<div class="art-timeline art-gallery">
				@foreach ($educations as $education)
				<div class="art-timeline-item">
					<div class="art-timeline-mark-light"></div>
					<div class="art-timeline-mark"></div>
					<div class="art-a art-timeline-content">
						<div class="art-card-header">
							<div class="art-left-side">
								<h5>{{ ___($education, 'title') }}</h5>
								@if ($education->field)
								<div class="art-el-suptitle mb-4">{{ ___($education, 'field') }}</div>
								@endif
							</div>
							<div class="art-right-side">
								<span class="art-date">
									@if ($education->start_date)
									{{ __date($education->start_date, 'M Y', ['fa' => '%B %y']) }}
									@endif
									@if ($education->end_date)
									 - 
									{{ __date($education->end_date, 'M Y', ['fa' => '%B %y']) }}
									@endif
								</span>
							</div>
						</div>
						@if ($education->description)
							<p>{{ ___($education, 'description') }}</p>
						@endif
						@if ($education->documents)
							@foreach ($education->documents as $document)
								<a data-fancybox="diplome" data-no-swup href="{{ $document->image_url }}" class="art-link art-color-link art-w-chevron mt-4">{{ ___($document, 'title') }}</a>
							@endforeach
						@endif
					</div>
				</div>
				@endforeach
			</div>
			<!-- timeline end -->

		</div>

		<div class="col shrink-0 grow-0 lg:basis-1/2">

			@include('arter.components.section-title', ['title' => __('Work History')])

			<!-- timeline -->
			<div class="art-timeline">

				@foreach ($histories as $history)
				<div class="art-timeline-item">
					<div class="art-timeline-mark-light"></div>
					<div class="art-timeline-mark"></div>
					<div class="art-a art-timeline-content">
						<div class="art-card-header">
							<div class="art-left-side">
								<h5>{{ ___($history, 'title') }}</h5>
								@if ($history->role)
								<div class="art-el-suptitle mb-4">{{ ___($history, 'role') }}</div>
								@endif
							</div>
							<div class="art-right-side">
								<span class="art-date">
									@if ($history->start_date)
									{{ __date($history->start_date, 'M Y', ['fa' => '%B %y']) }}
									@endif
									@if ($history->present || $history->end_date)
									 - 
										@if ($history->end_date && !$history->present)
										{{ __date($history->end_date, 'M Y', ['fa' => '%B %y']) }}
										@else
										@lang('Present')
									@endif
									@endif
								</span>
							</div>
						</div>
						@if ($history->description)
						<p>{{ ___($history, 'description') }}</p>
						@endif
						@if ($history->testimonials->count())
						<a data-fancybox="recommendation" data-no-swup href="#art-recomendation-popup-{{ $history->id }}" class="art-link art-color-link art-w-chevron mt-4">
							@lang('Documents')
						</a>
						@endif
					</div>
				</div>

				@if ($history->testimonials->count())
				<!-- popup -->
				<div class="art-recomendation-popup hidden" id="art-recomendation-popup-{{ $history->id }}">
					<!-- testimonial -->
					<div class="art-a art-testimonial">
						@foreach ($history->testimonials as $testimonial)
						@include('arter.components.testimonial')
						@endforeach
					</div>
					<!-- testimonial end -->
				</div>
				<!-- popup end -->
				@endif

				@endforeach
			</div>
			<!-- timeline end -->
		</div>
		<!-- col end -->
	</div>
	<!-- row end -->
</div>
<!-- container end -->
@endsection
