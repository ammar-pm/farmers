@extends('layouts.site')
@section('content')

<div class="container-fluid">

<div class="row m-t-lg">

<div class="col-md-6 col-md-offset-3">

	@if(!empty($record->summary))
		<div class="panel panel-default panel-body m-t-md">
			{!! $record->summary !!}
		</div>
	@endif

	@if(isset($record->description))
		{!! $record->description !!}
	@endif

	@if($record->comments)
		@include('widgets.comments')
	@endif
	
</div><!--Col-->


</div><!--Row-->


</div><!--Container-->

@endsection