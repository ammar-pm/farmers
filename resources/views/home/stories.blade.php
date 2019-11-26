<div class="row">
    <div class="col-sm-12">
        <div class="widget text-center m-b-md">
            <div class="w-title">
                <h2>{{ __('common.lateststories') }}</h2>
            </div>
        </div>

        @foreach($stories as $story)
        <div class="col-sm-4">
            <div class="h caption-5 m-b-md">
                <figure style="min-height:200px">
                	@if(isset($story->image))
                	<img src="/storage/images/{{ $story->image }}">
                	@endif
                    <figcaption>
                        <div class="caption-box vertical-center-abs text-center text-white">
                            <h5>{{ $story->title }}</h5>
                            <p class="small">{!! $story->subline !!}</p> 
                            <a href="/stories/{{ $story->id }}" class="btn btn-blue m-b-0">{{ __('common.readmoree') }}</a>
                        </div>
                    </figcaption>
                </figure>
            </div>
        </div>
        @endforeach
             
    </div>
</div>