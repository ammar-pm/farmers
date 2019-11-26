<!--
<li class="nav-item">
  <a class="nav-link" href="/dashboard">
    <i class="mdi mdi-home-outline" aria-hidden="true"></i> {{ __('common.dashboard') }}
  </a>
</li>
-->
<?php 
  $files_active = "";
  $posts_active = "";
  $files_open = "";
  $posts_open = "";
  if( strpos(Request::url(), 'files') ) {
    $files_active = "active";
    $files_open = "open";
  }
  if( strpos(Request::url(), 'posts') ) {
    $posts_active = "active";
    $posts_open = "open";
  }
?>

<li class="nav-item <?php print $files_open ?>">
  <!-- {{\Request::url()}} -->
  <a class="nav-link <?php print $files_active ?>" href="/files">
    <i class="mdi mdi-file" aria-hidden="true"></i> {{ __('common.files') }}</a>
</li>

<li class="nav-item">
  <a class="nav-link" href="/datasets">
    <i class="mdi mdi-table-large" aria-hidden="true"></i> {{ __('common.datasets') }}</a>
</li>

<li class="nav-item <?php print $posts_open ?>">
  <a class="nav-link <?php print $posts_active ?>" href="/posts">
    <i class="mdi mdi-file-multiple" aria-hidden="true"></i> {{ __('common.posts') }}
  </a>
</li>
