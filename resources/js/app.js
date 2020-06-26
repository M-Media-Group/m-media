/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import AOS from 'aos';
import TextareaAutosize from 'vue-textarea-autosize';

window.Vue = require('vue');

Vue.use(TextareaAutosize);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i, 'lazy').keys();

files.forEach(file => {
    Vue.component(file.split('/').pop().split('.')[0], () => import(`${file}` /*webpackChunkName: “[request]” */));
});
// Vue.component('chart-line-component', require('./components/ChartLineComponent.js').default);

// Vue.component('chart-line-component', function (resolve) {
//     require(['./components/ChartLineComponent.js'], resolve).default
// });

Vue.component('chart-line-component', () => import('./components/ChartLineComponent.js') )

Vue.directive('tooltip', function (el, binding) {
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: 'hover',
        boundary: 'window',
        container: 'body',
        template:
            '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
    });
});

Vue.directive('popover', function (el, binding) {
    $(el).popover({
        content: binding.value,
        placement: binding.arg,
        boundary: 'window',
        container: 'body',
        template:
            '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
    });
});

// Vue.directive('scroll', {
//     inserted: function(el, binding) {
//         let f = function(evt) {
//             if (binding.value(evt, el)) {
//                 window.removeEventListener('scroll', f);
//             }
//         };
//         window.addEventListener('scroll', f);
//     },
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    created() {
        AOS.init({
            //delay: 30,
            //anchorPlacement:'top-center'
        });
    },
    methods: {
        // handleScroll: function (evt, el) {
        //     if (window.scrollY < 149) {
        //     el.setAttribute(
        //       'style',
        //       'opacity: 0; transform: translate3d(0, -10px, 0)'
        //     )
        //   }
        //   else if (window.scrollY > 150) {
        //     el.setAttribute(
        //       'style',
        //       'opacity: 1; transform: translate3d(0, -10px, 0)'
        //     )
        //   }
        //   return window.scrollY > 200
        // }
    },
    el: '#app',
    data: {
        showModal: false,
        online_users: null,
    },
    mounted() {
        Echo.join('online')
            .here((users) => (this.online_users = users))
            .joining((user) => this.online_users.push(user))
            .leaving((user) => (this.online_users = this.online_users.filter((u) => u.id !== user.id)));
    },
});
