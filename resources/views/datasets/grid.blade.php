<div v-for="record in records" class="column col-md-6 col-lg-6 col-xl-4">
  <div class="panel panel-default panel-body d-md-flex" @click.prevent="getRecord(record.id)">

    <div class="panel-head">
      <h6 class="text-capitalize title">
        <span v-text="record.title"></span>
      </h6>
      <span class="item-id label">@{{ record.id }}</span>
    </div>
    
    <div class="panel-meta">
      <div class="form-row">
        <div class="col-md-6 col-lg-6 col-xs-3 col-xl-3">
          <p v-if="record.topics" class="meta-title">{{ __('common.topics') }}</p>
          <p><span v-for="topic in record.topics" class="meta-text" v-text="topic.title"></span></p>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-3 col-xl-3">
          <p v-if="record.periods" class="meta-title">{{ __('common.periods') }}</p>
          <p><span v-for="period in record.periods" class="meta-text"  v-text="period"></span></p>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-3 col-xl-3">
          <p class="meta-title"> {{ __('common.created_at') }} </p>
          <p class="meta-text">@{{ record.created_at.date | moment("ddd, MMMM Do YYYY") }}</p>
        </div>
        <div class="col-md-6 col-lg-6 col-xs-3 col-xl-3">
          <p class="meta-title"  v-if="record.user != null" >{{ __('common.created_by') }}</p>
          <p><span class="meta-text"  v-if="record.user != null" >@{{ record.user.name}}</span></p>
        </div>
      </div>
    </div>

    <div class="panel-graph">      
      <img v-if="record.preview" :src="record.preview">
      <div v-else>@include('datasets.record_charts_placeholders')</div>
    </div>

  </div>
</div>
