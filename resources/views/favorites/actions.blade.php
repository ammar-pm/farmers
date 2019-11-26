<a href="/favorite/{{ $dataset->id }}">
	@if(count($dataset->favorites))
		<i class="fa fa-heart text-danger"></i>
	@else
		<i class="far fa-heart"></i>
	@endif
</a>