<template>
  <div>
    <h1>{{ Lang.get('common.editprofile') }}</h1>
    <div class="edit-user-container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <v-tabs v-model="tab" class="edit-user-tabs">
                <v-tab v-for="(tab, index) in tabs" @click="currentTab = index" :key="tab">{{ tab }}</v-tab>
                <v-tabs-items v-model="tab">
                  <v-card flat>
                    <form>
                      <div v-show="currentTab === 0">
                        <div class="personal-details-container">
                          <h5>
                            <b>{{Lang.get('common.personaldetails')}}</b>
                          </h5>
                          <div class="flex">
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.name"
                                :placeholder="Lang.get('common.name')"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.name')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input
                                type="number"
                                v-on:keydown="isNumber"
                                class="form-control form-padding"
                                v-model="user.phoneNumber"
                                :placeholder="Lang.get('common.phone')"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.phone')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.occupation"
                                :placeholder="Lang.get('common.occupation')"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.occupation')}}</h5>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="form-group form-padding input">
                              <input
                                type="email"
                                class="form-control form-padding"
                                v-model="user.email"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.email')}}</h5>
                            </div>
                            <div class="form-group form-padding">
                              <v-select
                                v-bind:placeholder="roleP"
                                single
                                :options="roleChoices"
                                v-model="role"
                                v-on:input="onChangeRole"
                                :dir="app_local === 'ar' ? 'rtl' : 'ltr'"
                              >
                                <span
                                  slot="selected-option-container"
                                  slot-scope="props"
                                  :class="`selected-tag ${props.option.value}`"
                                >
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
                              <h5 class="form-text text-muted">{{Lang.get('common.role')}}</h5>
                            </div>
                            <div class="form-group form-padding input" style="visibility: hidden">
                              <input type="text">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="social-links-container">
                          <h4>{{Lang.get('common.sociallinks')}}</h4>
                          <div class="flex">
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.linkedln"
                                placeholder="http://linkedln.com"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.linkedln')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.facebook"
                                placeholder="http://facebook.com"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.facebook')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.twitter"
                                placeholder="http://twitter.com"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.twitter')}}</h5>
                            </div>
                          </div>
                          <div class="flex">
                            <div class="form-group form-padding input">
                              <input
                                type="text"
                                class="form-control form-padding"
                                v-model="user.google"
                                placeholder="http://google.com"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.google')}}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div v-show="currentTab === 1">
                        <div class="personal-details-container">
                          <h5>
                            <b>{{Lang.get('common.updatepassword')}}</b>
                          </h5>
                          <div class="flex">
                            <div class="form-group form-padding input">
                              <input
                                type="password"
                                class="form-control form-padding"
                                :placeholder="Lang.get('common.updatepassword')"
                                v-model="newPassword"
                                autocomplete="new-password"
                              >
                              <h5 class="form-text text-muted">{{Lang.get('common.updatepassword')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input
                                type="password"
                                class="form-control form-padding"
                                :placeholder="Lang.get('common.confirmpassword')"
                                v-model="confirmPassword"
                                @change="onChangeConfirmNewPassword"
                              >
                              <h5
                                class="form-text text-muted"
                              >{{Lang.get('common.confirmpassword')}}</h5>
                            </div>
                            <div class="form-group form-padding input">
                              <input type="text" style="visibility: hidden">
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </v-card>
                </v-tabs-items>
              </v-tabs>
            </div>
          </div>
          <div class="flex actions">
            <div v-if="!user.deleted_at">
              <button
                type="button"
                class="delete-button"
                @click="confirmDelete"
              >{{Lang.get('common.delete')}}</button>
            </div>
            <div v-else>
              <button
                type="button"
                class="delete-button"
                @click="restoreUser"
              >{{Lang.get('common.restoreuser')}}</button>
            </div>
            <div style="display: flex;">
              <div style="margin-left: 10px; margin-right: 10px;">
                <button
                  type="button"
                  class="cancel-btn"
                  @click="cancel"
                >{{Lang.get('common.backtousers')}}</button>
              </div>
              <button
                type="button"
                class="save-btn"
                @click="saveProfile"
                v-if="currentTab === 0 && !user.deleted_at"
              >{{Lang.get('common.save')}}</button>
              <button
                type="button"
                class="save-btn"
                @click="savePass"
                v-if="currentTab === 1 && !user.deleted_at"
              >{{Lang.get('common.save')}}</button>
              <alert v-if="message" :message="message"></alert>
              <alert v-if="error" :isError="error"></alert>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["app_local", "app_user_roles"],
  methods: {
    savePass() {
      if (this.onChangeConfirmNewPassword()) {
        this.onChangeConfirmNewPassword();
      } else {
        this.user.password = this.newPassword;
        this.postUser();
      }
    },
    saveProfile() {
      this.postUser();
    },
    postUser() {
      axios
        .post(
          `/users/${this.user.id}`,
          Object.assign({ ...this.user, _method: "PATCH" })
        )
        .then(result => {
          if (result.data.flash_error) {
            this.error = result.data.flash_error;
          } else {
            location.reload();
          }
        })
        .catch(error => {
          this.error = error.message || error;
        });
    },
    onChangeRole(role) {
      this.user.role = role.value;
    },
    onChangeConfirmNewPassword() {
      if (this.newPassword !== this.confirmPassword) {
        alert("Password does not match");
        return true;
      }
      return false;
    },
    cancel() {
      location.href = "/users";
    },
    confirmDelete() {
      axios
        .post(`/users/${this.user.id}`, { _method: "DELETE" })
        .then(result => {
          location.href = "/users";
        });
    },
    isNumber(evt) {
      if (evt) {
        const charCode = evt.which ? evt.which : evt.keyCode;
        if (
          charCode > 31 &&
          (charCode < 48 || charCode > 57) &&
          charCode !== 46
        ) {
          evt.preventDefault();
        } else {
          return true;
        }
      }
    },
    restoreUser() {
      axios
        .patch(`/users/restore_deleted_user/${this.user.id}`)
        .then(result => {
          if (result.data.flash_error) {
            this.error = result.data.flash_error;
          } else {
            this.cancel();
          }
        });
    }
  },
  created() {
    this.user = JSON.parse(document.getElementById("userData").innerHTML);
    this.tabs.push(Lang.get("common.profile"), Lang.get("common.password"));
    const roles = ["admin", "editor", "member"];
    roles.map(role => {
      this.roleChoices.push({
        label: this.app_user_roles[role],
        value: role
      });
    });
    const role = {
      label: this.app_user_roles[this.user.role],
      value: this.user.role
    };
    this.role = role;
  },
  data() {
    return {
      tab: null,
      role: null,
      roleP: Lang.get("common.role"),
      currentTab: 0,
      roleChoices: [],
      tabs: [],
      user: null,
      message: null,
      error: null,
      confirmPassword: null,
      newPassword: null // Remove when the user's password is being sent in the user object
    };
  }
};
</script>
<style lang="scss">
.edit-user-container {
  background-color: white;
}
.flex {
  display: flex;
  justify-content: space-between;
}
.v-tabs__item--active {
  color: #628ff3 !important;
  border-bottom: 1px #628ff3 solid;
}
.v-tabs__div {
  text-transform: none;
}
.personal-details-container {
  margin-top: 20px;
  margin-left: 20px;
  margin-right: 20px;
}
.social-links-container {
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
.input input {
  width: 400px;
}
.form-control,
body.dashboard .v-select .dropdown-toggle {
  border-bottom-color: #ececf3 !important;
}
.v-select {
  width: 400px;
  .vs__selected-options {
    align-items: center;
  }
  .clear {
    margin-left: 6px;
  }
}
.actions {
  padding-left: 20px;
  padding-right: 20px;
  margin-top: 25px;
  margin-bottom: 20px;
  padding-top: 10px;
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
.delete-button {
  background-color: white;
  border: 1px solid #ff0000;
  padding: 10px 35px 10px 35px;
  color: #ff0000;
}
hr {
  margin-left: 20px;
  margin-right: 20px;
}
</style>