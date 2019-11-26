<img v-if="result.options.type == 'line' &&  result.library == 'chartjs'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
<img v-if="result.options.type == 'bar' &&  result.library == 'chartjs'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
<img v-if="result.options.type == 'horizontal-bar' &&  result.library == 'chartjs'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">

<img v-if="result.options.type == 'line' && result.library == 'highchart'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'"> <!-- also vbar -->
<img v-if="result.options.type == 'column' && result.library == 'highchart'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'"> <!-- also vbar -->
<img v-if="result.options.type == 'bar' && result.library == 'highchart'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'"> <!-- also hbar -->

<img v-if="result.options.type == 'scattergeo' && result.library == 'plotly'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
<img v-if="result.options.type == 'bubble' && result.library == 'plotly'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">

<img v-if="result.options.type == 'line' && result.library == 'tableau'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
<img v-if="result.options.type == 'bubble' && result.library == 'tableau'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
<img v-if="result.options.type == 'bar' && result.library == 'tableau'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">

<img v-if="result.library == 'iframe'" :src="getUrlBase()+'/'+'landing/images/chart-placeholder.png'">
