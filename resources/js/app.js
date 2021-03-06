
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import MaskedInput from 'vue-masked-input'
// Vue.use(MaskedInput, /* { default global options } */);

//Mount Vue-Awesome-Swiper https://github.com/surmon-china/vue-awesome-swiper
import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.css'
Vue.use(VueAwesomeSwiper, /* { default global options } */);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('masked-input', MaskedInput);
Vue.component('appointments', require('./components/Appointments.vue').default);
Vue.component('price-list', require('./components/PriceList.vue').default);
Vue.component('date-list', require('./components/DateList.vue').default);
Vue.component('thumbs-gallery-loop', require('./components/thumbsGalleryLoop.vue').default);
Vue.component('loop-slider', require('./components/loopSlider.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
