@extends('spark::layouts.app')
@section('content')

<files :data="{{json_encode($record->toArray(), JSON_HEX_TAG)}}"
     :form_id="{{$record->id}}"   inline-template>

<div class="container-fluid">

<div class="row">

<div class="col-md-3">

  <div class="panel panel-default panel-body">
    <form action="/files/{{ $record->id }}" method="POST"  enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @include('files.form')
    <button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>
      </form>
  </div>


  <a href="/datasets/file/download/{{ $record->id }}" class="btn btn-default btn-block m-b-md">{{ __('common.download')}}</a>


  @includeIf('common.delete')

</div><!--Col-->
  <div class="col-md-9">
    @include('files.table')
  </div>

</div><!--Row-->

</div><!--Container-->

</files>
@endsection
