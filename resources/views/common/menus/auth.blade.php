<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="mdi mdi-account-outline"></i>{{ __('common.' . Auth::user()->role ) }}</a>
  <ul class="dropdown-menu">

    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
      @include('common.menus.editor')
    @endif

    @if(Auth::user()->role === 'admin')
      @include('common.menus.admin')
    @endif
    
    <li class="nav-item"><a class="nav-link" href="/logout"><i class="mdi mdi-logout"></i>{{ __('common.logout') }}</a></li>
  </ul>
</li>