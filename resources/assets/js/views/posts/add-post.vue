<template>
  <div>
    <h1>{{isNew ? Lang.get('common.addpost') : Lang.get('common.edit') }}</h1>
    <div class="add-indicator-container">
      <div class="row">
        <div class="col-md-12">
          <div>
            <div class="topics-details-container">
              <h5>
                <b> {{Lang.get('common.postdetails')}}</b>
              </h5>
              <div class="flex">
                <div class="form-group form-padding input">
                  <input
                    type="text"
                    class="form-control form-padding"
                    :placeholder="Lang.get('common.title')"
                    v-model="item.title"
                  >
                  <h5 class="form-text text-muted">{{Lang.get('common.title')}}</h5>
                </div>
                <div class="form-group form-padding input">
                  <input
                    type="text"
                    class="form-control form-padding"
                    :placeholder="Lang.get('common.subline')"
                    v-model="item.subline"
                  >
                  <h5 class="form-text text-muted">{{Lang.get('common.subline')}}</h5>
                </div>
                <div style="display: flex;">
                  <div :style="`${imageName === undefined ? 'width: 0px' : 'width: 75px'}`">
                    <img :src='imageUrl ? imageUrl : `/storage/images/${imageName}`' height="60" v-if="imageName" style="width: 100%">
                  </div>
                  <div
                    class="flex-image"
                    :style="`${imageName ? 'margin-left: 10px' : ''}`"
                  >
                    <div
                      :class="`form-control form-padding ${imageUrl === '' ? ' no-image' : 'image'}`"
                    >
                      <input type="text" readonly @click="pickFile" v-model="imageName" style="width: 90%; background: none">
                      <label class="btn btn-xs btn-download">
                        <input
                          ref="image"
                          type="file"
                          class="form-control form-padding geojson"
                          @change="onFilePicked"
                        >
                        <i class="mdi mdi-upload"></i>
                      </label>
                    </div>
                    <h5 class="form-text text-muted">{{Lang.get('common.image')}}</h5>
                  </div>
                </div>
              </div>
              <div class="flex">
                <div class="form-group form-padding input">
                  <v-select :options="languages" @input="changeTypeOfLang" :value="selected" v-model="item.langObj"></v-select>
                  <h5 class="form-text text-muted">{{Lang.get('common.language')}}</h5>
                </div>
                <div class="form-group form-padding input">
                  <v-select :options="posts" @input="changeTypeOfPosts" :value="selectedPosts" v-model="item.type"></v-select>
                  <h5 class="form-text text-muted">{{Lang.get('common.type')}}</h5>
                </div>
                 <div class="form-group form-padding input" v-if="lang">
                  <v-select :options="relatedIds" v-model="item.related_id"></v-select>
                  <h5 class="form-text text-muted">{{Lang.get('common.relatedtopic')}}</h5>
                </div>
                <div class="form-group form-padding input" v-if="!lang">
                  <input>
                </div>
              </div>
              <div class="form-group form-padding input testing">
                <b-textarea
                  type="text"
                  class="form-control form-padding"
                  :placeholder="Lang.get('common.description')"
                  v-model="item.description"
                  style="width: 100%;"
                  rows="4"
                />
                <h5 class="form-text text-muted">{{Lang.get('common.description')}}</h5>
              </div>
              <div class="form-group form-padding input">
               <h5 style="padding: 0"><input type="checkbox" v-model="boolean" style="width: 20px;" v-on:change="onchangePublic($event)">{{Lang.get('common.public')}}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="action-buttons">
        <div style="width: 200px">
          <button type="button" v-on:click="cancel" class="cancel-btn">{{Lang.get('common.backtoposts')}}</button>
        </div>
        <button type="button" v-on:click="save" class="save-btn">{{Lang.get('common.save')}}</button>
      </div>
    </div>
  </div>
</template>
<script>
const LANGS = [{ id: "ar", label: "العربية" }, { id: "en", label: "English" }];

const POSTS = [
  { id: "stories", label: "Stories" },
  { id: "topics", label: "Topics" }
];

export default {
  created() {
    const itemData = JSON.parse(document.getElementById("gData").innerHTML);
    this.lang = document.getElementById("lang") ? JSON.parse(document.getElementById("lang").innerHTML) : this.lang;
    if (this.lang) {
      this.lang.forEach(related => {
        this.relatedIds.push(
          {
            id: related.id,
            label: related.title
          }
        )
      });
    };
    this.item = itemData || {
      language: "en",
      type: "topics"
    };

    this.isNew = itemData === null;
    const it_id = this.item.related_id;
    const found = this.relatedIds.find(function(element) {
        return element.id === it_id;
    });
    this.item.related_id = found ? found : null;
    this.item.langObj = this.languages.find(l => l.id === this.item.language);
    this.item.type = this.posts.find(l => l.id === this.item.type);
    this.imageName = this.item.image;
    this.boolean === false ? this.item.public = 0 : this.item.public = 1;
  },
  methods: {
    changeTypeOfPosts(type) {
      this.relatedIds = [];
      if (this.item.langObj.id === 'en') {
        this.lang.forEach(related => {
        if (related.language === 'ar' && related.type === type.id) {
          this.relatedIds.push(
            {
              id: related.id,
              label: related.title
            }
          )
        }
      })
      } else if (this.item.langObj.id === 'ar') {
        this.lang.forEach(related => {
        if (related.language === 'en' && related.type === type.id) {
          this.relatedIds.push(
            {
              id: related.id,
              label: related.title
            }
          )
        }
      })
      }
    },
    changeTypeOfLang(type) {
      this.relatedIds = [];
      if (type.id === 'en') {
        this.lang.forEach(related => {
          if (related.language === 'ar' && related.type === this.item.type.id) {
            this.relatedIds.push(
              {
                id: related.id,
                label: related.title
              }
            )
          }
        })
      } else if (type.id === 'ar') {
        this.lang.forEach(related => {
          if (related.language === 'en' && related.type === this.item.type.id) {
            this.relatedIds.push(
              {
                id: related.id,
                label: related.title
              }
            )
          }
        })
      }
      
    },
    cancel() {
        window.location = "/posts";
    },
    save() {
      this.item.related_id = this.item.related_id ? this.item.related_id.id : null;
      this.item.type = this.item.type.id;
      this.item.language = this.item.langObj.id;
      this.item.image = this.$refs.image.files[0];
      const form_data = new FormData();

      for (const key in this.item) {
        const val = this.item[key];
        if (val) form_data.append(key, val);
      }
      if (!this.isNew) form_data.append("_method", "PATCH");

      var url = this.isNew ? "" : `/${this.item.id}`;
      axios.post(`/posts${url}`, form_data).then((data) => {
        this.item.id = data.data.saved_id ? data.data.saved_id : this.item.id;
        url = `/${this.item.id}`;
        window.location = `/posts${url}/edit`;
      });
    },
    pickFile() {
      this.$refs.image.click();
    },

    onFilePicked(e) {
      const files = e.target.files;
      if (files[0] !== undefined) {
        this.imageName = files[0].name;
        if (this.imageName.lastIndexOf(".") <= 0) {
          return;
        }
        const fr = new FileReader();
        fr.readAsDataURL(files[0]);
        fr.addEventListener("load", () => {
          this.imageUrl = fr.result;
          this.imageFile = files[0]; // this is an image file that can be sent to server...
        });
      } else {
        this.imageName = "";
        this.imageFile = "";
        this.imageUrl = "";
      }
    },
    onchangePublic(event) {
      if (event.target.checked) {
        this.boolean = event.target.checked
      }
      this.boolean === false ? this.item.public = 0 : this.item.public = 1;
    }
  },
  data() {
    return {
      isNew: true,
      item: {},
      languages: [{ id: "ar", label: Lang.get('common.file_ar') }, { id: "en", label: Lang.get('common.file_en') }],
      selected: { id: "en", label: Lang.get('common.file_en') },
      selectedPosts: { id: "topics", label: Lang.get('common.topics') },
      imageName: "",
      imageUrl: "",
      posts: [
        { id: "stories", label: Lang.get('common.stories') },
        { id: "topics", label: Lang.get('common.topics')}
      ],
      imageFile: "",
      relatedIds: [],
      lang: null,
      boolean: false,
      public: 0
    };
  }
};
</script>
<style lang="scss">
.file-action {
  .geojson {
    padding-right: 75px;
  }
}
.no-image {
  width: 350px;
  display: flex;
  justify-content: space-between;
}
.image {
  width: 350px;
  display: flex;
  justify-content: space-between;
}
.flex {
  display: flex;
  justify-content: space-between;
}
.flex-image {
  display: flex;
  flex-direction: column;
  input[type="file"] {
    display: none;
  }
  .btn {
    padding: 0px !important;
    box-shadow: none !important;
  }
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
.btn-download {
  @extend .btn-circle;
  color: #628ff3;
  border-color: #628ff3;
}
.download-btn {
  width: 40px;
}
.input input,
.v-select {
  width: 350px;
}
.add-indicator-container {
  background-color: white;
  height: 500px;
  position: relative;
}
.topics-details-container {
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
.action-buttons {
  display: flex;
  justify-content: flex-end;
  padding-left: 20px;
  padding-right: 20px;
  margin-top: 25px;
  margin-bottom: 20px;
  position: absolute;
  bottom: 0;
  width: 100%;
  font-size: 14px;
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
hr {
  margin-left: 20px;
  margin-right: 20px;
}
.add-indicator-container {
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
  ::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
}
</style>