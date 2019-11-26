<template>
  <div>
    <div class="row topic-container">
      <div class="col-md-7">
        <div>
          <h1>{{Lang.get('common.posts')}}</h1>
        </div>
      </div>
      <div class="col-md-5">
        <div class="gov-actions">
          <div class="col">
            <v-select :options="posts" :value="selectedPosts" v-on:input="changeTypeOfPosts" v-model="selectedPosts" :dir="app_local === 'ar' ? 'rtl' : 'ltr'"></v-select>
          </div>
          <div class="col">
            <v-select :options="languages" :value="selected" v-on:input="changeLang" v-model="selected" :dir="app_local === 'ar' ? 'rtl' : 'ltr'"></v-select>
          </div>
          <div class="col">
            <div class="search-form form-inline">
              <label for="searchbox">
                <i class="mdi mdi-magnify" aria-hidden="true"></i>
              </label>
              <input
                type="text"
                :placeholder="Lang.get('common.search_name')"
                class="form-control"
                v-model="searchText"
                :title="Lang.get('common.search_name')"
              >
            </div>
          </div>
          <div class="col" style="text-align: right;">
            <a href="/posts/create" class="btn btn-primary">{{Lang.get('common.addnew')}}</a>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{Lang.get('common.delete')}}</h4>
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div
            class="modal-body"
            v-if="itemToDelete"
          >{{Lang.get('common.are_you_sure_you_want_to_delete')}} {{this.itemToDelete.title}}?</div>

          <!-- Modal Actions -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

            <button type="button" class="btn btn-warning" v-on:click="confirmDelete">Yes</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <post-item
        v-on:request-delete="requestDelete"
        v-for="item in filteredItems"
        v-bind:key="item.id"
        v-bind:item="item"
        :app_local="app_local"
        :app_user_roles="app_user_roles"
      ></post-item>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
import { debug } from "util";

export default {
  props: ["app_local", "login_user", "app_user_roles"],
  created() {
    const searchTxt = this.$session.get('post-search');
    this.searchText = searchTxt;
    const postId = this.$session.get('post-type');
    const type = this.posts.find(post => postId === post.id);
    if (type) {
      this.selectedPosts = type;
    }
    const langId = this.$session.get('post-language');
    const language = this.languages.find(lang => langId === lang.id);
    if (language) {
      this.selected = language;
    }
    this.items = window.items = JSON.parse(
      document.getElementById("gData").innerHTML
    );
  },
  methods: {
    requestDelete(item) {
      this.itemToDelete = item;
      $("#modal-confirm-delete").modal("show");
    },
    confirmDelete() {
      axios
        .post(`/posts/${this.itemToDelete.id}`, { _method: "DELETE" })
        .then(() => {
          location.reload();
        })
        .catch(err => {
          alert(`Error occurred: ${err.messagge || err}`);
        });
    },
    changeTypeOfPosts(type) {
      this.$session.set('post-type',type.id);
      this.topics = this.items.filter(
        topics => topics.language === this.selected.id && topics.type === type.id
      );
    },
    changeLang(type) {
      this.$session.set('post-language',type.id);
      this.topics = this.items.filter(
        topics => topics.language === type.id && topics.type === this.selectedPosts.id
      );
    }
  },
  computed: {
    filteredItems() {
      const searchText = this.searchText;
      this.$session.set('post-search',searchText);
      const searchRegEx = new RegExp(searchText, "i");
      const filteredItems = this.topics
      .filter(topics => topics.title && topics.title.match(searchRegEx));

      return _.orderBy(filteredItems, ["title"]);
    }
  },
  data() {
    return {
      itemToDelete: null,
      //state
      languages: [{ id: "ar", label: Lang.get('common.file_ar') }, { id: "en", label: Lang.get('common.file_en') }],
      posts: [
        { id: "stories", label: Lang.get('common.stories') },
        { id: "topics", label: Lang.get('common.topics')}
      ],
      selected: { id: "en", label: Lang.get('common.file_en') },
      selectedPosts: { id: "topics", label: Lang.get('common.topics') },
      items: [],
      topics: [],
      searchText: ""
    };
  }
};
</script>
<style lang="scss">
body.dashboard .v-select .dropdown-toggle {
  border-bottom-color: none !important;
}
.topic-container {
  display: flex;
  justify-content: space-between;
  .gov-actions {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: end;
    justify-content: flex-end;
    .row {
      height: 100%;
    }
    .search-form {
      height: 100%;
      box-shadow: 2px 1px 8px #8888;
      margin: 0;
      label {
        height: 100%;
        padding-top: 10px;
        padding-left: 10px;
      }
      input {
        width: unset;
      }
    }

    .v-select {
      height: 100%;
      background-color: white;
      box-shadow: 2px 1px 8px #8888;
      width: 200px;
      .vs__selected-options {
        align-items: center;
      }
      .dropdown-toggle {
        border-bottom: none !important;
        height: 100%;
        .clear {
          display: none;
        }
        .selected-tag {
          background: none;
          margin: 0px;
          color: black;
          font-size: 14px;
        }
      }
    }
  }
}
</style>
