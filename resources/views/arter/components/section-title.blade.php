<div class="art-section-title">
	<div class="art-title-frame w-full lg:w-1/2">
		<h2 class="text-xl">{{ $title }}</h2>
		@if (isset($subtitle))
		<h3 class="mt-1 opacity-75">{{ $subtitle }}</h3>
		@endif
	</div>
	@if (isset($titleRight))
	<div class="art-right-frame w-full lg:w-1/2">
		<div class="art-project-category">
			{{ $titleRight }}
		</div>
	</div>
	@endif
</div>
