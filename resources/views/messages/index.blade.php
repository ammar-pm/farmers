@extends('spark::layouts.admin')
@section('content')

	<div class="main">
		<div class="container-fluid m-t">

			<div class="row">
				<div class="col-md-3">

					<div class="panel panel-default panel-body">

						<p>{{ __('common.create') }}</p>

						@component('components.form')
							@includeIf('' . Request::segment(1) . '.form')
						@endcomponent

					</div>

				</div><!--Col-->

				<div class="col-md-9">

					<ul class="list-group">

						@foreach($records as $record)

								<li class="list-group-item">
									<a href="/{{ Request::segment(1) }}/{{ $record->id }}/edit">
										<div class="col-md-3">
											{{ $record->name }}
										</div>
										<div class="col-md-2" style="direction: ltr">
											{{ $record->org_name }}
										</div>
										<div class="col-md-2" style="direction: ltr">
											{{ $record->data_use }}
										</div>
										<div class="col-md-2" style="direction: ltr">
											{{ $record->created_at }}
										</div>
										<div class="col-md-1" style="direction: ltr">
											@if (!empty($record->user_reply_message))
												<i class="mdi mdi-checkbox-marked"></i>
                                            @else
												<i class="mdi mdi-checkbox-blank"></i>
											@endif
										</div>
									</a>
								</li>

						@endforeach

					</ul>

				</div><!--Col-->
			</div><!--Row-->

		</div><!--Container-->
	</div>

@endsection