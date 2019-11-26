<img v-if="record.options.type == 'line' &&  record.library == 'chartjs'" src="/landing/images/chart-placeholder.png">
<img v-if="record.options.type == 'bar' &&  record.library == 'chartjs'" src="/landing/images/chart-placeholder.png">
<img v-if="record.options.type == 'horizontal-bar' &&  record.library == 'chartjs'" src="/landing/images/chart-placeholder.png">

<img v-if="record.options.type == 'line' && record.library == 'highchart'" src="/landing/images/chart-placeholder.png"> <!-- also vbar -->
<img v-if="record.options.type == 'column' && record.library == 'highchart'" src="/landing/images/chart-placeholder.png"> <!-- also vbar -->
<img v-if="record.options.type == 'bar' && record.library == 'highchart'" src="/landing/images/chart-placeholder.png"> <!-- also hbar -->

<img v-if="record.options.type == 'scattergeo' && record.library == 'plotly'" src="/landing/images/chart-placeholder.png">
<img v-if="record.options.type == 'bubble' && record.library == 'plotly'" src="/landing/images/chart-placeholder.png">

<img v-if="record.options.type == 'line' && record.library == 'tableau'" src="/landing/images/chart-placeholder.png">
<img v-if="record.options.type == 'bubble' && record.library == 'tableau'" src="/landing/images/chart-placeholder.png">
<img v-if="record.options.type == 'bar' && record.library == 'tableau'" src="/landing/images/chart-placeholder.png">

<img v-if="record.library == 'iframe'" src="/landing/images/chart-placeholder.png">