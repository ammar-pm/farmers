@extends('layouts.site')
@section('content')
  <div class="page-cover topics-cover">
    <div class="container">
      <div class="cover-content">
        <h1> {{ __('common.library') }} </h1>
        <div class="breadcrumbs">
          <a href="/"> {{ __('common.home') }} </a> / <span> {{ $record->title }} </span>
        </div>
      </div>
    </div>
  </div>

  <div class="container page topics">

    <div class="topic">
      <div class="image-wrapper">
        @if(isset($record->image))
          <img src="/storage/images/{{ $record->image }}">
        @endif
      </div>
      <div class="content-wrapper">
        <h4> {{ $record->title }} </h4>
      </div>
    </div>

    @if(!empty($record->summary))
      <div>
        {!! $record->summary !!}
      </div>
    @endif

    @if(!empty($record->description))
      <div>
        {!! $record->description !!}
      </div>
  @endif




  <!-- datasets -->
    <datasets :user="user"
              :ds_id="{{ json_encode($ds_id) }}"
              :app_local="{{ json_encode(App::getLocale()) }}"
              inline-template>
      <div class="grid-wrapper">
        <div class="grid-view">
          <ais-index app-id="{{ env('ALGOLIA_APP_ID') }}"
                     api-key="{{ env('ALGOLIA_SEARCH_KEY') }}"
                     urlSync="true"
                     query="{{ Request::get('q') }} "
                     :query-parameters="{
  filters: 'language:{{ App::getLocale() }} AND (public:Public) AND (topics.id:{{$record->id}}) AND (url_base:indicators.ps) '
  }"
                     index-name="datasets">
            <!-- single -->
            <div v-if="form.id" class="container">

              @include('library.actions')

              <div class="dataset-view" id="dataset-view">

                <div class="form-row">
                <!--
                  <div class="col-md-2">
                    <div class="libraries-list">
                      <p class="title"> <a v-on:click="allRecords()"><i class="mdi mdi-chevron-left"></i></a> {{ __('common.library') }} <i class="mdi mdi-format-list-bulleted"></i></p>
                      #include('library.list')
                    </div>
                  </div>
                  -->

                  <div class="col-md-12">

                    <div class="dataset-visual edit-create">

                      <div class="tab-content full-height">
                        <!-- @ include('library.details') -->

                        <div v-if="form.library == 'chartjs'" class="collapse" id="table">
                          @include('datasets.table')
                        </div>

                        <div id="chart" class="tab-pane fade in active full-height">
                          <h2 class="text-center"> @{{ form.title }} </h2>
                          @include('datasets.show')
                          <p ng-bind-html-unsafe="lyrics"  class="px-5 pb-3"  style="{{ (App::getLocale() == 'ar') ? 'text-align:right' :  'text-align:left' }}">
                            <span v-html="form.description"></span>
                          </p>
                        </div>
                        <!-- Show liberary options
                        foreach(config('pcbs.libraries') as $library)
                          <div id="{ library }" class="data-libraries hidden-print" v-if="form.library == '{ library }'">
                            includeIf('datasets.public_options.' . $library . '')
                          </div>
                        endforeach
                              -->
                      </div>
                    </div>

                  </div>

                </div><!-- edit-create -->

              </div>









              <!-- <div class="row">
                  <div class="col-md-12">
                      @ include('library.indicators')
                  </div>
              </div>-->

              <!-- @ include('library.topics') -->

            </div>
            <!-- /single -->



            <!-- index page -->
            <div v-else>
              @if(count($record->datasets) != 0)
                <div  class="row">
                  <div class="col-md-10">
                    <ais-input id="searchabd2" style="margin-bottom: 20px" placeholder="{{ __('common.filterdatasets') }}" :class-names="{
    'ais-input': 'form-control',
    }">
                    </ais-input>
                  </div>
                  <div class="col-md-2">
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
                </div>

                <script2>
                  document.getElementById("searchabd2").value = "";
                </script2>
              @endif
              <ais-results :results-per-page="18" class="row">
                <template scope="{ result }">
                  <div class="column col-md-4" style="padding-bottom: 20px">
                    <div class="panel panel-default panel-body d-md-flex" @click.prevent="getRecord(result.id)">

                      <div class="panel-head">
                        <h6 class="text-capitalize title">
                          <span v-text="result.title"></span>
                        </h6>
                        <span class="item-id label">@{{ result.id }}</span>
                      </div>

                      <div>
                        <p> @{{ result.description }} </p>
                      </div>

                      <div class="panel-meta">
                        <div class="form-row">
                          <div class="col-md-12">
                            <p v-if="result.topics" class="meta-title">{{ __('common.topics') }}</p>
                            <p class="meta-text-wrapper"><span v-for="topic in result.topics" class="meta-text" v-text="topic.title"></span></p>
                          </div>
                          <!-- <div class="col-md-6 col-lg-6 col-xs-4 col-xl-4">
                            <p v-if="result.periods" class="meta-title"> __('common.periods') }}</p>
                            <p><span v-for="period in result.periods" class="meta-text"  v-text="period.title"></span></p>
                          </div> -->
                          <!--div class="col-md-6">
                            <p class="meta-title"  v-if="result.user != null" >{{ __('common.created_by') }}</p>
                            <p class="meta-text-wrapper"><span class="meta-text"  v-if="result.user != null" >@{{ result.user.name}}</span></p>
                          </div-->
                        </div>
                      </div>

                      <div class="panel-graph">
                        <img v-if="result.preview"  :src="getUrlBase()+'/'+result.preview">
                        <div v-else>@include('datasets.result_charts_placeholders')</div>
                      </div>

                    </div>
                  </div>
                </template>
              </ais-results>

                <ais-pagination
                        :class-names="{
    'ais-Pagination': 'MyCustomPagination',
    'ais-Pagination-list': 'MyCustomPaginationList',
  }"
                ></ais-pagination>

            </div>
            <!-- /index -->
          </ais-index>
        </div>
      </div>


    </datasets>

  </div>

  </div><!--Container-->
@endsection
