@extends('layouts.site')
@section('content')
        

  @include('home.search')


  @if(count($topics))
    @include('home.topics')
  @endif

  <!-- if(count($indicators))
    include('home.indicators')
  endif-->


  <!-- @if(count($news) == 3)
  <div class="row m-t-md">
          @ include('home.news')
  </div>
  @endif -->

  <!-- @if(count($stories) == 3)
  <div class="row m-t-md">
          @ include('home.stories')
  </div>
  @endif -->

@endsection
