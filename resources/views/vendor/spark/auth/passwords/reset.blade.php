@extends('spark::layouts.auth')

@section('content')
<div class="container">
  <div class="row card-wrapper">
    <div class="col-md-6">

      <div class="card p-4">
        <div class="card-body">
          
          <div class="text-center">
            <img src="/img/mzr3ty-logo-2x.png" title="mzr3ty" alt="mzr3ty" class="logo">
            <h1>{{ __('common.resetpassword') }}</h1>
            <p class="text-muted">{{ __('common.resetpasswordـtagline') }}</p>
          </div>

          <form role="form" method="POST" action="{{ url('/password/reset') }}">
          {!! csrf_field() !!}

            <input type="hidden" name="token" value="{{ $token }}">

            <!-- E-Mail Address -->
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <!-- <label class="col-md-4 control-label">{{ __('common.email') }}</label> -->
              <div class="input-group">
                <input type="email" class="form-control" name="email" placeholder="{{ __('common.email') }}" value="{{ $email or old('email') }}" autofocus>

                @if ($errors->has('email'))
                  <span class="help-block">
                    {{ $errors->first('email') }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Password -->
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <!-- <label class="col-md-4 control-label">{{ __('common.password') }}</label> -->

              <div class="input-group">
                <input type="password" class="form-control" placeholder="{{ __('common.password') }}" name="password">

                @if ($errors->has('password'))
                  <span class="help-block">
                    {{ $errors->first('password') }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Password Confirmation -->
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <!-- <label class="col-md-4 control-label">{{ __('common.confirmpassword') }}</label> -->
              <div class="input-group mb-5">
                <input type="password" class="form-control" placeholder="{{ __('common.confirmpassword') }}" name="password_confirmation">

                @if ($errors->has('password_confirmation'))
                  <span class="help-block">
                    {{ $errors->first('password_confirmation') }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Reset Button -->
            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                {{ __('common.resetpassword') }}
              </button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection
