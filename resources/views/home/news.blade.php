        <section id="blog3-1" class="p-y-lg blog bg-edit">
            <div class="container">
                <!-- Section Header -->
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-header text-center wow fadeIn">
                            <h2>{{ __('common.latestnews') }}</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 content-block c2">

                        @foreach($news as $article)
                        <!-- Blog Post -->
                        <div class="col-sm-6">

                            @if(isset($article->image))
                            <a href="/news/{{ $article->id }}"><img src="/storage/images/{{ $article->image }}" class="img-responsive img-rounded"></a>
                            @endif

                            <div class="post-info">
                                <div class="date text-edit">
                                    {{ $article->date }}
                                </div>
                                <a href="/news/{{ $article->id }}"><h5>{{ $article->title }}</h5></a>

                                @if(isset($article->user))
                                <h6 class="p-opacity">By {{ $article->user->name }}</h6>
                                @endif

                            </div>
                            <p class="p-opacity">{{ $article->summary }}</p>
                            <a href="/news/{{ $article->id }}" class="more-link edit">{{ __('common.continuereading') }}</a>
                        </div>
                        @endforeach

                  
                </div>

                
        
        </section>