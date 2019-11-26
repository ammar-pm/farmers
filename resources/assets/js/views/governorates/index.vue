<template>
  <div>
    <div class="row governorate-container">
      <div class="col-md-2">
        <div>
          <h1>{{Lang.get('common.governorates')}}</h1>
        </div>
      </div>
      <div class="col-md-10">
        <div class="gov-actions">
          <div>
            <v-select
              v-model="orderBy"
              :options="orderBys"
              :dir="app_local === 'ar' ? 'rtl' : 'ltr'"
            ></v-select>
          </div>
          <div>
            <v-select
              v-model="orderDirection"
              :options="orderDirections"
              :dir="app_local === 'ar' ? 'rtl' : 'ltr'"
            ></v-select>
          </div>
          <div>
            <v-select
              :options="languages"
              v-model="selected"
              :dir="app_local === 'ar' ? 'rtl' : 'ltr'"
            ></v-select>
          </div>
          <div>
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
          <div style="text-align: right;">
            <a href="/governorates/create" class="btn btn-primary">{{Lang.get('common.addnew')}}</a>
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
            <button
              type="button"
              class="btn btn-default"
              data-dismiss="modal"
            >{{Lang.get('common.no')}}</button>

            <button
              type="button"
              class="btn btn-warning"
              v-on:click="confirmDelete"
            >{{Lang.get('common.yes')}}</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <governorate-item
        v-on:request-delete="requestDelete"
        v-for="item in filteredItems"
        v-bind:key="item.id"
        v-bind:item="item"
        :app_local="app_local"
        :app_user_roles="app_user_roles"
      ></governorate-item>
    </div>
  </div>
</template>

<script>
import _ from "lodash";
import { debug } from "util";

export default {
  props: ["app_local", "login_user", "app_user_roles"],
  created() {
    this.items = window.items = JSON.parse(
      document.getElementById("gData").innerHTML
    );
    const searchTxt = this.$session.get("gov-search");
    this.searchText = searchTxt;
    const govAscending =
      this.$session.get("gov-direction") === "asc"
        ? Lang.get("common.ascending")
        : Lang.get("common.descending");
    const asc = this.orderDirections.find(type => govAscending === type.label);
    if (asc) {
      this.orderDirection = asc;
    }
    const govOrderBy = this.$session.get("gov-orderBy");
    const orderBy = this.orderBys.find(type => govOrderBy === type.id);
    if (orderBy) {
      this.orderBy = orderBy;
    }
    const langId = this.$session.get("gov-language");
    const language = this.languages.find(lang => langId === lang.id);
    if (language) {
      this.selected = language;
    }
  },
  methods: {
    requestDelete(item) {
      this.itemToDelete = item;
      $("#modal-confirm-delete").modal("show");
    },
    confirmDelete() {
      axios
        .post(`/governorates/${this.itemToDelete.id}`, { _method: "DELETE" })
        .then(() => {
          location.reload();
        })
        .catch(err => {
          alert(`Error occurred: ${err.messagge || err}`);
        });
    }
  },
  computed: {
    filteredItems() {
      const searchText = this.searchText;
      this.$session.set("gov-search", searchText);
      const searchRegEx = new RegExp(searchText, "i");
      const orderBy = this.orderBy.id;
      this.$session.set("gov-orderBy", orderBy);
      const orderDirection = this.orderDirection.id;
      this.$session.set("gov-direction", orderDirection);
      const filteredItems = this.items.filter(
        u => u.title && u.title.match(searchRegEx) && u.language === this.selected.id
      );
      this.$session.set("gov-language", this.selected.id);
      const filteredLang = this.items.filter(
        gov => gov.language === this.selected.id
      );
      return _.orderBy(filteredItems, [orderBy], [orderDirection]);
    }
  },
  data() {
    return {
      itemToDelete: null,
      searchText: "",
      //state
      orderBys: [
        { id: "sort", label: Lang.get("common.orderbysort") },
        { id: "title", label: Lang.get("common.orderbytitle") }
      ],
      orderDirections: [
        { id: "asc", label: Lang.get("common.ascending") },
        { id: "desc", label: Lang.get("common.descending") }
      ],
      orderBy: { id: "sort", label: Lang.get("common.orderbysort") },
      orderDirection: { id: "asc", label: Lang.get("common.ascending") },
      items: [],
      languages: [
        { id: "ar", label: Lang.get("common.file_ar") },
        { id: "en", label: Lang.get("common.file_en") }
      ],
      selected: { id: "en", label: Lang.get("common.file_en") }
    };
  }
};
</script>
<style lang="scss">
body.dashboard .v-select .dropdown-toggle {
  border-bottom-color: none !important;
}
.governorate-container {
  display: flex;
  justify-content: space-between;
  .gov-actions {
    display: flex;
    justify-content: space-around;
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
