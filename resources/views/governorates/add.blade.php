@extends('spark::layouts.admin')
@section('content')

<div id="gData" style="display: none">
  null
</div>
<div class="main">
  <div class="container-fluid">	
	<governorate-add :app_local="{{ json_encode(App::getLocale()) }}"></governorate-add>
	</div><!--Container-->
</div>

@endsection
