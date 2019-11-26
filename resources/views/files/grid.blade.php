<div v-for="record in records" class="column col-md-6 col-lg-6 col-xl-4">
  <div class="panel panel-default d-md-flex">

    <div class="panel-head">
      <h6 class="text-capitalize title">
        <a v-bind:href="'/files/'+record.id+'/edit'">
          <span v-text="record.title"></span>
        </a>
      </h6>
      <span class="item-id label">@{{ record.id }}</span>
    </div>
    
    <div class="panel-meta">
      <div class="form-row">
        <div class="col-md-6">
          <p class="meta-title"> @{{ record.user_name }} </p>
          <p class="meta-text"> @{{ record.created_at | moment("MMMM Do YYYY") }} </p>
        </div>
        <div class="col-md-6 text-right file-controls">
          <a v-on:click="toggleShowDeleteConfirmation(record.id, record.title)" href="#" class="btn btn-xs btn-delete"><i class="mdi mdi-trash-can-outline"></i></a>
          <a v-bind:href="'/datasets/file/download/'+record.id" :download="record.title" class="btn btn-xs btn-download"><i class="mdi mdi-cloud-download-outline"></i></a>
        </div>

        <!-- <div class="col-md-6">
          <p class="meta-title">{{ __('common.uploaded_by') }}</p>
          <p class="meta-text"> @{{ record.user_name }} </p>
        </div> -->
      </div>
    </div>

    <div class="panel-actions">
      <p class="small-text">{{ __('common.topics') }}</p>
      <p class="file-topics"><span v-for="topic in record.topics" class="file-topic" v-text="topic.title"></span></p>
    </div>
    
  </div>
</div>