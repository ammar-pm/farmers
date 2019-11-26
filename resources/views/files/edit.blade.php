@extends('spark::layouts.admin')
@section('content')

<files :data="{{json_encode($record->toArray(), JSON_HEX_TAG)}}"
	   :page_prop="{{ json_encode(Session::get('page')) }}"
	   :app_local="{{ json_encode(App::getLocale()) }}"
	   :user="user"
	   :form_id="{{$record->id}}"
	   inline-template>

	<div class="main">
		<div class="container-fluid files-page">

			<div class="row">

				<div class="col-md-12 mb-5 data-table">
					@include('files.table')
				</div>

			</div><!--Row-->

			<div class="files-form inline-form">

				<div class="panel panel-default panel-body">
					<div class="row">
						<div class="col-md-9">
							<h4>{{ __('common.file') }}: {{ $record->title }} {{ __('common.ID') }}:{{ $record->id }}</h4>
						</div>
						<div class="col-md-3 text-right file-controls">

							<a v-on:click='toggleShowDeleteConfirmation({{ $record->id }}, "{{ $record->title }}" )' href="#" class="btn btn-xs btn-delete"><i class="mdi mdi-trash-can-outline"></i></a>
							<a href="/datasets/file/download/{{ $record->id }}" download="morad-test" class="btn btn-xs btn-download"><i class="mdi mdi-cloud-download-outline"></i></a>

          		<!-- <a v-bind:href="'https://indicators.ps/'+record.url" target="_blank" class="btn btn-xs btn-download"><i class="mdi mdi-cloud-download-outline"></i></a> -->
							<!-- @includeIf('common.delete') -->
						</div>
					</div>
					<form action="/files/{{ $record->id }}" method="POST"  enctype="multipart/form-data">
						{{ method_field('PATCH') }}
						@include('files.form')
						<div class="text-right form-group">
							<a  v-on:click="cancel"  href="" class="btn btn-dark">{{ __('common.back_to_browse') }}</a>
							<button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
						</div>
				  </form>
				</div>

			</div><!--Col-->

		</div><!--Container-->

		<div class="delete-confirmation" v-if='showDeleteConfirmation'>
			<div class="delete-message">
				<p> <b>{{ __('common.delete_file') }}</b> </p>
				<p class="red-text" v-if="fileHaveDatasets != ''"> @{{fileHaveDatasets}} </p>
				<p> {{ __('common.are_you_sure_you_want_to_delete') }} <i> {{$record->title}} </i> {{ __('common.from_files') }} </p>
				<div class="text-right">
					<button class="btn btn-dark" v-on:click="toggleShowDeleteConfirmation()">{{ __('common.cancel') }}</button>
					<a v-bind:href="'/delete/file/' + {{ $record->id }} + '/' + page" class="btn btn-danger"> {{ __('common.delete') }} </a>
				</div>
			</div>
		</div>
	</div>

</files>
@endsection

