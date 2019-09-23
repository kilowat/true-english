/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./materialize.min');
require('./jqueryfancyboxmin');

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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
//Vue.component('word-table-component', require('./components/WordTableComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(document).ready(function(){
    $('.sidenav').sidenav();
});

const app = new Vue({
    el: '#app',
    methods:{
        openYouglishBox(word){
            let widget = `<a id="yg-widget-0" class="youglish-widget" data-query="${word}" data-components="8447" data-toggle-ui="1"  rel="nofollow" href="https://youglish.com">Visit YouGlish.com</a><script async src="https://youglish.com/public/emb/widget.js" charset="utf-8"></script>`;
            $.fancybox.open(widget, {
            });
        }
    }
});
