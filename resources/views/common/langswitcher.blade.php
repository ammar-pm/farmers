<script2>
    $( "#langnav" ).click(function( event ) {
    event.preventDefault();
    var lang = {!! json_encode(App::getLocale()) !!};
    lang = (lang === 'ar')?'en':'ar';
    var url = window.parent.location.href;
    var source = url.split(/\/+/g)[3];
    var my_ds_lib = url.split(/\/+/g);
    var my_ds_id = my_ds_lib.slice(-1).pop() || 0;
    source = source || '';
    source = source.replace('#','') || 0;
    my_ds_id = (my_ds_id == source)?0:my_ds_id;
    source=  parseInt(source, 10) || 0;
    my_ds_id=  parseInt(my_ds_id, 10) || 0;
    //alert(source);
    //alert(my_ds_id);
    window.location.href= "/language/" + lang + "/" + source + "/" + my_ds_id;
    });
</script2>
<div id="ds_id"></div>
@if(App::getLocale() == "ar")
  <li  class="nav-item"><a id="langnav" href="" class="nav-link">English</a></li>
@else
  <li  class="nav-item"><a id="langnav"  href="" class="nav-link">العربية</a></li>
@endif
<span>|</span>