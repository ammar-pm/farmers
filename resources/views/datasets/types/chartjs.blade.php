<p><strong>{{ __('common.type') }}</strong></p>


<div class="form-row">

  <div class="img-option col">
  	<label for="line">
    <input type="radio" id="line" value="line" v-model="form.options.type" :checked="form.options.type == 'line'">
    <img src="/img/types/line-plot.jpg" class="img-thumbnail" width="32">
    <p class="small text-uppercase">{{ __('common.line') }}</p>
  	</label>
  </div>

  <div class="img-option col">
  	<label for="bar">
    <input type="radio" id="bar" value="bar" v-model="form.options.type" :checked="form.options.type == 'bar'">
    <img src="/img/types/bar-chart.jpg" class="img-thumbnail" width="32">
    <p class="small text-uppercase">{{ __('common.bar') }}</p>
  	</label>
  </div>

  <div class="img-option col">
  	<label for="horizontal-bar">
    <input type="radio" id="horizontal-bar" value="horizontal-bar" v-model="form.options.type" :checked="form.options.type == 'horizontal-bar'">
    <img src="/img/types/bar-chart.jpg" class="img-thumbnail" width="32">
    <p class="small text-uppercase">{{ __('common.horizontal_bar') }}</p>
  	</label>
  </div>


  <!-- <div class="img-option col">
  	<label for="doughnut">
    <input type="radio" id="doughnut" value="doughnut" v-model="form.options.type" :checked="form.options.type == 'doughnut'">
    <img src="/img/types/pie-chart.jpg" class="img-thumbnail" width="48"><br>
    <p class="small text-uppercase">{{ __('common.doughnut') }}</p>
  	</label>
  </div> -->

  <!-- <div class="img-option col">
  	<label for="pie">
    <input type="radio" id="pie" value="pie" v-model="form.options.type" :checked="form.options.type == 'pie'">
    <img src="/img/types/pie-chart.jpg" class="img-thumbnail" width="48"><br>
    <p class="small text-uppercase">{{ __('common.pie') }}</p>
  	</label>
  </div> -->

  <!-- <div class="img-option col">
  	<label for="radar">
    <input type="radio" id="radar" value="radar" v-model="form.options.type" :checked="form.options.type == 'radar'">
    <img src="/img/types/radar-chart.jpg" class="img-thumbnail" width="48"><br>
    <p class="small text-uppercase">{{ __('common.radar') }}</p>
  	</label>
  </div> -->

</div><!--Row-->