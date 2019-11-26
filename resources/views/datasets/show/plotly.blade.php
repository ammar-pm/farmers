<!--iframe :src="form.options.plotly_url" width="100%" height="930" border="0" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe-->
<div class="full-height" v-if="form.options.type == 'scattergeo'">

<!--plotly-map-chart :file="form.file_id" :option="form.options" style="width: 100%; height: 100%;"></plotly-map-chart-->
     <plotly-map class="full-height" id='test' :file="form.file_id" :user="user" :option="form.options" :app_local="app_local" v-on:send_labels_geos="getLabelsGeos($event)" style="width: 100%; height: 100%;" ></plotly-map>
</div>

<div class="full-height" v-if="form.options.type == 'bubble'">

     <!--plotly-map-chart :file="form.file_id" :option="form.options" style="width: 100%; height: 100%;"></plotly-map-chart-->
     <plotly-bubble class="full-height" id='test2' :file="form.file_id" :user="user" :option="form.options" :app_local="app_local" style="width: 100%; height: 100%;" ></plotly-bubble>
</div>

