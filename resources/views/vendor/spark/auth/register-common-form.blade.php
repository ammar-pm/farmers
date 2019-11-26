<form class="" role="form">
  @if (Spark::usesTeams() && Spark::onlyTeamPlans())
    <!-- Team Name -->
    <div class="form-group" :class="{'has-error': registerForm.errors.has('team')}" v-if=" ! invitation">
      <label class="col-md-4 control-label">{{ ucfirst(Spark::teamString()) }} Name</label>

      <div class="col-md-6">
        <input type="text" class="form-control" name="team" v-model="registerForm.team" autofocus>

        <span class="help-block" v-show="registerForm.errors.has('team')">
          @{{ registerForm.errors.get('team') }}
        </span>
      </div>
    </div>

    @if (Spark::teamsIdentifiedByPath())
      <!-- Team Slug (Only Shown When Using Paths For Teams) -->
      <div class="form-group" :class="{'has-error': registerForm.errors.has('team_slug')}" v-if=" ! invitation">
        <label class="col-md-4 control-label">{{ ucfirst(Spark::teamString()) }} Slug</label>
        <div class="col-md-6">
          <input type="text" class="form-control" name="team_slug" v-model="registerForm.team_slug" autofocus>

          <p class="help-block" v-show=" ! registerForm.errors.has('team_slug')">
            This slug is used to identify your {{ Spark::teamString() }} in URLs.
          </p>
          <span class="help-block" v-show="registerForm.errors.has('team_slug')">
            @{{ registerForm.errors.get('team_slug') }}
          </span>
        </div>
      </div>
    @endif

  @endif

  <!-- Name -->
  <div class="input-group" :class="{'has-error': registerForm.errors.has('name')}">
    <!-- <label class="col-md-4 control-label">{{ __('common.name') }}</label> -->

    <input type="text" class="form-control" name="name" placeholder="{{ __('common.name') }}" v-model="registerForm.name" autofocus>

    <span class="help-block" v-show="registerForm.errors.has('name')">
      @{{ registerForm.errors.get('name') }}
    </span>

  </div>

  <!-- E-Mail Address -->
  <div class="input-group" :class="{'has-error': registerForm.errors.has('email')}">
    <!-- <label class="col-md-4 control-label">{{ __('common.email') }}</label> -->

    <input type="email" class="form-control" name="email" placeholder="{{ __('common.email') }}" v-model="registerForm.email">

    <span class="help-block" v-show="registerForm.errors.has('email')">
      @{{ registerForm.errors.get('email') }}
    </span>
  </div>

  <!-- Password -->
  <div class="input-group" :class="{'has-error': registerForm.errors.has('password')}">
    <!-- <label class="col-md-4 control-label">{{ __('common.password') }}</label> -->

    <input type="password" class="form-control" placeholder="{{ __('common.password') }}" name="password" v-model="registerForm.password">

    <span class="help-block" v-show="registerForm.errors.has('password')">
      @{{ registerForm.errors.get('password') }}
    </span>
  </div>

  <!-- Password Confirmation -->
  <div class="input-group" :class="{'has-error': registerForm.errors.has('password_confirmation')}">
    <!-- <label class="col-md-4 control-label">{{ __('common.confirmpassword') }}</label> -->

    <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('common.confirmpassword') }}" v-model="registerForm.password_confirmation">

    <span class="help-block" v-show="registerForm.errors.has('password_confirmation')">
      @{{ registerForm.errors.get('password_confirmation') }}
    </span>
  </div>

  <!-- Terms And Conditions -->
  <div v-if=" ! selectedPlan || selectedPlan.price == 0">
    <div class="form-group" :class="{'has-error': registerForm.errors.has('terms')}">
    <!-- <div class="col-md-6 col-md-offset-4"> -->
    <div class="">
      <input type="checkbox" name="terms" id="terms" v-model="registerForm.terms">
      <label for="terms"> {{ __('common.acceptthe') }} <a href="/terms" target="_blank">{{ __('common.termsofservices') }}</a></span>
    </div>
    <span class="help-block" v-show="registerForm.errors.has('terms')">
      @{{ registerForm.errors.get('terms') }}
    </span>
  </div>

  <div class="form-group">
    <button class="btn btn-primary" @click.prevent="register" :disabled="registerForm.busy">
      <span v-if="registerForm.busy">
      <i class="fa fa-btn fa-spinner fa-spin"></i>{{ __('common.registering') }}
      </span>

      <span v-else>
      <i class="fa fa-btn fa-check-circle"></i>{{ __('common.register') }}
      </span>
    </button>
  </div>
  </div>
</form>

<div class="text-center">

  <div>
    <p> {{ __('common.has_account') }} 
    <a href="/login" class="">{{ __('common.signin') }}</a> </p>
  </div>

  <div class="social-login">
    <p class="text-uppercase">{{ __('common.or') }}</p>
    <p>{{ __('common.social_signup') }}</p>
  
    <a href="/redirect" class="">
      <i class="mdi mdi-facebook-box"></i><span>{{ __('common.facebook') }}</span>
    </a>

    <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="" >
      <i class="mdi mdi-google"></i><span>{{ __('common.google') }}</span>
    </a>
  </div>

</div>
