{{ csrf_field() }}

<div class="form-row filters">
  <div class="col">
    <select class="form-control" id="sort_option"  v-model="filters.sort_option"  name="sort_option" @change.prevent="get_searched_datasets">
      <option value="" hidden>{{ __('common.order_by') }}</option> <!-- hidden instead of selected disabled -->
      <option value="title">{{ __('common.name_of_dataset') }}</option>
      <option value="topics_abdo">{{ __('common.topic_for_sort')}}</option>
      <option value="user_name">{{ __('common.name_of_creator') }}</option>
      <option value="created_at">{{ __('common.date') }}</option>
      <option value="id">{{ __('common.dataset_id') }}</option>
      <option value=""> {{ __('common.any') }}</option>
    </select>
  </div>
  <div class="col">
    <select class="form-control" id="sort_option_type" v-model="filters.sort_option_type"  name="sort_option_type" @change.prevent="get_searched_datasets">
      <option value="" hidden>{{ __('common.order') }}</option>
      <option value="ASC">{{ __('common.ascending') }}</option>
      <option value="DESC">{{ __('common.descending') }}</option>
      <option value=""> {{ __('common.any') }}</option>
    </select>
  </div>
  <div class="col">
    <select class="form-control" id="sort_option_lang" v-model="filters.sort_option_lang"  name="sort_option_lang" @change.prevent="get_searched_datasets">
      <option value="" hidden> {{ __('common.file_lang') }}</option>
      <option value="en">{{ __('common.file_en') }}</option>
      <option value="ar">{{ __('common.file_ar') }}</option>
      <option value=""> {{ __('common.any') }}</option>
    </select>
  </div>
  <div class="col">
    <form v-on:submit.prevent="get_searched_datasets" class="search-form form-inline">
      <label for="searchbox"><i class="mdi mdi-magnify" aria-hidden="true"></i></label>
      <input type="text" placeholder="{{ __('common.search_name') }}" class="form-control" id="search_text" v-model="filters.search_text" name="search_text" data-toggle="tooltip" data-placement="top" title="You Can Search By Dataset Title or Creator's Name" :disabled="form.busy">
    </form>
    <!-- <button type="submit" class="btn btn-success text-uppercase" @click.prevent="get_searched_datasets" :disabled="form.busy">Search</button> -->
  </div>
  <div class="col">
    <!-- new Dataset -->
    <form id="new_dataset_form" action="#" @submit.prevent="createRecord()">
      <!-- <input type="text" class="form-control" v-model="createForm.title" placeholder="{{ __('common.choosetitle') }}" autofocus > -->
      <button type="submit" class="btn btn-primary btn-block" :disabled="createForm.busy">{{ __('common.newdataset') }}</button>
    </form>
    <!-- <alert v-if="createForm.successful" message="{{ __('common.saved') }}"></alert>
    <alert v-if="trash" message="{{ __('common.deleted') }}"></alert> -->
  </div>
  

</div>
