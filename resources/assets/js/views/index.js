
// require all views there should be one per server side blade file
Vue.component('user-index-view', require('./users/index.vue'));
Vue.component('user-list-item', require('./users/user-list-item.vue'));
Vue.component('user-add', require('./users/add-user.vue'));
Vue.component('user-edit', require('./users/edit-user.vue'));
Vue.component('user-settings', require('./settings/index.vue'));
Vue.component('governorates-page', require('./governorates/index.vue'));
Vue.component('governorate-item', require('./governorates/governorate-item.vue'));
Vue.component('governorate-add', require('./governorates/add-governorate.vue'));
Vue.component('posts-page', require('./posts/index.vue'));
Vue.component('post-item', require('./posts/post-item.vue'));
Vue.component('post-add', require('./posts/add-post.vue'));
