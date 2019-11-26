@if(Request::segment(2) !== null)
    <form action="/{{ Request::segment(1) }}/{{ Request::segment(2) }}" method="POST" enctype="multipart/form-data">
@else
    <form action="/{{ Request::segment(1) }}" method="POST" enctype="multipart/form-data">
@endif

@if(isset($record->id))
    {{ method_field('PATCH') }}
@endif

{{ csrf_field() }}

{{ $slot }}

<button type="submit" class="btn btn-primary">{{ __('common.save') }}</button>

</form>