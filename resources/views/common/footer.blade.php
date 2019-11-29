<footer class="hidden-print">

  <div class="container">

    <img src="/img/mzr3ty-logo-2x.png" title="mzr3ty" alt="mzr3ty" class="logo">

    <div class="row">

      <div class="col-md-4">

        <p> {{ __('common.about_text')}} </p>

      </div> 

      <div class="col-md-4">

        <!-- @ include('common.menus.footer') -->
        <ul class="list-unstyled footer-menu">
          <li><a href="/library"> {{ __('common.library')}} </a></li>
          <li><a href="/about"> {{ __('common.about')}} </a></li>
          <li><a href="/contact_us"> {{ __('common.request_suggest')}} </a></li>
          <li><a href="/library"> {{ __('common.datasets')}} </a></li>
          <li><a href="/faqs"> {{ __('common.faqs')}} </a></li>
          <li><a href="/login"> {{ __('common.login')}} </a></li>
        </ul>

      </div>

      <div class="col-md-4">

        <p>Tel: {{ Config::get('phone') }}</p>
        <p>Fax:  {{ Config::get('fax') }}</p>
        <p>E-mail: <a href="mailto:{{ Config::get('email') }}"> {{ Config::get('email') }} </p>

      </div>

    </div>

    <div>
      <div class="text-center">
        @include('widgets.followus')
      </div>
      <div class="text-center">
        <p> {{ __('common.allrightsreserved') }} &copy; indicators {{ date('Y') }} </p>
      </div>
    </div>

  </div>

</footer>
