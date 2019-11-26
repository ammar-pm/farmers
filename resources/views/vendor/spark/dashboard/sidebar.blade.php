<div class="sidebar">
  <nav class="sidebar-nav">
    <ul class="nav">

      @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
        @include('common.menus.editor')
      @endif

      @if(Auth::user()->role === 'admin')
        @include('common.menus.admin')
      @endif

      <!--li class="nav-item">
        <a class="nav-link" href="/help">
          <i class="mdi mdi-lifebuoy" aria-hidden="true"></i> {{ __('common.help_center') }} </a>
      </li-->

    </ul>
  </nav>
  <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
