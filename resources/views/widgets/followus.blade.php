<div class="social-btns">

	@if(Config::get('facebook'))
    <a href="{{ Config::get('facebook') }}" class="sb" target="_blank"><i class="mdi mdi-facebook-box"></i></a>
    @endif

    @if(Config::get('linkedin'))
    <a href="{{ Config::get('linkedin') }}" class="sb" target="_blank"><i class="mdi mdi-linkedin-box"></i></a>
    @endif

    @if(Config::get('twitter'))
    <a href="{{ Config::get('twitter') }}" class="sb" target="_blank"><i class="mdi mdi-twitter-box"></i></a>
    @endif

    @if(Config::get('youtube'))
    <a href="{{ Config::get('youtube') }}" class="sb" target="_blank"><i class="mdi mdi-youtube"></i></a>
    @endif

</div>