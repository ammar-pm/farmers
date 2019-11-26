@extends('layouts.site')
@section('content')


<div class="page-cover topics-cover">
  
  <div class="container">
    
    <div class="cover-content">
      
        <h1> {{ __('common.topics') }} </h1>
        <div class="breadcrumbs">
            <a href="/"> {{ __('common.home') }} </a> / <span> {{ __('common.topics') }} </span>
        </div>
          
    </div>

  </div>

</div>

<div class="container">
    <div class="page topics py-4">

        <div class="topics-wrapper">

          <div class="row">
            
            @foreach($records as $topic)
              <div class="col-lg-3 col-md-4 topic">
                <div class="image-wrapper">
                @if(isset($topic->image))
                  <img src="/storage/images/{{ $topic->image }}">
                @endif
                </div>
                <div class="content-wrapper">
                  <p> {{ $topic->title }} </p>
                  <a href="/topics/{{ $topic->id }}"> {{ __('common.view_datasets') }} <i class="mdi mdi-chevron-right"></i></a>
                </div>
                <!-- <a href="#topic_{{ $topic->id }}" role="tab" data-toggle="tab" class="text-edit"></a> -->
              </div>
            @endforeach

          </div>

        </div> 

    </div>
</div>


@endsection
