<div class="mb-4 hidden-print">


  <div class="row text-right filters controls"  style="margin-bottom: 10px;">
    @auth
      <!--
      <span v-on:click="addToFavourites()" class="mdi">
        <i id="myheart" v-if="form.favorites.length > 0" class="fa fa-heart text-danger"></i>
        <i id="myheart" v-else class="far fa-heart"></i>
      </span>
      -->
    @endauth
      <div class="col-md-1">
    <!-- <span class="reset-zoom"><i class="mdi mdi-magnify"> {{ __('common.reset_zoom') }} </i></span> -->
      <i class="mdi mdi-arrow-left" style="float: left;" v-if="app_local == 'en'" @click="allRecords()"></i>
      <i class="mdi mdi-arrow-right" style="float: right;" v-if="app_local == 'ar'" @click="allRecords()"></i>
      </div>
      <div class="col-md-9">
      </div>
<div class="col-md-2">
  <!-- <i class="mdi mdi-arrow-expand-all" @click="fullScreen()"></i> -->
  <i class="mdi dropdown">
    <a data-toggle="dropdown" href="#" class="dropdown-toggle" aria-expanded="false">
      <i class="mdi mdi-download"></i>
    </a>

    <ul class="dropdown-menu">
      <li class="nav-item" v-if="form.library == 'chartjs' || form.library == 'highchart'">
        <a href="#" class="nav-link" @click="exportChart()"> {{ __('common.export_image') }} </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" @click="exportt()"> {{ __('common.exporttopdf') }} </a>
      </li>
      <li class="nav-item">
        <a :href="'/datasets/file/download/'+form.file_id.id+''" :download="form.file_id.name" class="nav-link"> {{ __('common.export_csv') }} </a>
      </li>
    </ul>
  </i>

  <!-- <i class="mdi mdi-download" @click="exportChart()"></i> -->
  <a id="visual-export-link" :href="export_url" :download="form.title"> export </a>
  @auth
    @if(Auth::user()->role === 'admin')
      <a class="btn btn-primary" :href="'/datasets#/dataset/'+form.id+''"> {{ __('common.edit') }} </a>
    @endif
  @endauth
</div>
</div>

  <div class="row">
    <div class="col-md-12">
    <div class="form-row filters">

      <div class="col-md-2">
        <select v-if="form.library == 'chartjs'" class="form-control" id="" v-model="form.options.type" name="">
          <option value="" disabled>{{ __('common.revisualize') }} </option>
          <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
          <option value="bar" :selected="form.options.type == 'bar'">{{ __('common.bar') }}</option>
          <option value="horizontal-bar" :selected="form.options.type == 'horizontal-bar'"> {{ __('common.horizontal_bar') }} </option>
        <!-- <option value="doughnut" :selected="form.options.type == 'doughnut'">{{ __('common.doughnut') }}</option>
          <option value="pie" :selected="form.options.type == 'pie'">{{ __('common.pie') }}</option>
          <option value="radar" :selected="form.options.type == 'radar'">{{ __('common.radar') }}</option> -->
        </select>
        <select v-if="form.library == 'highchart'" class="form-control" id="" v-model="form.options.type"  name="">
          <option value="" disabled>{{ __('common.revisualize') }}</option>
          <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
          <option value="bar" :selected="form.options.type == 'bar'">{{ __('common.horizontal_bar') }}</option>
          <option value="column" :selected="form.options.type == 'column'">{{ __('common.bar') }}</option>
        </select>
        <select v-if="form.library == 'plotly'" class="form-control" id="" v-model="form.options.type"  name="">
          <option value="" disabled>{{ __('common.revisualize') }}</option>
          <option value="scattergeo" :selected="form.options.type == 'scattergeo'">{{ __('common.map') }}</option>
          <option value="bubble" :selected="form.options.type == 'bubble'">{{ __('common.bubble') }}</option>
        </select>
        <select v-if="form.library == 'tableau'" class="form-control" id="" v-model="form.options.type"  name="">
          <option value="" disabled>{{ __('common.revisualize') }}</option>
          <option value="line" :selected="form.options.type == 'line'">{{ __('common.line') }}</option>
          <option value="bubble" :selected="form.options.type == 'bubble'">{{ __('common.bubble') }}</option>
          <option value="bar" :selected="form.options.type == 'bar'">{{ __('common.bar') }}</option>
        </select>
      </div>

      @foreach(config('pcbs.libraries') as $library)
        @if($library != 'tableau')
          <div id="{{ $library }}" class="filters library-options data-libraries hidden-print col-md-10" v-if="form.library == '{{ $library }}'">
            @includeIf('datasets.public_options.' . $library . '')
          </div>
      @endif
    @endforeach
    <!-- <div class="col">
        <select class="form-control" id=""  v-model="filters.sort_option"  name="">
          <option value="" hidden>{{ __('common.appearance') }}</option>
          <option value="">{{ __('common.name_of_dataset') }}</option>
          <option value="">{{ __('common.name_of_creator') }}</option>
        </select>
      </div> -->
    <!-- <div class="col">
        <select class="form-control" id="" v-model="filters.sort_option"  name="">
          <option value="" hidden>{{ __('common.indicator_options') }}</option>
          <option value="">{{ __('common.ascending') }}</option>
          <option value="">{{ __('common.descending') }}</option>
        </select>
      </div> -->
      <!-- Show library options -->
      <!-- <div class="col-md-2"> -->
      <!-- onClick="window.print()" -->
      <!-- <span class="select text-center" @click="exportChart()"> <i class="mdi mdi-download"></i></span> -->
      <!-- <a id="visual-export-link" :href="export_url" :download="form.title"> export </a> -->
    <!-- <select class="form-control" id="" v-model="filters.export_option" name="" @change="exportt()">
          <option value="" selected="disabled">{{ __('common.export_options') }}</option>
          <option value="pdf">{{ __('common.exporttopdf') }}</option>
        </select> -->
      <!-- </div> -->

    </div>

    </div>

  </div>


</div>


<!-- <div class="hidden-print"> -->

    <!-- <ul class="nav nav-pills nav-stacked text-center">

    <li>
      <a v-on:click="allRecords()"><i class="fas fa-times text-danger"></i></a>
    </li> -->

    <!-- <li v-on:click="addToFavourites()" style="cursor: pointer;">
      
    </li> -->

    <!-- <li>
      <a v-if="form.library == 'chartjs'"  data-toggle="collapse" data-target="#table"><i class="fas fa-table text-primary"></i></a>
    </li> -->

    <!-- <li><a v-if="showfileid" :href="'/datasets/file/download/'+showfileid+''" target="_blank"><i class="far fa-file-excel text-primary"></i></a></li> -->


<!-- </ul> -->

<!-- </div> -->
