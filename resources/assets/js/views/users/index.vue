<template>
  <div>
    <div class="row" style="margin-bottom: 22px;">
      <div class="col-md-3">
        <h1 style="margin: 0;"> {{ Lang.get('common.users') }} </h1>
      </div>
      <div class="col-md-9 user-admin-filters">
        <div class="row">
          <div class="col-md-12 filter-horizontal form-row">
            <div>
              <v-select :options="activeOrDeleted" v-model="isActive" style="width: 200px" :dir="app_local === 'ar' ? 'rtl' : 'ltr'"/>
            </div>
            <div>
              <v-select :options="SORTTYPE" style="width: 200px" v-model="isAscending" :dir="app_local === 'ar' ? 'rtl' : 'ltr'"/>
            </div>
            <div>
              <v-select style="width: 300px" v-bind:placeholder="Lang.get('common.role')" multiple :options="roleChoices" v-model="roles" :dir="app_local === 'ar' ? 'rtl' : 'ltr'">
                <span slot="selected-option-container" slot-scope="props" :class="`selected-tag ${props.option.value}`">
                  {{ props.option.label }}
                  <button
                    v-if="props.multiple"
                    @click="props.deselect(props.option)"
                    type="button"
                    class="close"
                    aria-label="Remove option"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </span>
              </v-select>
            </div>
            <div>
              <div class="search-form">
                <label for="searchbox">
                  <i class="mdi mdi-magnify" aria-hidden="true"></i>
                </label>
                <input
                  type="text"
                  :placeholder="Lang.get('common.search')"
                  class="form-control"
                  v-model="searchText"
                  name="searchText"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Search by user name"
                >
              </div>
            </div>
            <div>
              <button class="btn btn-primary" @click="showAddForm">{{Lang.get('common.addnew')}}</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="padding-top: 10px;">
      <div class="col-md-12 grid-wrapper files">
        <div class="row grid-view">
          <user-list-item
            v-for="user in filteredUsers"
            v-bind:key="user.id"
            v-bind:user="user"
            v-on:request-delete="requestDelete"
            :app_local="app_local"
            :login_user="user"
            :app_user_roles="app_user_roles"
            :isActive="isActive.label"
          ></user-list-item>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog">
      <div class="modal-dialog" v-if="itemToDelete">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{Lang.get('common.are_you_sure')}}</h4>
            <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div
            class="modal-body"
          >{{Lang.get('common.are_you_sure_you_want_to_delete')}} {{itemToDelete.name}}</div>

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
              @click="confirmDelete"
            >{{Lang.get('common.yes')}}</button>
          </div>
        </div>
      </div>
    </div>
    <user-add ref="userAdd" :app_local="app_local" :app_user_roles="app_user_roles"></user-add>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  props: ["app_local", "login_user", "app_user_roles"],
  methods: {
    showAddForm() {
      this.$refs.userAdd.showAddForm();
    },
    confirmDelete() {
      axios
        .post(`/users/${this.itemToDelete.id}`, { _method: "DELETE" })
        .then(result => {
          location.reload();
        });
    },
    requestDelete(item) {
      this.itemToDelete = item;
      $("#modal-confirm-delete").modal("show");
    }
  },
  created() {
    this.users = JSON.parse(document.getElementById("userData").innerHTML);
    const searchTxt = this.$session.get('user-search');
    this.searchText = searchTxt;
    const userAscending = this.$session.get('user-ascending') === 'asc' ? Lang.get('common.ascending') : Lang.get('common.descending');
    const asc = this.SORTTYPE.find(type => userAscending === type.label);
    if (asc) {
      this.isAscending = asc
    }
    const userActive = this.$session.get('user-active');
    const activeUsers = this.activeOrDeleted.find(active => userActive === active.label);
    if (activeUsers) {
      this.isActive = activeUsers;
    }
    const roles = this.$session.get('user-roles').split(', ');
    roles.forEach(role => {
      const userRole = this.AROLES.find(rol => role === rol.value);
      if (userRole) {
        this.roles.push(userRole)
      }
    })
    axios.get('/users/get_trashed_users')
        .then(data => {
          this.deletedUsers = data.data.records;
        })
  },
  data() {
    return {
      currentPage: 1,
      itemsPerPage: 20,
      users: [],
      deletedUsers: [],
      items: [],
      showAdmins: true,
      isAscending: {
        label: Lang.get('common.ascending'),
        value: true
      },
      isActive: {
        label: Lang.get('common.active'),
        value: true
      },
      activeOrDeleted: [
        { label: Lang.get('common.active'), value: true },
        {
          label: Lang.get('common.deleted'),
          value: false
        }
      ],
      roles: [],
      roleP: "Role",
      searchText: "",
      SORTTYPE: [
        { label: Lang.get('common.ascending'), value: true },
        {
          label: Lang.get('common.descending'),
          value: false
        }
      ],
      AROLES: [
        { label: this.app_user_roles.admin, value: "admin" },
        {
          label: this.app_user_roles.editor,
          value: "editor"
        },
        { label: this.app_user_roles.member, value: "member" }
      ],
      roleChoices: [
        { label: this.app_user_roles.admin, value: "admin" },
        {
          label: this.app_user_roles.editor,
          value: "editor"
        },
        { label: this.app_user_roles.member, value: "member" }
      ],
      itemToDelete: null
    };
  },
  computed: {
    filteredUsers() {
      const deltedUsers = this.deletedUsers;
      const users = this.users;
      const isActive = this.isActive.label;
      this.$session.set('user-active',isActive);
      const isAscending = this.isAscending.value ? "asc" : "desc";
      this.$session.set('user-ascending',isAscending);
      const searchText = this.searchText;
      this.$session.set('user-search',searchText);
      const roles = this.roles.length === 0 ? this.AROLES : this.roles;
      const rolesByVal = _.keyBy(roles, "value");
      const userRoles = _.keyBy(this.roles, "value");
      const rolesArr = [];
      Object.keys(userRoles).map(key => rolesArr.push(key))
      const rolesStrings = rolesArr.join(', ');
      this.$session.set('user-roles',rolesStrings);
      const searchRegEx = new RegExp(searchText, "i");
      let filteredUsers;
      if (isActive === Lang.get('common.active')) {
        filteredUsers = users
        .filter(u => rolesByVal[u.role])
        .filter(u => u.name && u.name.match(searchRegEx));
      } else {
        filteredUsers = deltedUsers
        .filter(u => rolesByVal[u.role])
        .filter(u => u.name && u.name.match(searchRegEx));
      }
      return _.orderBy(filteredUsers, ["name"], [isAscending]);
    }
  }
};
</script>
<style lang="scss">
.admin {
  background: #22d5c5 !important;
}
.member {
  background: #5d92f4 !important;
}
.editor {
  background: #ffb70f !important;
}
</style>
