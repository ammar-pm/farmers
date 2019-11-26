<p><strong>{{ __('common.type') }}</strong></p>


<div class="form-row">

    <div class="img-option col">
        <label for="line">
            <input type="radio" id="line" value="line" v-model="form.options.type" :checked="form.options.type == 'line'" checked>
            <img src="/img/types/line-plot.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">{{ __('common.line') }}</p>
        </label>
    </div>


    <div class="img-option col">
        <label for="column">
            <input type="radio" id="column" value="column" v-model="form.options.type" :checked="form.options.type == 'column'">
            <img src="/img/types/bar-chart.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">{{ __('common.bar') }}</p>
        </label>
    </div>

    <div class="img-option col">
        <label for="bar">
            <input type="radio" id="bar" value="bar" v-model="form.options.type" :checked="form.options.type == 'bar'">
            <img src="/img/types/bar-chart.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">{{ __('common.horizontal_bar') }}</p>
        </label>
    </div>

</div><!--Row-->