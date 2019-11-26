@extends('spark::layouts.auth')

<!-- Main Content -->
@section('content')
<div class="container">
  <div class="row card-wrapper">
    <div class="col-md-6">

      <div class="card p-4">
        <div class="card-body">
          
          <div class="text-center">
            <img src="/img/indicators-logo.png" alt="Indicators.ps">
            <h1>{{ __('common.forgotpassword_title') }}</h1>
            <p class="text-muted">{{ __('common.forgotpassword_tagline') }}</p>
          </div>
          
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <form class="" role="form" method="POST" action="{{ url('/password/email') }}">
          {!! csrf_field() !!}

            <!-- E-Mail Address -->
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <!-- <label class="col-md-4 control-label">{{ __('common.email') }}</label> -->

              <div class="input-group">
                <input type="email" class="form-control" name="email" placeholder="{{ __('common.email') }}" value="{{ old('email') }}" autofocus>

                @if ($errors->has('email'))
                  <span class="help-block">
                    {{ $errors->first('email') }}
                  </span>
                @endif
              </div>

            </div>

            <!-- Send Password Reset Link Button -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                {{ __('common.sendpwresetlink') }}
              </button>
            </div>
          </form>

          <div class="text-center">

            <a href="/login">{{ __('common.backtosignin') }}</a> </p>

          </div>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection
