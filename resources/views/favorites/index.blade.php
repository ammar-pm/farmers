@extends('layouts.site')
@section('content')

<div class="container">

<div class="row m-t-lg">

<div class="col-md-12">
	@if(count($records))
	
	@foreach($records as $dataset)
		@include('datasets.preview')
	@endforeach
	
	@else
	<div class="col-md-6 col-md-offset-3">
		<div class="alert alert-danger">{{ __('common.nofavorites') }}</div>
	</div>
	
	@endif
</div><!--Col-->


</div><!--Row-->


</div><!--Container-->

@endsection