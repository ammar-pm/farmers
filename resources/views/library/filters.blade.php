<div class="library-filters mt-3">
  <!-- <ais-refinement-list attribute-name="periods.title" :class-names="{
    'ais-refinement-list__value': 'filters-value',
    'ais-refinement-list__item--active': 'text-primary',
    'ais-refinement-list__count': '',
  }">
    <b slot="header">{{ __('common.periods') }}</b>
  </ais-refinement-list> -->

  <ais-refinement-list class="clearfix" attribute-name="topics.title" limit=50 :class-names="{
    'ais-refinement-list__value': 'filters-value',
    'ais-refinement-list__item--active': 'text-primary',
    'ais-refinement-list__count': '',
  }">
    <div class="mb-2" slot="header"><b>{{ __('common.topics') }}</b></div>
  </ais-refinement-list>

  <!-- <ais-refinement-list attribute-name="governorates.title" :class-names="{
    'ais-refinement-list__value': 'filters-value',
    'ais-refinement-list__item--active': 'text-primary',
    'ais-refinement-list__count': '',
  }">
    <b slot="header" class="m-t-md">{{ __('common.governorates') }}</b>
  </ais-refinement-list> -->

  <!-- <ais-refinement-list attribute-name="indicators.title" :class-names="{
    'ais-refinement-list__value': 'filters-value',
    'ais-refinement-list__item--active': 'text-primary',
    'ais-refinement-list__count': '',
  }">
    <b slot="header" class="m-t-md">{{ __('common.indicators') }}</b>
  </ais-refinement-list> -->

  <!-- <ais-refinement-list attribute-name="tags.name" :class-names="{
    'ais-refinement-list__value': 'filters-value',
    'ais-refinement-list__label': 'text-capitalize',
    'ais-refinement-list__item--active': 'text-primary',
    'ais-refinement-list__count': '',
  }">
    <b slot="header" class="m-t-md">{{ __('common.tags') }}</b>
  </ais-refinement-list> -->


  <ais-clear :class-names="{
      'ais-clear': 'btn btn-danger',
  }">

    <span class="ais-clear__label"><i class="fa fa-times fa-fw"></i> {{ __('common.clear') }}</span>
  </ais-clear>
</div>
