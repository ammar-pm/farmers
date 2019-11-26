<div id="placeholder" class="example-placeholder"  style="padding-top: 0;"></div>
<!--
 Vizabi load liberaries
 -->
<script charset="utf-8">
    var VIZABI_VERSION = "release/v0.25.1-3";
</script>
<link rel="stylesheet" href="{{ asset('vizabi_resource/vizabi.css') }}" />
<link rel="stylesheet" href="{{ asset('vizabi_resource/barrankchart.css') }}" />
<script src="{{ asset('vizabi_resource/d3.v4.min.js') }}"></script>
<script src="{{ asset('vizabi_resource/vizabi.js') }}"></script>
<script src="{{ asset('vizabi_resource/vizabi-ws-reader.js') }}"></script>
<script src="{{ asset('vizabi_resource/systema-globalis/ConfigBarRankChart.js') }}"></script>
<script src="{{ asset('vizabi_resource/barrankchart.js') }}"></script>
<script
        src="http://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
<!--
End Vizabi load liberaries
-->
<script>
    var file = {!! json_encode($file) !!};
    var msg = {!! json_encode($msg) !!};
    if(msg.msg_code === 2 )
    {
        alert(msg.msg_text);
        exit();
    };
    var config = {
        "locale": {
            "filePath": "/vizabi_resource/"
        },
        "data": {
            "reader": "csv",
            //"reader": "csv-time_in_columns",
            "path": "/" + file.url
            //"path": "https://raw.githubusercontent.com/Gapminder/vizabi-website/develop/data/UN-migrant-stock-data-exported.csv"
        }
    };

    try {
        /*$(document).ready(function(){
            document.getElementById("placeholder").style.height  = ($(window).height()-50) + "px";
        });*/
        Vizabi("BarRankChart", document.getElementById("placeholder"), config);
    }
    catch(err) {
        alert(err.message);
    }

</script>


