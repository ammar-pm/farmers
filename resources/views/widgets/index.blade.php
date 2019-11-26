@if(count($widgets))

@foreach($widgets as $widget)

<div class="widget m-t-md">

    <div class="w-title">
        <h5>{{ $widget->title }}</h5>
    </div>

{!! $widget->description !!}

</div>

@endforeach

@endif