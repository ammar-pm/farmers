@extends('spark::layouts.admin')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard/user-admin.css') }}" />

<div id="userData" style="display: none">
  @json($records)
</div>
<div class="main">
  <div class="container-fluid user-admin">
    <user-index-view
            :app_local="{{ json_encode(App::getLocale()) }}"
            :login_user="user"
            :app_user_roles="{{json_encode(array_map(function ($val) { return  __('common.' . strtolower($val) ); }, config('pcbs.roles')), JSON_HEX_TAG)}}"
    ></user-index-view>
  </div>
</div>

@endsection