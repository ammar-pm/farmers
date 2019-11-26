<section class="p-y-md bg-edit bg-primary video content-align-md">
        <div class="container">
            <div class="row ">    
                <div class="col-md-12 y-middle c2">
                    <div class="col-md-6 text-white lead">
                        {!! Config::get('home_featured_description_' . App::getLocale() . '') !!}
                    </div>
                    <!-- Video Image with Popup -->
                    <div class="col-md-4 col-md-offset-1">
                        <div class="popup-box">
                            <img src="{{ Config::get('home_featured_video_thumbnail') }}" class="img-responsive">
                            <div class="popup-button wow pulse" data-wow-iteration="3">
                                <a class="mp-iframe" href="{{ Config::get('home_featured_video_' . App::getLocale() . '') }}"><i class="fab fa-youtube fa-3x"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- /End Col-12 -->
            </div><!-- /End Row -->
        </div><!-- /End Container -->
</section>