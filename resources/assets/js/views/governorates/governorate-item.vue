<template>
  <div class="governorate-item col-md-4">
    <div class>
      <div class="panel">
        <div class="header">
          <div class="header-left" >
            <div class="location-btn">
              <div class="btn btn-xs btn-location">
                <i class="mdi mdi-map-marker"></i>
              </div>
            </div>
            <div class="item-title">
              <a :href="'/governorates/' + item.id + '/edit'"><b>{{item.title}}</b></a>
            </div>
          </div>
          <div class="header-right">
            <div class="delete-btn">
              <a href="#" class="btn btn-xs btn-delete" v-on:click="startDelete">
                <i class="mdi mdi-trash-can-outline"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="description">
          <div style="font-size: 14px">
            <b>{{Lang.get('common.description')}}</b>
          </div>
          <div class="description-text">
                <p>
                  {{item.description}}
                </p>
          </div>
        </div>
        <div class="chips">
          <div class="chip">
            <p>
              <b>{{Lang.get('common.sort')}}</b>
            </p>
            <v-chip color="#1ac9af" text-color="white">{{item.sort}}</v-chip>
          </div>
          <div class="chip">
            <p>
              <b>{{Lang.get('common.geocode')}}</b>
            </p>
            <v-chip color="blue" text-color="white">{{item.geo_code}}</v-chip>
          </div>
          <div class="chip">
            <p>
              <b>{{Lang.get('common.latitude')}}</b>
            </p>
            <v-chip color="orange" text-color="white">{{item.latitude}}</v-chip>
          </div>
          <div class="chip">
            <p>
              <b>{{Lang.get('common.longitude')}}</b>
            </p>
            <v-chip color="#fb4a11" text-color="white"
                >{{item.longitude}}</v-chip>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
export default {
  props: ['item'],
  methods: {
    startDelete(evt) {
      this.$emit("request-delete", this.$props.item);
      evt.preventDefault();
      evt.stopPropagation();
      return false;
    }
  }
};
</script>
<style lang="scss">
.governorate-item {
  margin-top: 20px;
  .panel {
    min-height: 200px;
    flex-direction: column;
  }
  .header-left, .header-right {
    display: flex;
    flex-direction: row
  }
  .header-left .location-btn {
    width: 50px;
  }
  .header-left .item-title {
    display: flex;
    align-items: center
  }
  .delete-btn {
    width: 60px;
  }
  .description-text {
    height: 40px;
    p {
      font-size: 12px;
      height: 100%;
      overflow: auto;
    }
  }
  .header,
  .chips,
  .description {
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }
  .header,
  .chips {
    align-items: center;
  }
  .header,
  .description {
    border-bottom: 1px solid #ccc;
  }
  .description,
  .chip {
    flex-direction: column;
  }
  .btn-circle {
    border-radius: 50% !important;
    border: 1px solid;
    width: 42px;
    height: 42px;
    padding: 0;
    i {
      line-height: 36px;
    }
  }
  .btn-location {
    @extend .btn-circle;
    color: white;
    background-color: #636b6f;
  }
  .btn-delete {
    @extend .btn-circle;
    border-color: #ff0000;
    color: #ff0000;
  }
  .btn-download {
    @extend .btn-circle;
    color: rgb(26, 201, 175);
    border-color: rgb(26, 201, 175);
  }
  .header {
    .btn {
      padding: 0px !important;
      box-shadow: none !important;
    }
  }
}
</style>
