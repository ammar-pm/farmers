<template>
  <div>
      <v-map style="width:100%; height: 600px" :zoom="zoom" :center="[marker.latitude, marker.longitude]">
        <v-tilelayer :url="url"></v-tilelayer>

         <v-geojson-layer 
          :geojson="geojson" 
          :options="options">
        </v-geojson-layer>
  
         <v-marker :lat-lng="[marker.latitude, marker.longitude]">

          <v-popup :content="marker.description"></v-popup>
          
          <v-tooltip :content="marker.title"></v-tooltip>

         </v-marker>

      </v-map>
  </div>
</template>


<script>
import Vue2Leaflet from 'vue2-leaflet';

export default {
  components: {
    'v-map': Vue2Leaflet.Map,
    'v-tilelayer': Vue2Leaflet.TileLayer,
    'v-geojson-layer': Vue2Leaflet.GeoJSON,
    'v-marker': Vue2Leaflet.Marker,
    'v-popup': Vue2Leaflet.Popup,
    'v-tooltip': Vue2Leaflet.Tooltip,
  },

  props: ['record'],

    data () {
      return {
        zoom:10,
        center: L.latLng(31.768319, 35.213710),
        url:'https://cartodb-basemaps-{s}.global.ssl.fastly.net/light_all/{z}/{x}/{y}.png',
        marker: {
            title: '',
            latitude: '',
            longitude: '',
            description: '',
        },
        geojson: null,
        options: {
          style: function () {
            return {
              weight: 2,
              color: '#ECEFF1',
              opacity: 1,
              fillColor: '#e4ce7f',
              fillOpacity: 1
            }
          }
        }
      }
    },

    mounted() {
      this.getMap(this.record);
    },

    methods: {

    getMap(record) {
        axios.get('/api/v1/governorates/'+record)
            .then(response => {
              this.marker.title       = response.data.record.title;
              this.geojson            = response.data.geojson;
              this.marker.latitude    = response.data.record.latitude;
              this.marker.longitude   = response.data.record.longitude;
              this.marker.description = response.data.record.description;
            });
    },


  }
}
</script>
