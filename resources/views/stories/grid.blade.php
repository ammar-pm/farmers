<div class="row">

	@if(count($records))

	@foreach($records as $record)

	<div class="col-md-6">

		<div class="panel panel-default panel-body fheight-lg">

			<h4><a href="/stories/{{ $record->id }}">{{ $record->title }}</a></h4>

			<p class="text-muted">{{ $record->date }}</p>

			@if(!empty($record->summary))
				<p class="m-t">{{ $record->summary }}</p>
			@endif

			<p><a href="/stories/{{ $record->id }}">{{ __('common.readmoree') }}</a></p>

		</div>

	</div>

	@endforeach

	@else

	<div class="alert alert-warning">{{ __('common.nostories') }}</div>

	@endif


</div>

{{ $records->links() }}