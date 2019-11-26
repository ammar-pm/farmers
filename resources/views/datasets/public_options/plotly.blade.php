
<div class="form-row">
  <div class="form-group col-md-2">
    <input type="text" placeholder="{{ __('common.scale') }}" class="form-control" v-model="form.options.plotly_scale">
    <!-- <label> {{ __('common.scale') }} </label> -->
  </div>

  <div id="baseselector"
                   name="baseselector" class="form-group col col-md-5">
    <agg-tree-select
            v-model="form.options.fbasevalue"
            :options="form.fbaseload.options"
            :clear-on-select="form.fbaseload.clearOnSelect"
            :multiple="true"
            placeholder="{{ __('common.base_selector') }}"
    ></agg-tree-select>
    <!-- <label> {{ __('common.base_selector') }} </label> -->
  </div>

  <div class="form-group col-md-5">
      <agg-tree-select
              v-model="form.options.faggvalue"
              :options="form.faggload.options"
              :sort-value-by="form.faggload.sortValueBy"
              :clear-on-select="form.faggload.clearOnSelect"
              :multiple="true"
              placeholder="{{ __('common.aggregation_selector') }}"
      ></agg-tree-select>
      <!-- <label> {{ __('common.aggregation_selector') }} </label> -->
  </div>

    <div class="form-group col">
        <multiselect
                v-model="form.options.years_field"
                :options="form.years_field"
                :multiple="true"
                placeholder="{{ __('common.years') }}">
        </multiselect>
        <!-- <label> {{ __('common.years') }} </label> -->
    </div>

</div>

<!--div class="form-group">
    <label>Selector </label>
    <dim-m-select
            :file="form.file_id"
            :library="form.library"
            :option="form.options">
    </dim-m-select>
</div-->
