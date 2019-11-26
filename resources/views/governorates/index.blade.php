@extends('spark::layouts.admin')
@section('content')
<div id="gData" style="display: none">
  @json($records)
</div>
<div class="main">
  <div class="container-fluid">

     <governorates-page></governorates-page>
   
  </div><!--Container-->
</div>

@endsection