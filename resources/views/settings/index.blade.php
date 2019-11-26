@extends('spark::layouts.admin')
<script type="text/javascript">
  var settings = {
    site_name: "{{ Config::get('site_name') }}",
    site_description: "{{ Config::get('site_description') }}",
    tag_line: "{{ Config::get('tag_line') }}",
    phone: "{{ Config::get('phone') }}",
    fax: "{{ Config::get('fax') }}",
    email: "{{ Config::get('email') }}",
    youtube: "{{ Config::get('youtube') }}",
    linkedin: "{{ Config::get('linkedin') }}",
    facebook: "{{ Config::get('facebook') }}",
    twitter: "{{ Config::get('twitter') }}",
    notify_email: "{{ Config::get('notify_email') }}",
    analytics: "{{ Config::get('analytics') }}",
    facebook_app: "{{ Config::get('facebook_app') }}"
  };
</script>
@section('content')
<div class="main">
  <div class="container-fluid">

     <user-settings></user-settings>

  </div><!--Container-->
</div>

@endsection