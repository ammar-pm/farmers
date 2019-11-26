<ais-results :results-per-page="18" class="row">
   <template scope="{ result }">

      <div class="col-md-6 col-lg-4 m-y-md">

        <div class="panel panel-default panel-body d-md-flex" @click.prevent="getRecord(result.id)">

          <div class="panel-head">
            <h6 class="text-capitalize title">
              <span v-text="result.title"></span>
            </h6>
            <span class="item-id label">@{{ result.id }}</span>
          </div>

          <div v-if="result.description">
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
            @if(isset($record->id) and !empty($record->id))
              <img :src="'/'+result.preview">
            @else
              <img v-if="result.preview" :src="getUrlBase()+'/'+result.preview">
              <div v-else>@include('datasets.result_charts_placeholders')</div>
            @endIf
          </div>

        </div>

      </div>




        <!-- <div class="panel panel-default">

        <div class="panel-heading bg-primary">
           <a v-text="result.title" @click.prevent="getRecord(result.id)" href="#"></a>
        </div>

        <div class="panel-body"> -->
 <!--           
           <div v-if="result.tags">

               <p>
                  <span v-for="tag in result.tags" :key="tag.id" class="label label-primary text-uppercase m-r-sm">
                    <a v-text="tag.name" :href="'/library?q='+tag.name+''" style="color:#fff"></a>
                 </span>
               </p>

           </div>

           <p v-text="result.description"></p>

           <div v-if="result.topics">

               <div class="row">
               
               <div v-for="topic in result.topics" :key="topic.id" class="col-md-4 text-center">
                 <p><a class="text-primary text-uppercase m-r-sm" v-text="topic.title" :href="'/topics/'+topic.id+''"></a></p>
               </div>

                </div>

           </div>

           <div v-if="result.governorates">

               <span v-for="governorate in result.governorates" :key="governorate.id" class="label label-success text-uppercase m-r-sm">
               <a v-text="governorate.title" :href="'/governorates/'+governorate.id+''" style="color:#fff"></a>
               </span>

           </div>-->

           <!-- <div v-if="form.preview">
            <img :src="form.preview" class="img-responsive">
           </div>
           
           <div v-else>
            <a @ click.prevent="getRecord(result.id)" href="#"><img src="/landing/images/chart-placeholder.png" class="img-responsive"></a>
           </div> -->
           <!--Preview-->
           

              <!-- </div>
            </div>
        </div>
      </div> -->
     
   </template>
</ais-results>

<ais-pagination
   :class-names="{
    'ais-Pagination': 'MyCustomPagination',
    'ais-Pagination-list': 'MyCustomPaginationList',
  }"
></ais-pagination>
