<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">{{ __('common.topics') }}</a>
        <ul class="dropdown-menu">

          @foreach($topics as $topic)
          	<li><a href="/topics/{{ $topic->id }}">

          		@if(isset($topic->image))
          			<img src="/storage/images/{{ $topic->image }}" width="24">
          		@endif
          		
          		{{ $topic->title }}</a></li>
          @endforeach

        </ul>
</li>