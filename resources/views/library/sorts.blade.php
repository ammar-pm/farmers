<!-- <div class="row"> -->

<!-- <div class="col-md-6"> -->

<!-- <label>{{ __('common.search') }}</label> -->
<div style="width: 85%; display: inline-block;">
    <ais-input id="searchabd"   placeholder="{{ __('common.filterdatasets') }}" :class-names="{
    'ais-input': 'form-control',
    }">
    </ais-input>
</div>

<div style="width: 14%; display: inline-block;">
    <ais-sort-by-selector class="form-control" :indices="[
          {
            name: 'datasets',
            label: 'datasets_asc'
          },
          {
            name: 'datasets_desc',
            label: 'datasets_desc'
          }
        ]"
    />
    <template slot-scope="{ indexName, label }">

        <option :value="indexName" v-if="label == 'datasets_asc'">{!! __('common.' . 'datasets_asc') !!}</option>
        <option :value="indexName" v-if="label == 'datasets_desc'">{!! __('common.' . 'datasets_desc') !!}</option>
    </template>
    </ais-sort-by-selector>
</div>



<script2>
    document.getElementById("searchabd").value = "";
</script2>


<!-- </div> -->
<!--Col-->

<!-- <div class="col-md-6">

</div> -->
<!-- <div class="col-md-6 text-right">

      <label>{{ __('common.sortby') }}</label>

      <ais-sort-by-selector class="form-control" :indices="[
          {
            name: 'datasets',
            label: 'Title A-Z'
          },
          {
            name: 'datasets_desc',
            label: 'Title Z-A'
          }
        ]"
      />
      </ais-sort-by-selector>

  </div> -->
<!--Col-->

<!-- </div> -->
<!--Row-->