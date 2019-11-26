{{ csrf_field() }}

<div class="form-group">
  <label>Search</label>
  <input type="text" class="form-control" id="search_text"    v-model="filters.search_text" name="search_text" data-toggle="tooltip" data-placement="top" title="You Can Search By Dataset Title or Creator's Name">
</div>

<div class="form-group">
  <label for="sel1">Order:</label>
  <select class="form-control" id="sort_option"  v-model="filters.sort_option"  name="sort_option">
    <option value="title">Name of Dataset</option>
    <option value="topics_abdo">Topic</option>
    <option value="user_name">Name of Creator</option>
    <option value="created_at">Date</option>
    <option value="id">Dataset Id</option>
  </select>
</div>

<div class="form-group">
  <label for="sel1">Order type</label>
  <select class="form-control" id="sort_option_type" v-model="filters.sort_option_type"  name="sort_option_type">
    <option value="ASC">Ascending</option>
    <option value="DESC">Descending</option>
  </select>
</div>

<button type="submit" class="btn btn-success text-uppercase" @click.prevent="get_searched_datasets" :disabled="form.busy">Search</button>
