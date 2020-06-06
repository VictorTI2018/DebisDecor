import Vue from 'vue';
import FlashMessage from '@smartweb/vue-flash-message';

const config = {
	name: 'flashMessage',
	tag: 'FlashMessage',
	time: 3000
};

Vue.use(FlashMessage, config);
