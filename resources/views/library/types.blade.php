<div class="hidden-print">


	<div v-if="form.library == 'chartjs'">
		@include('datasets.types.chartjs')
	</div>

	<div v-else-if="form.library == 'highchart'">
		@include('datasets.types.highchart')
	</div>

	<div v-else-if="form.library == 'plotly'">
		@include('datasets.types.plotly')
	</div>

	<div v-else-if="form.library == 'tableau'">
		@include('datasets.types.tableau')
	</div>

</div><!--Hidden-->