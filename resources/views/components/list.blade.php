<ul class="list-group">

	<p class="text-muted">English</p>

	@foreach($records as $record)

		@if($record->language == 'en')
			<li class="list-group-item"><a href="/{{ Request::segment(1) }}/{{ $record->id }}/edit">{{ $record->title }}</a></li>
		@endif

	@endforeach

</ul>

<ul class="list-group">

	<p class="text-muted">العربية</p>

	@foreach($records as $record)
		
		@if($record->language == 'ar')
			<li class="list-group-item"><a href="/{{ Request::segment(1) }}/{{ $record->id }}/edit">{{ $record->title }}</a></li>
		@endif

	@endforeach

</ul>