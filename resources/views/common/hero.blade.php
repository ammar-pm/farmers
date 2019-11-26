@if(Request::is('/'))
    
  <section class="hero hero-countdown bg-primary">
       <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">

                    <h1 class="text-white m-t-lg">{{ Config::get('home_title_' . App::getLocale() . '') }}</h1>
                    <p class="lead">{!! Config::get('home_description_' . App::getLocale() . '') !!}</p>
                    {!! Config::get('home_ctas_' . App::getLocale() . '') !!}

                </div>
            </div>
        </div><!-- /End Container -->
    </section>
    <!-- /End Hero Section -->

@else

<section class="page-head bg-img p-y-md hero-countdown hidden-print">
            <div class="overlay"></div>
            <div class="container">
                <div class="row c2 h-bg text-white m-t-md">
                    <div class="col-sm-12 text-center">
                        <h1 class="h3 f-w-900 m-b-0">{{ $title }}</h1>
                        @if(isset($subline))
                            <p class="lead">{{ $subline }}</p>
                        @endif
                    </div>
                </div>
            </div>
</section>
<!-- /End Page Header -->

@endif

