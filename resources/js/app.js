
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('pie-chart', require('./components/charts/PieChart.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('logic-puzzle', require('./components/LogicPuzzle.vue').default);

Vue.component('dashboard-container', require('./components/dashboard/Container.vue').default);
Vue.component('posts-container', require('./components/posts/Container.vue').default);
Vue.component('healths-container', require('./components/healths/Container.vue').default);
Vue.component('todos-container', require('./components/todos/Container.vue').default);
Vue.component('locations-container', require('./components/locations/Container.vue').default);

import VModal from 'vue-js-modal'
Vue.use(VModal, { dynamic: true, injectModalsContainer: true });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
