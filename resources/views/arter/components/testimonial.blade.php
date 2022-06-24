<div class="testimonial-body">
	@if ($testimonial->image)
	<img class="art-testimonial-face" src="{{$testimonial->image_url}}" alt="face">
	@endif
	<h5>{{$testimonial->title}}</h5>
	@if ($testimonial->subtitle)
	<div class="art-el-suptitle mb-4">{{$testimonial->subtitle}}</div>
	@endif
	<div class="mb-4">{{$testimonial->description}}</div>
</div>
<div class="art-testimonial-footer">
	<div class="art-left-side">
		<ul class="art-star-rate">
			@for ($i=0;$i<$testimonial->stars;$i++)
			<li><i class="fas fa-star"></i></li>
			@endfor
		</ul>
	</div>
	<div class="art-right-side"></div>
</div>