@extends('spark::layouts.admin')
@section('content')
<div id="gData" style="display: none">
  @json($records)
</div>
<div class="main">
  <div class="container-fluid">

     <posts-page :app_local="{{ json_encode(App::getLocale()) }}"></posts-page>
   
  </div><!--Container-->
</div>

@endsection