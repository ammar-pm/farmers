@if(count($footers))

	<ul class="list-inline">

	@foreach($footers as $footer)
		
		<li><a href="{{ $footer->link }}">{{ $footer->title }}</a></li>

	@endforeach

	</ul>

@endif