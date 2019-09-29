jQuery.fn.scrollTo = function(elem) {
    var offset_line = 2;
    var offset = ($(".s-item ").first().height() * offset_line) + $(".s-item ").first().height() / 2 + 10;
    $(this).scrollTop($(this).scrollTop() - $(this).offset().top + $(elem).offset().top - offset);
    return this;
};
// 2. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
var Update;

$("#subtitles").scrollTop(0);

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        events: {
            'onStateChange': onPlayerStateChange,
            'onReady': onPlayerReady,
        }
    });
}

function watchScroll(){
    if($(".youtube-marker-current").length > 0){
        $("#subtitles").scrollTo($(".youtube-marker-current"));
    }
}

function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING) {
        Update = setInterval(function() {
            UpdateMarkers()
            watchScroll();
        }, 50);
    } else {
        clearInterval(Update);
    }
}

// Sample Markers on Page
var MarkersInit = function(markers) {
    var elements = document.querySelectorAll('.youtube-marker');
    Array.prototype.forEach.call(elements, function(el, i) {
        var time_start = el.dataset.start;
        var time_end = el.dataset.end;
        var id = el.dataset.id;;
        if (id >= 1) {
            id = id - 1;
        } else {
            id = 0;
        }
        marker = {};
        marker.time_start = time_start;
        marker.time_end = time_end;
        marker.dom = el;
        if (typeof(markers[id]) === 'undefined') {
            markers[id] = [];
        }
        markers[id].push(marker);
    });
}

// On Ready
var markers = [];

document.onreadystatechange = function() {
    if (document.readyState === 'complete') {
        // Init Markers
        MarkersInit(markers);
        // Register On Click Event Handler
        var elements = document.querySelectorAll('.youtube-marker');
        Array.prototype.forEach.call(elements, function(el, i) {
            el.onclick = function() {
                // Get Data Attribute
                var pos = el.dataset.start;
                // Seek
                player.seekTo(pos);
                player.playVideo();
            }
        });

    } // Document Complete
}; // Document Ready State Change

function UpdateMarkers() {
    var current_time = player.getCurrentTime();
    var j = 0; // NOTE: to extend for several players

    markers[j].forEach(function(marker, i) {
        if (current_time >= marker.time_start && current_time <= marker.time_end) {
            marker.dom.classList.add("youtube-marker-current");
        } else {
            marker.dom.classList.remove("youtube-marker-current");
        }
    });
}

function onPlayerReady(){
    player.setPlaybackRate (1);
}

$("#video-speed").change(function(){
    player.setPlaybackRate (parseFloat($("#video-speed").val()));
});

$("#show-en").change(function(){
    var $elems = $("#subtitles .s-en");
    if($(this).is(":checked")){
        $elems.show();
    }else{
        $elems.hide();
    }
});

$("#show-tr").change(function(){
    var $elems = $("#subtitles .s-tr");
    if($(this).is(":checked")){
        $elems.show();
    }else{
        $elems.hide();
    }
});

$("#show-rev").change(function(){
    var $elems = $("#subtitles .s-ru");

    if($(this).is(":checked")){
        $elems.show();
    }else{
        $elems.hide();
    }
});