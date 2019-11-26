@if(count($headers))

@foreach($headers as $header)

<li><a href="{{ $header->link }}">{{ $header->title }}</a></li>

@endforeach

@endif

@include('common.menus.topics')
@include('common.menus.governorates')

@guest

<li><a href="/login">{{ __('common.login') }}</a></li>

@endguest