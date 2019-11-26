<!--
<li class="nav-item">
  <a class="nav-link" href="/widgets">
    <i class="mdi mdi-widgets" aria-hidden="true"></i> {{ __('common.widgets') }} </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="/menus">
    <i class="mdi mdi-menu" aria-hidden="true"></i> {{ __('common.menus') }} </a>
</li>
-->
<!--
<li class="nav-item">
  <a class="nav-link" href="/periods">
    <i class="mdi mdi-calendar-clock" aria-hidden="true"></i> {{ __('common.periods') }}
  </a>
</li>
-->
<?php 
  $gov_active = "";
  $messages_active = "";
  $users_active = "";
  $gov_open = "";
  $messages_open = "";
  $users_open = "";
  if( strpos(Request::url(), 'governorates') ) {
    $gov_active = "active";
    $gov_open = "open";
  }
  if( strpos(Request::url(), 'messages') ) {
    $messages_active = "active";
    $messages_open = "open";
  }
  if( strpos(Request::url(), 'users') ) {
    $users_active = "active";
    $users_open = "open";
  }
?>

<li class="nav-item <?php print $gov_open ?>">
  <a class="nav-link <?php print $gov_active ?>" href="/governorates">
    <i class="mdi mdi-domain" aria-hidden="true"></i> {{ __('common.governorates') }} </a>
</li>
<!--li class="nav-item">
  <a class="nav-link" href="/indicators">
    <i class="mdi mdi-target" aria-hidden="true"></i> {{ __('common.indicators') }} </a>
</li-->
<li class="nav-item <?php print $messages_open ?>">
  <a class="nav-link <?php print $messages_active ?>" href="/messages">
    <i class="mdi mdi-inbox-arrow-down" aria-hidden="true"></i> {{ __('common.messages') }} </a>
</li>
<li class="nav-item <?php print $users_open ?>">
  <a class="nav-link <?php print $users_active ?>" href="/users">
    <i class="mdi mdi-account" aria-hidden="true"></i> {{ __('common.users') }}
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" href="/app/settings">
    <i class="mdi mdi-settings" aria-hidden="true"></i> {{ __('common.settings') }} </a>
</li>
