<div class="main-search">
  
  <div class="container">
    
    <div class="search-content">
      <div class="row justify-content-center" style="text-align:center">
        <div class="col-md-8">
          <h2> {{ __('common.indicators_open_datasets') }} </h2>
          <div class="form-wrapper">
            
            <form autocomplete="off" action="/library" method="GET" class="my-2 my-lg-0 search-form">
              <input name="q" id="searchbox" class="form-control mr-sm-2" type="search" placeholder="{{ __('common.search') }}" aria-label="Search">
              <button type="submit"><i class="mdi mdi-magnify" aria-hidden="true"></i></button>
            </form>

          </div>
          <p> {{ __('common.search_disclaimer')}} </p> 
        </div>
      </div>
    </div>

  </div>

</div>
