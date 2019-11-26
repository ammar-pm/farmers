<div id="placeholder" class="example-placeholder"  style="padding-top: 0;"></div>
<!--
 Vizabi load liberaries
 -->
<script charset="utf-8">
    var VIZABI_VERSION = "release/v0.25.1-3";
</script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="{{ asset('vizabi_resource/vizabi.css') }}" />
<link rel="stylesheet" href="{{ asset('vizabi_resource/bubblechart.css') }}" />
<script src="{{ asset('vizabi_resource/d3.v4.min.js') }}"></script>
<script src="{{ asset('vizabi_resource/vizabi.js') }}"></script>
<script src="{{ asset('vizabi_resource/vizabi-ws-reader.js') }}"></script>
<script src="{{ asset('vizabi_resource/systema-globalis/BubbleChart.js') }}"></script>
<script src="{{ asset('vizabi_resource/bubblechart.js') }}"></script>
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
    var user = {!! json_encode(Auth::user()) !!};
    var url = window.parent.location.href;
    var my_dataset_id = url.split(/\/+/g)[4];
    var url = url.split(/\/+/g)[2];
    var url_f = url.replace('#','');
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
    ////////////////////// new
    /*config.bind = {
        //fires up when model is ready (data is loaded etc):
        'ready': function(evt, vals) {
            axios.post('/api/v1/files/getVizabiOptions',
                {dataset_id:my_dataset_id,
                    foptions:chart.getModel(),
                    user_role:user.role,
                    url : url_f
                })
                .then(function (response) {
                   chart.setMode(response.state);
                })
                .catch(function (error) {
                });
            //console.log(chart.getModel());
        },
        //captures persistent (non-volatile) changes:

        'persistentChange': function(evt) {
            axios.post('/api/v1/files/saveVizabiOptions',
                {dataset_id:my_dataset_id,
                 foptions:chart.getModel(),
                 user_role:user.role,
                 url : url_f
                })
                .then(function (response) {
                    console.log('high abdo');
                })
                .catch(function (error) {
                });
            //console.log(chart.getModel());
        },

        'change:state': function(evt, path) {
            console.log(path);
            console.log(evt.source);
        }
    };*/
    ////////////////////////////////////////////////////
    try {
        /*$(document).ready(function(){
            alert($(window.parent).height());
            var calc_heigh = 600;
            if ($(window.parent).height() > 700) {
                calc_heigh =  $(window.parent).height() - 200;
            }else {
                calc_heigh = $(window.parent).height();
            }
            document.getElementById("placeholder").style.height  = (calc_heigh) + "px";
        });*/
        var chart = Vizabi("BubbleChart", document.getElementById("placeholder"), config);
    }
    catch(err) {
        alert(err.message);
    }

</script>



