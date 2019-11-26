<!-- <div class="owl-carousel owl-theme text-center p-y"> 

        @ foreach($indicators as $indicator)
        <div class="item">
                
                @ if(isset($indicator->icon))
                    <img src="/storage/icons/{ $indicator->icon }">
                @ endif

                <h4 class="m-t">{ $indicator->value }</h4>
                <p class="lead">{ $indicator->title }</p>
        </div>
        @ endforeach

</div><--Carousel ->

@ push('plugins')
@ include('common.carousel')
@ endpush -->

<section class="indicators mb-5">
  <div class="container">

    <h3> {{ __('common.indicators') }} </h3>

    <ais-index app-id="{{ env('ALGOLIA_APP_ID') }}"
                       api-key="{{ env('ALGOLIA_SEARCH_KEY') }}"
                       urlSync="true"
                       query="{{ Request::get('q') }}"
                       :query-parameters="{
                                  filters: 'language:{{ App::getLocale() }} AND (public:Public) '
                                }"
                       index-name="datasets">

      <div class="row">


        <div class="col-lg-3 col-md-4">

          <ul class="indicators-list list-unstyled">

            <!-- <ais-refinement-list attribute-name="periods.title" :class-names="{
              'ais-refinement-list__value': 'filters-value',
              'ais-refinement-list__item--active': 'text-primary',
              'ais-refinement-list__count': 'hidden',
            }">
            <p slot="header">{{ __('common.periods') }}</p>
            </ais-refinement-list> -->

            <ais-refinement-list attribute-name="indicators.title" :class-names="{
            'ais-refinement-list__value': 'filters-value',
            'ais-refinement-list__item--active': 'text-primary',
            'ais-refinement-list__count': 'hidden',
            }">
            </ais-refinement-list>
            <!-- @ foreach($indicators as $indicator)
            
              <li>
                <a href="#">
                  @ if(isset($indicator->icon))
                    <img src="/storage/icons/{ $indicator->icon }">
                  @ endif
                  <span> { $indicator->title } </span>
                </a>
              </li>
            
            @ endforeach -->
          </ul>
        </div>

        <div class="col-lg-9 col-md-8">
          <div class="indicators-content">

            <div class="row refinements">

              <div class="col-md-8">
                <div class="ais-refinement-list__item text-primary ref-all">
                  <label class="ais-refinement-list__label">
                    <input type="checkbox" class="ais-refinement-list__checkbox" value="Featured">
                    <span class="filters-value">{{ __('common.all') }}</span>
                  </label>
                </div>

                <ais-refinement-list attribute-name="featured"
                                     :class-names="{
                  'ais-refinement-list__value': 'filters-value',
                  'ais-refinement-list__item--active': 'text-primary',
                  'ais-refinement-list__count': 'hidden',
                }">
                </ais-refinement-list>
              </div>

              <div class="col-md-4 text-right">
                <ais-input placeholder="{{ __('common.searchdatasets') }}"></ais-input>
              </div>

            </div>
            
            <ais-results class="">
              <template scope="{ result }">
               
                <h6 class="text-uppercase title">
                  <a :href="'/library#/dataset/' + result.id">
                    <span v-if="result.title.length > 40" v-text="result.title.substring(0,40) + '...'"></span>
                    <span v-else v-text="result.title"></span>
                  </a>  
                </h6>           

              </template>
            </ais-results>


          </div>
        </div>

      </div>

    </ais-index>

    
  </div>
</section>
