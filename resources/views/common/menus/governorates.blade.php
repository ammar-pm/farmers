<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ __('common.governorates') }}</a>
        <ul class="dropdown-menu">

          @foreach($governorates as $governorate)
          	<li><a href="/governorates/{{ $governorate->id }}">{{ $governorate->title }}</a></li>
          @endforeach

        </ul>
</li>