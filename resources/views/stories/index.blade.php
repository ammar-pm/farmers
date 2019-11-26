@extends('layouts.site')
@section('content')

<div class="container-fluid">

<div class="row m-t-lg">

<div class="col-md-3">

    @include('widgets.index')

</div><!--Col-->

<div class="col-md-9">
	@include('stories.grid')
</div><!--Col-->


</div><!--Row-->


</div><!--Container-->

@endsection