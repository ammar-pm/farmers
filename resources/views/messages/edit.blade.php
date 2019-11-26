@extends('spark::layouts.admin')
@section('content')
	<div class="main">
<div class="container-fluid m-t">

<div class="row">

<div class="col-md-3">

	<ul class="list-group">

		@foreach($records as $record2)

			<li class="list-group-item">
				<a href="/{{ Request::segment(1) }}/{{ $record2->id }}/edit">
						{{ $record2->name }}
					    &nbsp;&nbsp;
						@if (!empty($record2->user_reply_message))
							<i class="mdi mdi-checkbox-marked"></i>
						@else
							<i class="mdi mdi-checkbox-blank"></i>
						@endif
				</a>
			</li>

		@endforeach

	</ul>

</div><!--Col-->


<div class="col-md-9">
	
		<div class="panel panel-default panel-body">

		@component('components.form', ['record' => $record])
		    @includeIf('' . Request::segment(1) . '.form')
		@endcomponent

		</div><!--Panel-->

	@includeIf('common.delete')

</div><!--Col-->

</div><!--Row-->

</div><!--Container-->

	</div>

@endsection
