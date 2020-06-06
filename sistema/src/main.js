import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import './utils/session'
import './utils/http'
import './utils/icons'
import './utils/message'

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import VDatatable from './components/VDataTable/VDataTable.vue'
import VPageTitle from './components/VPageTitle/VPageTitle.vue'
import CKEditor from 'ckeditor4-vue'

Vue.config.productionTip = false

Vue.use(CKEditor)

Vue.component('v-data-table', VDatatable)
Vue.component('v-page-title', VPageTitle)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
