<p><strong>{{ __('common.type') }}</strong></p>


<div class="form-row">

    <div class="img-option col">
        <label for="line">
            <input type="radio" id="line" value="line" v-model="form.options.type" :checked="form.options.type == 'line'" checked>
            <img src="/img/types/line-plot.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">Line</p>
        </label>
    </div>

    <div class="img-option col">
        <label for="bubble">
            <input type="radio" id="bubble" value="bubble" v-model="form.options.type" :checked="form.options.type == 'bubble'" checked>
            <img src="/img/types/animations.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">Bubble</p>
        </label>
    </div>

    <div class="img-option col">
        <label for="bar">
            <input type="radio" id="bar" value="bar" v-model="form.options.type" :checked="form.options.type == 'bar'" checked>
            <img src="/img/types/bar-chart.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">Bar</p>
        </label>
    </div>

</div><!--Row-->