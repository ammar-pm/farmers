@extends('spark::layouts.admin')
@section('content')

<files :data="{{json_encode($records->toArray(), JSON_HEX_TAG)}}"
	   :page_prop="{{ json_encode(Session::get('page')) }}"
	   :app_local="{{ json_encode(App::getLocale()) }}"
	   :user="user"
	   :form_id=0  inline-template>
	<div class="main">

		<div class="container-fluid files-page">

			<!-- filters -->
			@include('files.filters')

			<div class="row">

				<div class="col-md-12">

					<div class="grid-wrapper files">

						<div class="row grid-view">

							@if(count($records))
								@include('files.grid')
							@endif

						</div><!--Row-->

						<div class="pagination-wrapper text-right">
							<pagination id='2' :records="rec_size" v-model="page" :per-page="12" @paginate="clickCallback(page)"></pagination>
						</div>

					</div>
				</div>
			</div>

			<div class="files-form" id="files-form" v-if="showForm">
				<div class="panel panel-default panel-body">
					<div class="form-row">
						<div class="col">
							<h3 class="text-capetalize mt-0 mb-5">{{ __('common.uploadnewfile') }}</h3>
						</div>
						<div class="col text-right">
							<div class="close-form">
								<i v-on:click="toggleShowForm()" class="mdi mdi-close-circle-outline"></i>
							</div>
						</div>
					</div>
					
					<form action="/files" method="POST" enctype="multipart/form-data" @submit="onSubmit">
						<div class="align-items-center">
							@include('files.form')
							<div class="text-right">
								<button class="btn btn-dark" v-on:click="toggleShowForm">{{ __('common.cancel') }}</button>
								<button type="submit" class="btn btn-primary" >{{ __('common.save') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div><!--Container-->
		<div class="dim" v-if='showForm'></div>
		<div class="delete-confirmation" v-if='showDeleteConfirmation'>
			<div class="delete-message" v-if='selectedFile'>
				<p> <b>{{ __('common.delete_file') }}</b> </p>
				<p class="red-text" v-if="fileHaveDatasets != ''"> @{{fileHaveDatasets}} </p>
				<p> {{ __('common.are_you_sure_you_want_to_delete') }} <i> @{{selectedFile.name}} </i> {{ __('common.from_files') }}</p>
				<div class="text-right">
					<button class="btn btn-dark" v-on:click="toggleShowDeleteConfirmation()">{{ __('common.cancel') }}</button>
					<a v-bind:href="'/delete/file/' + selectedFile.id  + '/' + page" class="btn btn-danger"> {{ __('common.delete') }} </a>
				</div>
			</div>
		</div>
	</div>
</files>
<script2>
	$(document).ready(function() {
	$(window).keydown(function(event){
	var source_id = event.target.id;
	var source_target_class = $(event.target).attr('class');
	if(event.keyCode == 13 && source_id !== 'search_text' &&  source_target_class !== 'multiselect__input' ) {
	event.preventDefault();
	return false;
	}
	});
	});
</script2>

@endsection

