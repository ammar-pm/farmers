@extends('layouts.site')
@section('content')

<div class="container-fluid">

<div class="row m-t-lg">

<div class="col-md-3">

	@include('widgets.index')

	<br>
	
	@if(count($relateds))
		@include('widgets.related')
	@endif

</div><!--Col-->

<div class="col-md-9">

	<h3>{{ $title }}</h3>
	<p class="text-muted">

	@include('common.post_meta')
	
	@if(isset($record->image))
		<img src="/storage/images/{{ $record->image }}" class="img-responsive">
	@endif

	@if(!empty($record->summary))
		<div class="panel panel-default panel-body m-t-md">
			{!! $record->summary !!}
		</div>
	@endif

	@if(!empty($record->description))
		{!! $record->description !!}
	@endif

	@if($record->comments)
		@include('widgets.comments')
	@endif

</div><!--Col-->


</div><!--Row-->


</div><!--Container-->

@endsection