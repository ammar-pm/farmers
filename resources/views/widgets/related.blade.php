<p class="text-muted text-uppercase">{{ __('common.relatedstories') }}</p>

<ul class="list-group">

@foreach($relateds as $related)

<li class="list-group-item"><a href="/stories/{{ $related->id }}">{{ $related->title }}</a><br><small>{{ $related->date }}</small></li>

@endforeach

</ul>