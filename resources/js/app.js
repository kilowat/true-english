/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./materialize.min');
require('./jqueryfancyboxmin');


window.stringSimilarity = require('string-similarity');
window.autoComplete = require('./autoComplete');
window.difflib = require('difflib');
let youtube = require('./youtube');

window.mmooc = youtube.mmooc;

window.Vue = require('vue');

window.db = require('./db.min');


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
Vue.component('sound-table', require('./components/SoundTableComponent.vue').default);
Vue.component('grammar-level-1', require('./components/GrammarLevel_1.vue').default);
Vue.component('phrase-training', require('./components/PhraseTraining.vue').default);
Vue.component('sentence-training', require('./components/SentenceTraining.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

$(document).ready(function(){
    let drawer = M.Sidenav.init(document.querySelectorAll('.sidenav'));

    $('.close-drawer').click(()=>{
        drawer[0].close();
    })

    $(".word-popup").click(function(){
        $.ajax({
            url: "/word/"+$(this).text()
        }).done(function(res){
            $.fancybox.open(res,{
            });
        })
    })

    let isOpenedYougish = ()=> {return window.$('#widget-youglish').length > 0}

    $(document).keydown((event) => {
        const code = event.which;
        const ARROW_LEFT = 37;
        const ARROW_RIGHT = 39;
        const RIGHT_CONTROL = 17;

        if(code == ARROW_RIGHT && isOpenedYougish()){
            if (window.curTrack < window.totalTracks && window._widget_youglish != undefined){
                window._widget_youglish.next();
            }
        }

        if(code == ARROW_LEFT && isOpenedYougish()){
            if (window.curTrack > 0 && window._widget_youglish != undefined){
                window._widget_youglish.previous();
            }
        }

        if(code == RIGHT_CONTROL && isOpenedYougish()){
            window._widget_youglish.close();
            window.$.fancybox.close();
            handled = true;
        }
    });

});

$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top - 100
    }, 500);
});


window.openYouglishBox = function(word){
    let widget = `<div class="youglish-box">
                    <div id="widget-youglish"></div>
                    <div class="row-link">
                        <a href="https://youglish.com/pronounce/`+word+`/english/us" title="Перейти" target="_blank">Перейти на Youglish</a>
                    </div>
                    <div class="settings">
                        <div class="setting-cell">
                            <label for="auto-next">Авто переход роликов:</label>
                            <input type="checkbox" onchange="window._app.setYouglishAutoPlay(this)" checked="checked" id="auto-next">
                        </div>
                    </div>
                  </div>`;
    let self = this;
    $.fancybox.open(widget, {
        beforeShow(){
            runYouglish(word)
        },
        afterShow(){
            let autoPlay = true;

            if(localStorage.youglish_autoNext && localStorage.youglish_autoNext == "no")
                autoPlay = false;

            $("#auto-next").prop('checked', autoPlay);
        },
        beforeClose(){
            if(window._widget_youglish_youglish != undefined){
                window._widget_youglish_youglish.close();
            }

            window.youglish_tag.remove();
        }
    });
}

window.runYouglish = function (word){
    // 2. This code loads the widget API code asynchronously.
    window.youglish_tag = document.createElement('script');

    window.youglish_tag.src = "https://youglish.com/public/emb/widget.js";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(window.youglish_tag, firstScriptTag);

    // 3. This function creates a widget after the API code downloads.
    window._widget_youglish_youglish;

    window.onYouglishAPIReady = function(){
        window._widget_youglish = new YG.Widget("widget-youglish", {
            width: 480,
            components:8 + 16 + 64, //search box & caption
            events: {
                'onSearchDone': onSearchDone,
                'onVideoChange': onVideoChange,
                'onCaptionConsumed': onCaptionConsumed
            }
        });
        // 4. process the query
        window._widget_youglish.search(word,"US");
    }

    var autoChangeTimer;
    var autoChangeDelay = 2000;
    var views = 0;

    window.curTrack = 0;
    window.totalTracks = 0;

    // 5. The API will call this method when the search is done
    window.onSearchDone = function(event){
        if (event.totalResult === 0){

        }
        else {
            totalTracks = event.totalResult;
        }
    }

    // 6. The API will call this method when switching to a new video.
    window.onVideoChange = function(event){
        window.curTrack = event.trackNumber;
        views = 0;
        $("#auto-next").focus();//Retrun focus to our doc from youglish

        if(autoChangeTimer !=undefined)
            clearTimeout(autoChangeTimer);
    }

    // 7. The API will call this method when a caption is consumed.
    window.onCaptionConsumed = function(event){
        let play_setting = !localStorage.youglish_autoNext || localStorage.youglish_autoNext != 'no';

        if (curTrack < totalTracks && play_setting){
            autoChangeTimer = setTimeout(()=>{
                window._widget_youglish.next();
            }, autoChangeDelay);
        }
    }
}

window._app = (() => {
    let workExample = false

    let showExamples = (e)=>{
        if(workExample) return false;

        $(".word-info").append('<div class="ajax-load"></div>');

        workExample = true;

        $.ajax({
            url: $(e).data('url')
        }).success(function(res){
            workExample = false;
            $('.ajax-load').remove();

            $.fancybox.open(res,{

            });
        }).error(function(){
            workExample = false;
            $('.ajax-load').remove();
            alert("Произошла ошибка")
        })
    }

    let setYouglishAutoPlay = (e)=>{
        if(e.checked)
            localStorage.youglish_autoNext = 'yes';
        else
            localStorage.youglish_autoNext = 'no';
    };
    /**
     * Highlight keywords inside a DOM element
     * @param {string} elem Element to search for keywords in
     * @param {string[]} keywords Keywords to highlight
     * @param {boolean} caseSensitive Differenciate between capital and lowercase letters
     * @param {string} cls Class to apply to the highlighted keyword
     */
     let highlight = function(elem, keywords, caseSensitive = false, cls = 'highlight') {
        const flags = caseSensitive ? 'gi' : 'g';
        // Sort longer matches first to avoid
        // highlighting keywords within keywords.
        keywords.sort((a, b) => b.length - a.length);
        Array.from(elem.childNodes).forEach(child => {
            const keywordRegex = RegExp(keywords.join('|'), flags);
            if (child.nodeType !== 3) { // not a text node
                highlight(child, keywords, caseSensitive, cls);
            } else if (keywordRegex.test(child.textContent)) {
                const frag = document.createDocumentFragment();
                let lastIdx = 0;
                child.textContent.replace(keywordRegex, (match, idx) => {
                    const part = document.createTextNode(child.textContent.slice(lastIdx, idx));
                    const highlighted = document.createElement('span');
                    highlighted.textContent = match;
                    highlighted.classList.add(cls);
                    frag.appendChild(part);
                    frag.appendChild(highlighted);
                    lastIdx = idx + match.length;
                });
                const end = document.createTextNode(child.textContent.slice(lastIdx));
                frag.appendChild(end);
                child.parentNode.replaceChild(frag, child);
            }
        });
    }

    let goBack = function(){
         if(localStorage.go_back){
             location.href = localStorage.go_back;
         }
    };
    return {
        setYouglishAutoPlay : setYouglishAutoPlay,
        highlight: highlight,
        goBack: goBack,
        showExamples: showExamples,
    }
})();

const app = new Vue({
    el: '#app',
    methods:{
        openYouglishBox(word){
            window.openYouglishBox(word);
        },
    }
});
