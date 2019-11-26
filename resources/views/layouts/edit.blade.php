@extends('spark::layouts.admin')
@section('content')
	<div class="main">
<div class="container-fluid m-t">

<div class="row">

<div class="col-md-3">

	@includeIf('components.list')

</div><!--Col-->


<div class="col-md-9">
	
		<div class="panel panel-default panel-body">

		@component('components.form', ['record' => $record])
		    @includeIf('' . Request::segment(1) . '.form')
		@endcomponent

		</div><!--Panel-->

	@includeIf('common.delete')

</div><!--Col-->

<div class="col-md-3">

	@if(isset($record->files))
	 @if(count($record->files))
		@include('common.attached')
	 @endif
	@endif

</div>

</div><!--Row-->

</div><!--Container-->
	</div>

@endsection
