@extends('layouts.site')
@section('content')
	<div class="page-cover">

		<div class="container">

			<div class="cover-content">

				<h1> {{ __('common.topics') }} </h1>
				<div class="breadcrumbs">
					<a href="/"> {{ __('common.home') }} </a> / <span> <a href="/topics">{{ __('common.topics') }}</a> </span> / <span> {{ $record->title }} </span>
				</div>

			</div>

		</div>

	</div>

	<div class="container page">

	<div class="row">

		<div class="col-md-1 col-md-offset-2">

				@if(isset($record->image))

				<img src="/storage/images/{{ $record->image }}" width="102">

				@endif

		</div><!--Col-->

		<div class="col-md-6 p-t m-l">

			@if(!empty($record->summary))
				<div class="panel panel-default panel-body">
					{!! $record->summary !!}
				</div>
			@endif

		</div>

	</div><!--Row-->

	<div class="row m-t-lg">
		<div class="col-md-8 col-md-offset-2">
			@if(!empty($record->description))
				{!! $record->description !!}
				<br>
			@endif
		</div>
	</div>


	@if(isset($record->datasets))

	<div class="grid-wrapper">
		<div class="row">
			@foreach($record->datasets as $dataset)
				@include('datasets.preview')
		  @endforeach
		</div>
	</div>

	@endif

	@if($record->comments)
		@include('widgets.comments')
	@endif

</div><!--Container-->

@endsection
