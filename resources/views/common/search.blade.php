<li><input type="text" class="form-control" id="search" placeholder="{{ __('common.search') }}"></li>


@push('plugins')

<link rel="stylesheet" href="/css/search.css">
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.jquery.min.js"></script>
<script>
  var client = algoliasearch('{{ env('ALGOLIA_APP_ID') }}', '{{ env('ALGOLIA_SEARCH_KEY') }}');

  var search_datasets = client.initIndex('datasets');

  $('#search').autocomplete({ hint: true, autoselect: true, debug: true}, [
    {
      source: $.fn.autocomplete.sources.hits(search_datasets, { hitsPerPage: 10 }),
      displayKey: 'name',
      templates: {
        suggestion: function(suggestion) {
            return '<a href="/library#/dataset/'+suggestion.id+'">'+suggestion._highlightResult.title.value+'</a>'
        }
      }
    }
  ]).on('autocomplete:selected', function(event, suggestion, dataset) {
      location.reload();
  });
</script>

@endpush