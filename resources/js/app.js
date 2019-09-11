/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');
require('./material');
//window.$ = window.jQuery = require('jquery');
//require('./jqueryfancyboxmin.js');
window.Vue = require('vue');

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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const v_app = new Vue({
    el: '#app',
});

const app = () =>{
    var show_youglish_box = (elem_id)=>{
        // 2. This code loads the widget API code asynchronously.
        var tag = document.createElement('script');

        tag.src = "https://youglish.com/public/emb/widget.js";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // 3. This function creates a widget after the API code downloads.
        var widget;
        function onYouglishAPIReady(){
            widget = new YG.Widget(elem_id, {
                width: 640,
                components: 88,
                events: {
                    'onSearchDone': onSearchDone,
                    'onVideoChange': onVideoChange,
                    'onCaptionConsumed': onCaptionConsumed
                }
            });
            // 4. process the query
            widget.search("courage","US");
        }


        var views = 0, curTrack = 0, totalTracks = 0;

        // 5. The API will call this method when the search is done
        function onSearchDone(event){
            if (event.totalResult === 0)   alert("No result found");
            else totalTracks = event.totalResult;
        }

        // 6. The API will call this method when switching to a new video.
        function onVideoChange(event){
            curTrack = event.trackNumber;
            views = 0;
        }

        // 7. The API will call this method when a caption is consumed.
        function onCaptionConsumed(event){
            return ;
            if (++views < 3)
                widget.replay();
            else
            if (curTrack < totalTracks)
                widget.next();
        }
    };

    return {
        show_youglish_box: show_youglish_box,
    }
};