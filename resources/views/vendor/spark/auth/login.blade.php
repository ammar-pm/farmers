@extends('spark::layouts.auth')

@section('content')
<div class="container">

  <div class="row card-wrapper">
    <div class="col-md-6">

      <div class="card p-4">
        <div class="card-body">
          <div class="text-center">
            <img src="/img/indicators-logo.png" alt="Indicators.ps">
            <h1>{{ __('common.signin_title') }}</h1>
            <p class="text-muted">{{ __('common.signin_tagline') }}</p>
          </div>
          

          @include('spark::shared.errors')

          <form class="" role="form" method="POST" action="/login">
            {{ csrf_field() }}
            <div class="input-group">
              <input class="form-control" type="text" name="email" placeholder="{{ __('common.email') }}" value="{{ old('email') }}" autofocus>
            </div>
            <div class="input-group">
              <!-- <label>{{ __('common.password') }}</label> -->
              <input class="form-control" type="password" name="password" placeholder="{{ __('common.password') }}">
            </div>

            <div class="text-right form-group">
              <a href="{{ url('/password/reset') }}">{{ __('common.forgotyourpassword') }}</a>
            </div>

            <div class="form-group">
              <button class="btn btn-primary px-4" type="submit">{{ __('common.login') }}</button>
            </div>

          </form>

          <div class="text-center">

            <div>
              <p> {{ __('common.no_account') }} 
              <a href="/register" class="">{{ __('common.signup') }}</a> </p>
            </div>

            <div class="social-login">
              <p class="text-uppercase">{{ __('common.or') }}</p>
              <p>{{ __('common.social_signin') }}</p>

              <a href="/redirect" class="">
                <i class="mdi mdi-facebook-box"></i><span>{{ __('common.facebook') }}</span>
              </a>

              <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="" >
                <i class="mdi mdi-google"></i><span>{{ __('common.google') }}</span>
              </a>
            </div>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>

@endsection
