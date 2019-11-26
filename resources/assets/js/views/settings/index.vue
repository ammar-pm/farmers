<template>
  <div class="settings-user-container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <v-tabs v-model="tab">
              <v-tab v-for="(tab, index) in tabs" @click="currentTab = index" :key="tab">{{ tab }}</v-tab>
              <v-tabs-items v-model="tab">
                <v-card flat>
                  <div v-show="currentTab === 0">
                    <div class="general-details-container">
                      <h5>
                        <b>{{Lang.get('common.generalsettings')}}</b>
                      </h5>
                      <div class="flex">
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="Enter site name"
                            v-model="settings.site_name"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.sitename')}}</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="Enter last name"
                            v-model="settings.site_description"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.sitedescription')}}</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            v-model="settings.tag_line"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.tagline')}}</h5>
                        </div>
                      </div>
                      <div class="flex">
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="Enter phone number"
                            v-model="settings.phone"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.phone')}}</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            v-model="settings.fax"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.fax')}}</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="email"
                            class="form-control form-padding"
                            v-model="settings.email"
                          >
                          <h5 class="form-text text-muted">{{Lang.get('common.email')}}</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="currentTab === 1">
                    <div class="social-links-container">
                      <h5>
                        <b>Social Links</b>
                      </h5>
                      <div class="flex">
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="http://linkedln.com"
                            v-model="settings.linkedin"
                          >
                          <h5 class="form-text text-muted">Linkedln</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="http://facebook.com"
                            v-model="settings.facebook"
                          >
                          <h5 class="form-text text-muted">Facebook</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="http://twitter.com"
                            v-model="settings.twitter"
                          >
                          <h5 class="form-text text-muted">Twitter</h5>
                        </div>
                      </div>
                      <div class="flex">
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="http://youtube.com"
                            v-model="settings.youtube"
                          >
                          <h5 class="form-text text-muted">Youtube</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div v-show="currentTab === 2">
                    <div class="social-links-container">
                      <h5>
                        <b>Advanced Settings</b>
                      </h5>
                      <div class="flex">
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="haitham@pcbs.gov.ps"
                            v-model="settings.notify_email"
                          >
                          <h5 class="form-text text-muted">New User Notifications Email</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="UA-DEE322SS"
                            v-model="settings.analytics"
                          >
                          <h5 class="form-text text-muted">Google Analytics ID</h5>
                        </div>
                        <div class="form-group form-padding">
                          <input
                            type="text"
                            class="form-control form-padding"
                            placeholder="1235436534654"
                            v-model="settings.facebook_app"
                          >
                          <h5 class="form-text text-muted">Facebook App ID</h5>
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
          <button type="button" class="cancel-btn" @click="cancel">Cancel</button>
          <button type="button" class="save-btn" @click="save">{{Lang.get('common.save')}}</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import consts from "../../consts";
const ROLES = consts.ROLES;

export default {
  methods: {
    save() {
        axios
        .post(
          '/app/settings/update',
         {settings: this.settings}
        )
        .then(result => {
          console.log(result)
        })
        .catch(e => {
          alert("Error occurred"+ e);
        });
    },
    cancel() {
      history.back(-1);
    }
  },
  created() {
    this.settings = window.settings;
    this.tabs.push(Lang.get('common.general'), Lang.get('common.social'), Lang.get('common.advanced'));
  },
  data() {
    return {
      tab: null,
      currentTab: 0,
      tabs: [],
      settings: null
    };
  }
};
</script>
<style lang="scss">
.settings-user-container {
  background-color: white;
  .flex {
    display: flex;
    justify-content: space-between;
  }
  .v-tabs {
    height: 500px;
  }
  .v-tabs__item--active {
    color: #628ff3 !important;
    border-bottom: 1px #628ff3 solid;
  }
  .v-tabs__div {
    text-transform: none;
    cursor: pointer;
  }
  .general-details-container, .social-links-container {
    margin-top: 20px;
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
  .form-control,
  body.dashboard .v-select {
    width: 400px;
  }
  .actions {
    display: flex;
    justify-content: flex-end;
    margin-right: 15px;
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
    margin-right: 15px;
  }
  hr {
    margin-left: 20px;
    margin-right: 20px;
  }
}
</style>