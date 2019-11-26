<p><strong>{{ __('common.type') }}</strong></p>


<div class="form-row">

    <div class="img-option col">
        <label for="scattergeo">
            <input type="radio" id="scattergeo" value="scattergeo" v-model="form.options.type" :checked="form.options.type == 'scattergeo'" checked>
            <img src="/img/types/map.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">Map</p>
        </label>
    </div>

    <div class="img-option col">
        <label for="bubble">
            <input type="radio" id="bubble" value="bubble" v-model="form.options.type" :checked="form.options.type == 'bubble'" checked>
            <img src="/img/types/animations.jpg" class="img-thumbnail" width="32">
            <p class="small text-uppercase">Bubble</p>
        </label>
    </div>

</div><!--Row-->