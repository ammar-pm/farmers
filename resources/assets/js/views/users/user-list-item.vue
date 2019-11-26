<template>
  <div class="column col-md-4 col-lg-3 col-xl-3 user-item">
    <div class="panel panel-default d-md-flex">
      <div class="panel-head">
        <div style="display:flex" class="panel-header">
          <div style="width: 55px">
            <div class="btn btn-xs role-btn">
              <i :class="`mdi ${user.role === 'admin' ? 'mdi-account-key' : 'mdi-account'}`"/>
            </div>
          </div>
          <div class="name">
            <a :href="`/users/${user.id}/edit`">{{user.name}}</a>
            <p>{{moment(user.created_at).format('MM/DD/YYYY')}}</p>
          </div>
        </div>
        <div class="file-controls">
          <a
            v-if="isActive === Lang.get('common.active')"
            href="#"
            class="btn btn-xs btn-delete"
            v-on:click="startDelete"
          >
            <i class="mdi mdi-trash-can-outline"></i>
          </a>
          <a v-else href="#" class="btn btn-xs btn-delete" v-on:click="restoreUser">
            <i class="mdi mdi-backup-restore"></i>
          </a>
        </div>
      </div>
      <hr>
      <div class="panel-actions">
        <p class="small-text">
          <b>{{Lang.get('common.role')}}</b>
        </p>
        <p class="file-topics">
          <span :class="`file-topic ${user.role}`">{{userTitle}}</span>
        </p>
      </div>
    </div>
    <alert :isError="error"></alert>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["user", "login_user", "app_local", "app_user_roles", "isActive"],
  data() {
    return {
      moment,
      userTitles: {
        admin: this.app_user_roles.admin,
        editor: this.app_user_roles.editor,
        member: this.app_user_roles.member
      },
      error: null
    };
  },
  methods: {
    startDelete(evt) {
      this.$emit("request-delete", this.$props.user);
      evt.preventDefault();
      evt.stopPropagation();
      return false;
    },
    restoreUser() {
      axios.patch(`/users/restore_deleted_user/${this.user.id}`).then(result => {
        if (result.data.flash_error) {
          this.error = result.data.flash_error;
        } else {
          location.reload();
        }
      });
    }
  },
  computed: {
    userTitle() {
      return this.userTitles[this.$props.user.role];
    }
  }
};
</script>
