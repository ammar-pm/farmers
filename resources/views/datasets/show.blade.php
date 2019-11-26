<div v-if="form.library" class="full-height chart-show" ref="capture">

  @foreach(config('pcbs.libraries') as $library)

    <div v-if="form.library == '{{ $library }}'" class="full-height">
      @includeIf('datasets.show.' . $library . '')
    </div>

  @endforeach

</div>
