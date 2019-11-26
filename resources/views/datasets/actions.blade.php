<div class="dataset-actions">

  <div v-if="form.id">
  <!-- If new form, show dataset complete form -->

    <div class="row mb-5" v-if="user.role != 'admin'">
      <div class="col-md-6">

        <div class="form-row filters">
          <div class="col">
            <select v-if="form.library == 'chartjs'" class="form-control" id="" v-model="form.options.type" name="">
              <option value="" selected="disabled">{{ __('common.library') }}</option>
              <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
              <option value="bar" :selected="form.options.type == 'line'">{{ __('common.bar') }}</option>
              <option value="horizontal-bar" :selected="form.options.type == 'horizontal-bar'"> {{ __('common.horizontal_bar') }} </option>
              <option value="doughnut" :selected="form.options.type == 'doughnut'">{{ __('common.doughnut') }}</option>
              <option value="pie" :selected="form.options.type == 'pie'">{{ __('common.pie') }}</option>
              <option value="radar" :selected="form.options.type == 'radar'">{{ __('common.radar') }}</option>
            </select>
            <select v-if="form.library == 'highchart'" class="form-control" id="" v-model="form.options.type"  name="">
              <option value="" hidden>{{ __('common.library') }}</option>
              <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
              <option value="bar" :selected="form.options.type == 'bar'">{{ __('common.horizontal_bar') }}</option>
              <option value="column" :selected="form.options.type == 'column'">{{ __('common.bar') }}</option>
            </select>
            <select v-if="form.library == 'plotly'" class="form-control" id="" v-model="form.options.type"  name="">
              <option value="" hidden>{{ __('common.library') }}</option>
              <option value="scattergeo" :selected="form.options.type == 'scattergeo'">{{ __('common.map') }}</option>
              <option value="bubble" :selected="form.options.type == 'bubble'">{{ __('common.bubble') }}</option>
            </select>
            <select v-if="form.library == 'tableau'" class="form-control" id="" v-model="form.options.type"  name="">
              <option value="" hidden>{{ __('common.library') }}</option>
              <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
              <option value="bubble" :selected="form.options.type == 'bubble'">{{ __('common.bubble') }}</option>
              <option value="bar" :selected="form.options.type == 'bar'">{{ __('common.bar') }}</option>
            </select>
          </div>
          <div class="col">
            <select class="form-control" id=""  v-model="filters.sort_option"  name="">
              <option value="" hidden>{{ __('common.appearance') }}</option>
              <option value="">{{ __('common.name_of_dataset') }}</option>
              <option value="">{{ __('common.name_of_creator') }}</option>
            </select>
          </div>
          <div class="col">
            <select class="form-control" id="" v-model="filters.sort_option"  name="">
              <option value="" hidden>{{ __('common.indicator_options') }}</option>
              <option value="">{{ __('common.ascending') }}</option>
              <option value="">{{ __('common.descending') }}</option>
            </select>
          </div>
          <div class="col">
            <select class="form-control" id=""  v-model="filters.sort_option"  name="">
              <option value="" hidden>{{ __('common.export_options') }}</option> <!-- hidden instead of selected disabled -->
              <option value="">{{ __('common.name_of_dataset') }}</option>
              <option value="">{{ __('common.name_of_creator') }}</option>
            </select>
          </div>
        </div>

      </div>

      <div class="col-md-6 text-right filters controls"> 
        <i class="mdi mdi-alert-octagon"></i>
        <span class="reset-zoom"><i class="mdi mdi-magnify"> {{ __('common.reset_zoom') }} </i></span>
        <i class="mdi mdi-arrow-expand-all" @click="fullScreen()"></i>
        <!-- <button class="btn btn-primary"> {{ __('common.edit') }} </button> -->
      </div>
    </div>

    <!-- <div class="col-md-3 text-right">

      <a :href="'/library#/dataset/'+form.id+''" target="_blank" class="btn btn-default"><i class="fa fa-share fa-fw"></i></a>

    </div> -->

  </div><!--VIf-->


  <div v-else>

    <div class="row mb-3">
      <div class="col-md-3">

        <h1> {{ __('common.datasets') }} </h1>
        <!-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn active grid-switch">
            <input type="radio" name="options" id="option1" autocomplete="off" checked>
            <i class="mdi mdi-grid" aria-hidden="true"> {{ __('common.grid') }} </i>
          </label>
          <label class="btn list-switch">
            <input type="radio" name="options" id="option3" autocomplete="off">
            <i class="mdi mdi-view-list" aria-hidden="true"> {{ __('common.list') }} </i>
          </label>
        </div> -->
      </div>

      <div class="col-md-9 text-right">
        @include('datasets.filters-new')
      </div>
    </div>
    
  </div><!--VElse-->

</div><!--Row-->
