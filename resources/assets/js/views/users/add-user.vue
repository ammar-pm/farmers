<template>
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{Lang.get('common.adduser')}}</h4>
          <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>{{Lang.get('common.name')}}</label>
            <input type="text" class="form-control" name="name" v-model="newUser.name" id="name">
            <b-tooltip disabled ref="name" target="name" placement="bottom">Please enter a name</b-tooltip>
          </div>

          <div class="form-group">
            <label>{{Lang.get('common.email')}}</label>
            <input type="text" class="form-control" name="email" v-model="newUser.email" id="email">
            <b-tooltip disabled ref="email" target="email" placement="bottom">Please enter a email</b-tooltip>
          </div>

          <div class="form-group">
            <label>{{Lang.get('common.role')}}</label>
            <br>
            <v-select :options="roleChoices" v-model="newUser.role" style="width: 100%" id="role">
              <span
                slot="selected-option-container"
                slot-scope="props"
                :class="`selected-tag ${props.option.value}`"
              >
                {{ props.option.label }}
              </span>
            </v-select>
            <b-tooltip disabled ref="role" target="role" placement="bottom">Please enter a role</b-tooltip>
          </div>
        </div>

        <!-- Modal Actions -->
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-default"
            data-dismiss="modal"
          >{{Lang.get('common.cancel')}}</button>

          <button type="button" class="btn btn-warning" @click="addUser">{{Lang.get('common.add')}}</button>
        </div>
      </div>
    </div>
    <alert v-if="message" :message="message"></alert>
    <alert v-if="error" :isError="error"></alert>
  </div>
</template>
<script>
export default {
  props: ["app_user_roles", "app_local"],
  data() {
    return {
      newUser: {},
      AROLES: [
        { label: this.app_user_roles.admin, value: "admin" },
        { label: this.app_user_roles.editor, value: "editor" },
        { label: this.app_user_roles.member, value: "member" }
      ],
      roleChoices: [
        { label: this.app_user_roles.admin, value: "admin" },
        { label: this.app_user_roles.editor, value: "editor" },
        { label: this.app_user_roles.member, value: "member" }
      ],
      message: null,
      error: null
    };
  },
  methods: {
    showAddForm() {
      $("#modal-add").modal("show");
    },
    addUser() {
      const newUser = Object.assign({}, this.newUser);
      if (!newUser.name) {
        this.$refs.name.$emit("open");
      } else {
        this.$refs.name.$emit("close");
      }
      if (!newUser.email) {
        this.$refs.email.$emit("open");
      } else {
        this.$refs.email.$emit("close");
      }
      if (!newUser.role) {
        this.$refs.role.$emit("open");
      } else {
        this.$refs.role.$emit("close");
      }
      newUser.language = this.app_local;
      newUser.role = newUser.role.value;
      const { role, name, email } = newUser;
      if (role && name && email) {
        axios.post("/users", newUser).then(result => {
          if (result.data.flash_message) {
            location.href = `/users/${result.data.created_id}/edit`;
          } else {
            this.error = result.data.flash_error;
          }
        });
      }
    }
  }
};
</script>