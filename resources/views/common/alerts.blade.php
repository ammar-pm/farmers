@if (Session::has('flash_message'))
<!-- <div class="container m-t-md">
<div class="row">
<div class="col-md-12"> -->
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <i class="fa fa-check"></i>
    {{ Session::get('flash_message') }}
  </div>
<!-- </div>
</div>
</div> -->
@endif


@if (Session::has('flash_error'))
  <!-- <div class="container m-t-md">
<div class="row">
<div class="col-md-12"> -->
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{ Session::get('flash_error') }}
  </div>
  <!-- </div>
  </div>
  </div> -->
@endif