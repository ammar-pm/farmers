<meta property="og:url" content="{{ Request::url() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ Config::get('site_description') }}">
<meta property="og:image" content="{{ Config::get('og_image') }}">
<meta property="fb:app_id" content="{{ Config::get('facebook_app') }}">