@foreach(config('pcbs.libraries') as $library)

<div id="{{ $library }}" class="data-libraries" v-if="form.library == '{{ $library }}'">
	@includeIf('datasets.options.' . $library . '')
</div>

@endforeach