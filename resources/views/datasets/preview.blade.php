<div class="column col-md-6 col-lg-6 col-xl-4">
	<div class="panel panel-default panel-body d-md-flex">
		<a href="/library#/dataset/{{ $dataset->id }}">
		  <div class="panel-head">
		    <h6 class="text-uppercase title">
		      {{ $dataset->title }}
		    </h6>
		    <span class="item-id label">{{ $dataset->id }}</span>
		    <!-- @ include('favorites.actions') -->
		  </div>

		  <div class="panel-graph">      
		    @if(!empty($dataset->preview))
					<img src="{{ $dataset->preview }}">
				@else
					<img src="{{ config('pcbs.preview.url') }}">
				@endif
		  </div>
	  </a>
	</div>
</div>
