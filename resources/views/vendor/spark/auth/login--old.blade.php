@extends('spark::layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('common.login') }}</div>

                <div class="panel-body">
                    @include('spark::shared.errors')

                    <form class="form-horizontal" role="form" method="POST" action="/login">
                        {{ csrf_field() }}

                        <!-- E-Mail Address -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('common.email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('common.password') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ __('common.rememberme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa m-r-xs fa-sign-in"></i> {{ __('common.login') }}
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ __('common.forgotyourpassword') }}</a>
                            </div>
                        </div>
                    </form>

                        <hr>

                        <div class="text-center">

                        <p>{{ __('common.or') }}</p>

                        <p><a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-primary-outline btn-lg" ><i class="fa fa-google fa-fw"></i> {{ __('common.loginwithgoogle') }}</a></p>
                        <p><a href="/redirect" class="btn btn-primary-outline btn-lg"><i class="fa fa-facebook-official fa-fw"></i> {{ __('common.loginwithfacebook') }}</a></p>

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
