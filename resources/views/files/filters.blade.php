{{ csrf_field() }}

<div class="row mb-4">
  <div class="col-md-3">
    <h1> {{ __('common.files') }} </h1>
  </div>

  <div class="col-md-9 text-right">
    <div class="form-row filters">

      <div class="col">
        <div class="form-group">
          <select class="form-control" id="sort_option"  v-model="filters.sort_option"  name="sort_option" @change.prevent="get_searched_files">
            <option value="" hidden>{{ __('common.order_by') }}</option>
            <option value="title">{{ __('common.title_of_file')}}</option>
            <option value="topics_abdo">{{ __('common.topic_for_sort')}}</option>
            <option value="user_name">{{ __('common.name_of_creator')}}</option>
            <option value="created_at">{{ __('common.date')}}</option>
            <option value="id">{{ __('common.file_id')}}</option>
            <option value=""> {{ __('common.any') }}</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <select class="form-control" id="sort_option_type" v-model="filters.sort_option_type"  name="sort_option_type" @change.prevent="get_searched_files">
            <option value="" hidden>{{ __('common.order') }}</option>
            <option value="ASC">{{ __('common.ascending')}}</option>
            <option value="DESC">{{ __('common.descending')}}</option>
            <option value=""> {{ __('common.any') }}</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <select class="form-control" id="sort_option_lang" v-model="filters.sort_option_lang"  name="sort_option_lang" @change.prevent="get_searched_files">
            <option value="" hidden>{{ __('common.file_lang') }}</option>
            <option value="en">{{ __('common.file_en') }}</option>
            <option value="ar">{{ __('common.file_ar') }}</option>
            <option value="">{{ __('common.any') }}</option>
          </select>
        </div>
      </div>

      <div class="col">
        <div class="form-group">
          <!-- <label>{{ __('common.search')}}</label>
          <input type="text" class="form-control" id="search_text" v-model="filters.search_text" name="search_text" data-toggle="tooltip" data-placement="top" title="{{ __('common.search_title')}}" @change.prevent="get_searched_files"> -->
         
          <form v-on:submit.prevent="get_searched_files" class="search-form form-inline">
            <label for="searchbox"><i class="mdi mdi-magnify" aria-hidden="true"></i></label>
            <input type="text" placeholder="{{ __('common.search_name') }}" class="form-control" id="search_text" v-model="filters.search_text" name="search_text" data-toggle="tooltip" data-placement="top" title="{{ __('common.search_title')}}">
          </form>

        </div>
      </div>

      <div class="col">
        <button v-on:click="toggleShowForm" class="btn btn-primary btn-block text-uppercase" id="addfile-btn">{{ __('common.addfile')}}</button>
      </div>

    </div>
  </div>
</div>
