<p>
@if(isset($record->user))
<em>By {{ $record->user->name }}</em>
@endif

<em>{{ $record->date }}</em>
</p>