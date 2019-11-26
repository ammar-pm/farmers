@extends('layouts.site')
@section('content')

<div class="container-fluid">

<div class="row">

	<div class="col-md-4">
		<gov-map class="m-t-md" :record="{{ $record->id }}"></gov-map>
	</div><!--Col-->

	<div class="col-md-8">

	<br>

	@if(!empty($record->description))
		<p class="lead">{!! $record->description !!}</p>
	@endif

	@if(isset($record->datasets))

	<div class="row m-t-lg">

	@foreach($record->datasets as $dataset)
		@include('datasets.preview')
    @endforeach

	</div>

	@endif


	</div><!--Col-->

</div><!--Row-->

</div><!--Container-->

@endsection