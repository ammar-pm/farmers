<p><strong>{{ __('common.library') }}</strong></p>

<div class="form-row" id="library-select">

  @foreach(config('pcbs.libraries')  as $library)
    <div class="img-option col">
    	<label for="{{ $library }}">
        <input type="radio" id="{{ $library }}" value="{{ $library }}" v-model="form.library" :checked="form.library == '{{ $library }}'">
        <img src="/img/{{ ($library == 'tableau')? 'vizabi' : $library}}.png" class="img-thumbnail" width="32">
        <p class="small text-uppercase">{{ ($library == 'tableau')? 'vizabi' : $library}}</p>
    	</label>
    </div>

  @endforeach

</div>
