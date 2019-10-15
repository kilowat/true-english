/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./materialize.min');
require('./jqueryfancyboxmin');
window.autoComplete = require('./autoComplete');

let youtube = require('./youtube');

window.mmooc = youtube.mmooc;

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
Vue.component('word-table-component', require('./components/WordTableComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(document).ready(function(){
    $('.sidenav').sidenav();

    $(".word-popup").click(function(){
        $.ajax({
            url: "/word/"+$(this).text()
        }).done(function(res){
            $.fancybox.open(res,{
            });
        })
    })
});

$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top - 100
    }, 500);
});

const app = new Vue({
    el: '#app',
    methods:{
        openYouglishBox(word){
            let widget = `<div class="youglish-box"><div id="widget-youglish"></div></div>`;
            let self = this;
            $.fancybox.open(widget, {
                beforeShow(){
                    self.runYouglish(word)
                }
            });
        },
        runYouglish(word){
            // 2. This code loads the widget API code asynchronously.
            var tag = document.createElement('script');

            tag.src = "https://youglish.com/public/emb/widget.js";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // 3. This function creates a widget after the API code downloads.
            window.widget;

            window.onYouglishAPIReady = function(){
                widget = new YG.Widget("widget-youglish", {
                    width: 480,
                    components:8 + 16 + 64, //search box & caption
                    events: {
                        'onSearchDone': onSearchDone,
                        'onVideoChange': onVideoChange,
                        'onCaptionConsumed': onCaptionConsumed
                    }
                });
                // 4. process the query
                widget.search(word,"US");
            }

            var autoChangeTimer;

            var views = 0, curTrack = 0, totalTracks = 0;

            // 5. The API will call this method when the search is done
            window.onSearchDone = function(event){
                if (event.totalResult === 0)   alert("Видео по этому слову не найдено");
                else totalTracks = event.totalResult;
            }

            // 6. The API will call this method when switching to a new video.
            window.onVideoChange = function(event){
                curTrack = event.trackNumber;
                views = 0;
                if(autoChangeTimer){
                    clearTimeout(autoChangeTimer);
                }
            }

            // 7. The API will call this method when a caption is consumed.
            window.onCaptionConsumed = function(event){
                if (curTrack < totalTracks){
                    autoChangeTimer = setTimeout(function(){
                        widget.next();
                    }, 2000)
                }

            }
        }
    }
});
