@extends('layouts.site')
@section('content')

<div class="page-cover library-cover hidden-print">
  
  <div class="container">
    
    <div class="cover-content">
      
        <h1> {{ __('common.library') }} </h1>
        <div class="breadcrumbs">
            <a href="/"> {{ __('common.home') }} </a> / @if(!empty($record->title)) <span> {{ $record->title }} </span> @else <span> {{ __('common.library') }} </span> @endif
        </div>
          
    </div>

  </div>

</div>

<div class="gray-bg">

  <datasets :user="user"
                :ds_id="{{ json_encode($ds_id) }}"
                :app_local="{{ json_encode(App::getLocale()) }}"
                inline-template>

    <div class="container">

      <ais-index app-id="{{ env('ALGOLIA_APP_ID') }}"
                          api-key="{{ env('ALGOLIA_SEARCH_KEY') }}"
                          urlSync="true"
                          query="{{ Request::get('q') }} "
                          :query-parameters="{
                            filters: 'language:{{ App::getLocale() }} AND (public:Public) {{ empty($record->id)? '' : ' AND (topics.id: '.$record->id.')' }}   AND (url_base:indicators.ps) '
                          }"
                          index-name="datasets">


        <div class="py-4">

          <!-- single -->
          <div v-if="form.id" class="container">

              @include('library.actions')

              <div class="dataset-view" id="dataset-view">

                <div class="form-row">

                  <!-- <div class="col-md-2">
                    <div class="libraries-list">
                      <p class="title"> <a v-on:click="allRecords()"><i class="mdi mdi-chevron-left"></i></a> __('common.library') }} <i class="mdi mdi-format-list-bulleted"></i></p>
                      @ include('library.list')
                    </div>
                  </div> -->
                  
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
                          <p id="desc" class="px-5 pb-3"  style="{{ (App::getLocale() == 'ar') ? 'text-align:right' :  'text-align:left' }}">
                            <span v-html="form.description"></span>
                          </p>
                        </div>
                        
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
          <div v-else class="row">
            <div class="col-md-12">
              @include('library.sorts')
            </div>
            <div class="col-md-12">
              @include('library.filters')
              <!-- @ include('widgets.index') -->
            </div>
            <div class="col-md-12">
              <div class="grid-wrapper">
                  @include('library.grid')
              </div>
            </div>
          </div>
          <!-- /index -->



        </div><!--Row-->


      </ais-index>

    </div><!--Container-->

  </datasets>

</div>

@endsection