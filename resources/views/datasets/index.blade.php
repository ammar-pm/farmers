@extends('spark::layouts.admin')
@section('content')

<!-- /Datasets -->
<datasets :user="user"
          :app_local="{{ json_encode(App::getLocale()) }}"
          inline-template>

  <div class="main">

    <div class="container-fluid" id="dataset-view">

      @include('datasets.actions')
      <!--
      code added for html2canvas testing
        <div>
          <div ref="capture">
            <h1>Print me!</h1>
          </div>
          <div id="img-out"></div>
        </div>
        <button class="btn btn-dark" @click="printt()">capture</button>
      -->


      <div v-if="form.id" class="dataset-view">

        <!-- <div class="row m-t-md"> -->

        <div class="form-row">

          <div class="col-md-2" v-if="user.role != 'admin'">
            <div class="libraries-list">
              <p> {{ __('common.library') }} <i class="mdi mdi-format-list-bulleted"></i></p>
              <ul>
                <!-- <li v-for="file in files"> @{{ file.name }} </li> -->
              </ul>
            </div>
          </div>
          
          <div :class="user.role != 'admin' ? 'col-md-10' : 'col-md-12'">
            <div class="dataset-visual edit-create" :class="user.role != 'admin' ? 'editor' : ''">
              <div class="tab-content full-height">

                <div class="file-libraries" v-if="user.role != 'admin'">
                  <span v-for="topic in form.topics"> @{{ topic.title }} </span>
                </div>

                <div @click="hideTabs()" id="chart" class="tab-pane fade in active full-height">
                  <div class="panel panel-default panel-body full-height">
                    <h2 class="m0 text-center heading">@{{form.title}} ID:@{{form.id}}</h2>
                    @include('datasets.show')
                  </div>
                </div>

                <div id="table" class="tab-pane fade" v-if="form.library == 'chartjs' || 'highcart'">
                  <div class="panel panel-default panel-body" style="overflow-x:auto">
                    <h2 v-text="form.title" class="m0 text-center"></h2>
                    @include('datasets.table')
                  </div>
                </div>

              </div><!--TabContent-->

              <div class="dataset-wizard" v-if="user.role == 'admin'" :class="tabsOn ? 'active' : ''">
                <div class="tabs-toggle" @click="toggleTabs()">
                  <i class="mdi mdi-chevron-down"></i>
                  <i class="mdi mdi-chevron-up"></i>
                </div>
                @include('datasets.form')
              </div>

            </div>
          </div>

        </div><!-- edit-create -->

        <!-- </div> -->

      </div><!--FormIf-->

      <div class="grid-wrapper" v-else>

        <!-- @{{chartobject}} -->
        <!-- <div class="row"> -->
          <!-- <div class="col-md-2" style="padding-right: 0px;padding-left: 10px">
            <div class="panel panel-default panel-body">
              @include('datasets.filters')
            </div>
          </div> -->
        <div class="row grid-view">
          @include('datasets.grid')
        </div>

        <div class="list-view hidden">
          <!-- @ include('datasets.list') -->
         
          <!-- <datatable :columns="$records" :data="records.data"></datatable> -->
          <!-- <datatable v-bind="$records" /> -->
          <!-- <custom-data-table :rows="$records" ></custom-data-table>  -->
         
        </div>
        <!-- </div> -->
        <!--Row-->
        <div class="pagination-wrapper text-right">
          <pagination id='1' :records="rec_size" v-model="page" :per-page="18" @paginate="clickCallback(page)"></pagination>
        </div>

      </div><!--Row end else-->

    </div><!--Container-->

  </div>

</datasets>

@endsection