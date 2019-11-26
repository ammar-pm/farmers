<div class="panel panel-default panel-body">
	<p>Attached files</p>

	<ul class="list-group">

		@foreach($record->files as $file)

		<li class="list-group-item"><a href="/files/{{ $file->id }}/edit">{{ $file->title }}</a></li>

		@endforeach

	</ul>

</div>