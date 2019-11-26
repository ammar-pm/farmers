<section class="p-y">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="section-header text-center wow fadeIn">
                            <h2>{{ __('common.featureddatasets') }}</h2>
                        </div>
                    </div>
                </div>

                <div class="row c3">

                    @foreach($datasets as $dataset)
                    <div class="col-md-6 m-t-md">
                        <div class="path bg-edit bg-primary center-md">
                            <div class="vertical-center-rel text-white text-center">

                               <h4 class="f-w-900">
                               	<a href="/library#/dataset/{{ $dataset->id }}">{{ str_limit($dataset->title, 30) }}</a>
                               </h4>

                                <p>
                                @foreach($dataset->topics as $topic)
                                	<span class="label label-success">{{ $topic->title }}</span>
                                @endforeach
                            	</p>

                                @if(!empty($dataset->description))
                                <p>{!! $dataset->description !!}</p>
                                @endif

                            </div>
                        </div>
                    </div>


                    @endforeach

                   
                </div><!--Row -->
            </div><!--Container -->
        </section>   