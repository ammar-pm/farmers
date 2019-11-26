<template>
  <div>
    <h1>{{isNew ? Lang.get('common.add') : Lang.get('common.edit')}}</h1>
    <div class="add-governorate-container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <v-tabs v-model="tab">
                <v-tab v-for="(tab, index) in tabs" @click="currentTab = index" :key="tab">{{ tab }}</v-tab>
                <v-tabs-items v-model="tab">
                  <v-card flat>
                    <div v-show="currentTab === 0">
                      <div class="governorates-details-container">
                        <h5>
                          <b>{{Lang.get('common.governoratesdetails')}}</b>
                        </h5>
                        <div class="flex">
                          <div class="form-group form-padding input">
                            <input
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.title')"
                              v-model="item.title"
                              id="title"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.title')}}*</h5>
                            <b-tooltip disabled ref="title" target="title" placement="bottom">
                              Please enter a title
                            </b-tooltip>
                          </div>
                          <div class="form-group form-padding input" style="padding-top: 15px">
                            <b-textarea
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.description')"
                              v-model="item.description"
                              style="width: 350px;"
                            />
                            <h5 class="form-text text-muted">{{Lang.get('common.description')}}</h5>
                          </div>
                          <div class="form-group form-padding input">
                            <input
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.sort')"
                              v-model="item.sort"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.sort')}}</h5>
                          </div>
                        </div>
                        <div class="flex">
                          <div class="form-group form-padding input">
                            <input
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.geocode')"
                              v-model="item.geo_code"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.geocode')}}</h5>
                          </div>
                          <div class="form-group form-padding input file-action">
                            <label v-if="!isNew && item.geojson && typeof(item.geojson) === 'string'" class="download-btn-container" :style="app_local === 'ar' ? 'left: 0px;' : 'left: 290px;'">
                              <div :class="app_local === 'ar' ? 'action-upload-view-gov' : ''">
                              <a
                                :href="'/storage/geojsons/' + item.geojson"
                                class="btn btn-xs btn-cloud-download"
                                v-if="!isNew && item.geojson && typeof(item.geojson) === 'string'"
                              >
                                <i class="mdi mdi-cloud-download"></i>
                              </a>
                              </div>
                              <div :class="app_local === 'ar' ? '' : 'action-upload-view-gov'">
                                <a
                                  class="btn btn-xs btn-cloud-upload"
                                >
                                  <i class="mdi mdi-upload"></i>
                                  <input type="file" accept=".geojson" style="display: none" ref="geoJsonInput" @change="onFilePicked">
                                </a>
                              </div>
                            </label>
                            <label v-else class="download-btn-container" :style="app_local === 'ar' ? 'left: 0px;' : 'left: 320px;'">
                              <div :class="app_local === 'ar' ? '' : 'action-upload-view-gov'">
                                <a
                                  class="btn btn-xs btn-cloud-upload"
                                >
                                  <i class="mdi mdi-upload"></i>
                                  <input type="file" accept=".geojson" style="display: none" ref="geoJsonInput" @change="onFilePicked">
                                </a>
                              </div>
                            </label>
                            <input
                              readonly
                              v-model="imageName"
                              type="text"
                              class="form-control form-padding"
                              style="background: none"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.geojson')}}</h5>
                          </div>
                          <div class="form-group form-padding input" style="visibility: hidden">
                            <input type="text">
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="geo-coor-container">
                        <h4>{{Lang.get('common.geographiccoordinate')}}</h4>
                        <div class="flex">
                          <div class="form-group form-padding input">
                            <input
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.latitude')"
                              v-model="item.latitude"
                              id="latitude"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.latitude')}}*</h5>
                            <b-tooltip disabled ref="latitude" target="latitude" placement="bottom">
                              Please enter a latitude
                            </b-tooltip>
                          </div>
                          <div class="form-group form-padding input">
                            <input
                              type="text"
                              class="form-control form-padding"
                              :placeholder="Lang.get('common.longitude')"
                              v-model="item.longitude"
                              id="longitude"
                            >
                            <h5 class="form-text text-muted">{{Lang.get('common.longitude')}}*</h5>
                            <b-tooltip disabled ref="longitude" target="longitude" placement="bottom">
                              Please enter a longitude
                            </b-tooltip>
                          </div>
                          <div class="form-group form-padding">
                            <v-select
                              v-model="item.langObj"
                              :options="languages"
                              :dir="app_local === 'ar' ? 'rtl' : 'ltr'"
                              id="language"
                            ></v-select>
                            <h5 class="form-text text-muted">{{Lang.get('common.language')}}*</h5>
                            <b-tooltip disabled ref="language" target="language" placement="bottom">
                              Please enter a language
                            </b-tooltip>
                          </div>
                        </div>
                      </div>
                    </div>
                  </v-card>
                </v-tabs-items>
              </v-tabs>
            </div>
          </div>
          <div class="actions">
            <div v-if="item">
              <button
                type="button"
                class="delete-button"
                v-on:click="confirmDelete"
              >{{Lang.get('common.delete')}}</button>
            </div>
            <div style="display: flex;">
              <div style="width: 215px">
                <button
                  type="button"
                  v-on:click="cancel"
                  class="cancel-btn"
                >{{Lang.get('common.backtogovernorates')}}</button>
              </div>
              <button type="button" v-on:click="save" class="save-btn">{{Lang.get('common.save')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["app_local"],
  created() {
    this.tabs.push(Lang.get("common.profile"));
    const itemData = JSON.parse(document.getElementById("gData").innerHTML);
    this.item = itemData || {};
    this.isNew = itemData === null;
    this.item.langObj = this.languages.find(l => l.id === this.item.language);
    this.imageName = this.item.geojson;
  },
  methods: {
    cancel() {
      location.href = "/governorates";
    },
    save() {
      if (this.isNew) {
        if (!this.item.longitude) {
          this.$refs.longitude.$emit('open');
        } else {
          this.$refs.longitude.$emit('close');
        }
        if (!this.item.title) {
          this.$refs.title.$emit('open');
        } else {
          this.$refs.title.$emit('close');
        }
        if (!this.item.latitude) {
          this.$refs.latitude.$emit('open');
        } else {
          this.$refs.latitude.$emit('close');
        }
        if (!this.item.langObj) {
          this.$refs.language.$emit('open');
        } else {
          this.$refs.language.$emit('close');
        }
      }
      if (this.item.language) {
       this.item.language = this.item.langObj.id; 
      }
      this.item.geojson = this.$refs.geoJsonInput.files[0];
      var form_data = new FormData();

      for (var key in this.item) {
        const val = this.item[key];
        if (val) form_data.append(key, val);
      }
      if (!this.isNew) form_data.append("_method", "PATCH");

      var url = this.isNew ? "" : `/${this.item.id}`;
      axios.post(`/governorates${url}`, form_data).then(data => {
        url = `/${data.id ? data.id : this.item.id}`;
        window.location = `/governorates${url}/edit`;
      });
    },
    pickFile() {
      this.$refs.geoJsonInput.click();
    },
    onFilePicked(e) {
      const files = e.target.files;
      if (files[0] !== undefined) {
        this.imageName = files[0].name;
        if (this.imageName.lastIndexOf(".") <= 0) {
          return;
        }
      }
    },
    confirmDelete() {
      axios
        .post(`/governorates/${this.item.id}`, { _method: "DELETE" })
        .then(() => {
          this.cancel();
        })
        .catch(err => {
          alert(`Error occurred: ${err.messagge || err}`);
        });
    }
  },
  data() {
    return {
      isNew: true,
      item: {},
      tab: null,
      currentTab: 0,
      tabs: [],
      languages: [
        { id: "ar", label: Lang.get("common.file_ar") },
        { id: "en", label: Lang.get("common.file_en") }
      ],
      selected: { id: 3, label: Lang.get("common.file_en") },
      imageName: ""
    };
  }
};
</script>
<style lang="scss">
.action-upload-view-gov {
  width: 35px; 
  text-align: right;
}
.file-action {
  position: relative;
  .download-btn-container {
    position: absolute;
    top: 0;
    padding: 0px !important;
    display: flex;
  }
  .btn {
    padding: 0px !important;
    box-shadow: none !important;
  }
  .geojson {
    padding-right: 75px;
  }
}
.flex {
  display: flex;
  justify-content: space-between;
}
.btn-circle {
  border-radius: 50% !important;
  border: 1px solid;
  width: 30px;
  height: 30px;
  padding: 0;
  i {
    line-height: 25px;
  }
}
.btn-cloud-download {
  @extend .btn-circle;
  color: rgb(26, 201, 175);
  border-color: rgb(26, 201, 175);
}
.btn-cloud-download:hover {
  color: rgb(26, 201, 175);
}
.btn-download {
  @extend .btn-circle;
  color: #628ff3;
  border-color: #628ff3;
}
.download-btn {
  width: 40px;
}
.v-tabs {
  height: 500px;
}
.input input,
.v-select {
  width: 350px;
}
.v-tabs__item--active {
  color: #628ff3 !important;
  border-bottom: 1px #628ff3 solid;
}
.v-tabs__div {
  text-transform: none;
}
.add-governorate-container {
  background-color: white;
  .v-select {
    .vs__selected-options {
      align-items: center !important;
    }
    .dropdown-toggle {
      height: 100%;
    }
    .clear {
      display: none !important;
    }
    .selected-tag {
      background: none !important;
      margin: 0px !important;
      color: black !important;
      font-size: 14px !important;
      padding: 5px !important;
    }
  }
}
.governorates-details-container {
  margin-top: 20px;
  margin-left: 20px;
  margin-right: 20px;
}
.geo-coor-container {
  margin-top: 30px;
  margin-left: 20px;
  margin-right: 20px;
}
.form-text {
  margin-top: 10px;
  padding-left: 5px;
}
.form-padding {
  padding: 0 0 0 5px;
}
.form-control,
body.dashboard .v-select .dropdown-toggle {
  border-bottom-color: #ececf3 !important;
}
.actions {
  display: flex;
  justify-content: space-between;
  padding-left: 20px;
  padding-right: 20px;
  margin-top: 25px;
  margin-bottom: 20px;
}
.save-btn {
  padding: 10px 35px 10px 35px;
  color: white;
  background-color: #4c7bf1;
}
.cancel-btn {
  background-color: #636b6f;
  padding: 10px 35px 10px 35px;
  color: white;
}
.btn-cloud-upload {
  @extend .btn-circle;
  color: #628ff3 !important;
  border-color: #628ff3;
}
hr {
  margin-left: 20px;
  margin-right: 20px;
}
</style>