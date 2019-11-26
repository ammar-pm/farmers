@extends('layouts.site', ['title' => __('common.pagenotfound')])
@section('content')
<div class="container m-t-md">
	<div class="alert alert-danger">{{ __('common.nourl') }}</div>
</div>

@endsection