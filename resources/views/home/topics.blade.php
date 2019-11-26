<section class="p-y topics">
    <div class="container">
        <div class="topics-wrapper">

            <h3> {{ __('common.datasets_by_topics') }} </h3>

            <div class="row">



                @foreach($topics as $topic)
                    <div class="col-lg-3 col-md-4 topic">
                        <div class="image-wrapper" style="display: inline;">
                            @if(isset($topic->image))
                                <a href="/library/{{ $topic->id }}"><img src="/storage/images/{{ $topic->image }}" height="100" width="100"/></a>
                            @endif
                        </div>
                        <div class="content-wrapper">
                            <a href="/library/{{ $topic->id }}"><p> {{ $topic->title }} </p></a>
                        </div>

                    <!-- <a href="#topic_{{ $topic->id }}" role="tab" data-toggle="tab" class="text-edit"></a> -->
                    </div>
                @endforeach


            </div>

        <!--a href='/topics' class="view-all"> {{ __('common.view_all_topics') }} <i class="mdi mdi-chevron-right"></i></a-->
        </div>

    </div>
</section>
