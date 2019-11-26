<ul class="nav nav-pills btn-group" v-if="form.library == 'chartjs' || 'highchart'">
	
    <li class="btn active">
      <a href="#chart" data-toggle="tab">
        <i class="mdi mdi-chart-line" aria-hidden="true"> {{ __('common.chart') }} </i>
      </a>
    </li>
	
    <li class="btn">
      <a href="#table" data-toggle="tab">
        <i class="mdi mdi-view-list" aria-hidden="true"> {{ __('common.excel') }} </i>
      </a>
    </li>
    
</ul>
