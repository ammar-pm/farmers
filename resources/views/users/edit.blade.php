@extends('spark::layouts.admin')
@section('content')

<div id="userData" style="display: none">
  @json($user)
</div>

<div class="main">
  <div class="container-fluid">
	
  <user-edit 
  :app_local="{{ json_encode(App::getLocale()) }}"    
  :app_user_roles="{{json_encode(array_map(function ($val) { return  __('common.' . strtolower($val) ); }, config('pcbs.roles')), JSON_HEX_TAG)}}"></user-edit>

	</div><!--Container-->
</div>

@endsection
