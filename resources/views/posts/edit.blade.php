@extends('spark::layouts.admin')
@section('content')

<div id="gData" style="display: none">
  @json($record)
</div>
<div id="lang" style="display: none">
  @json($lang_records)
</div>
<div class="main">
  <div class="container-fluid">	
	<post-add :app_local="{{ json_encode(App::getLocale()) }}"></post-add>
	</div><!--Container-->
</div>

@endsection
