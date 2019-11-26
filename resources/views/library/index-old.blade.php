@extends('layouts.site')
@section('content')

<datasets :user="user"
              :app_local="{{ json_encode(App::getLocale()) }}"
              inline-template>

  <div class="container">

    <ais-index app-id="{{ env('ALGOLIA_APP_ID') }}"
                       api-key="{{ env('ALGOLIA_SEARCH_KEY') }}"
                       urlSync="true"
                       query="{{ Request::get('q') }}"
                       :query-parameters="{
             facetFilters: ['language:{{ App::getLocale() }}']
           }"
                       index-name="datasets">


      <div class="row m-t-md">

        <!-- single -->
        <div v-if="form.id">

            <div class="row">
                <div class="col-md-12">
                    @include('library.indicators')
                </div>
            </div>

            <div class="row">

                <div class="col-md-1">
                    @include('library.actions')
                </div>

                <div class="col-md-11">

                    @include('library.details')

                    <div v-if="form.library == 'chartjs'" class="collapse" id="table">
                        @include('datasets.table')
                    </div>

                    @include('datasets.show')
                    <!-- Show liberary options -->
                    @foreach(config('pcbs.libraries') as $library)
                        <div id="{{ $library }}" class="data-libraries" v-if="form.library == '{{ $library }}'">
                            @includeIf('datasets.options.' . $library . '')
                        </div>
                    @endforeach

                </div><!--Col-->

            </div><!--Row-->

            @include('library.topics')

        </div>
        <!-- /single -->



        <!-- index page -->
        <div v-else class="row">
          <div class="col-md-3">
            @include('library.filters')
            <!-- @ include('widgets.index') -->
          </div>
          <div class="col-md-9">
            @include('library.sorts')
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

@endsection