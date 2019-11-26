@extends('spark::layouts.admin')

@section('content')

<div class="main">
  <div class="container-fluid">

  <div class="row">

   
      <div class="col-md-12">

        <div class="col-md-4">
          <p class="text-muted">{{ __('common.datasets') }}</p>
          <div class="panel panel-default panel-body">
            List here
          </div>
        </div>

        <div class="col-md-4">
          <p class="text-muted">{{ __('common.posts') }}</p>
          <div class="panel panel-default panel-body">
            List here
          </div>
        </div>

        <div class="col-md-4">
          <p class="text-muted">{{ __('common.files') }}</p>
          <div class="panel panel-default panel-body">
            List here
          </div>
        </div>

      </div><!--Col-->

    </div><!--Row-->

  </div><!--Col-->
</div>

@endsection
