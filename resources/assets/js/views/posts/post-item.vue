<template>
  <div class="indicator-item col-md-4">
    <div class>
      <div class="panel">
        <div class="header">
          <div class="header-left" >
            <div class="location-btn">
              <div :class="`btn btn-xs ${item.image ? 'post-img-container' : 'btn-location'} `">
                <img class="post-img" v-if="item.image" :src='`/storage/images/${item.image}`' style='height: 100%; width: 100%;'>
              </div>
            </div>
            <div class="item-title">
              <a :href="'/posts/' + item.id + '/edit'"><b>{{item.title}}</b></a>
              <span><b>{{item.subline}}</b></span>
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
        <hr/>
        <div class="description">
          <span class="description-text">{{item.description}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
export default {
  props: ['item'],
  data() {
    return {};
  },
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
.indicator-item {
  margin-top: 20px;
  .panel {
    height: 250px;
  }
  hr {
    width: 100%;
    margin: 0;
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
    flex-direction: column;
    color: black;
    a {
      color: black;
      text-decoration: none;

    }
  }
  .delete-btn {
    width: 60px;
  }
  .description-text {
    height: 125px;
    overflow: auto;
  }
  .header, .description {
    display: flex;
    justify-content: space-between;
    padding: 10px;
  }
  .description {
    flex-direction: column;
    margin-top: 10px;
  }
  .btn-circle {
    border-radius: 50% !important;
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
  .post-img-container {
    @extend .btn-circle;
  }
  .post-img {
      width: 42px;
      height: 42px;
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
