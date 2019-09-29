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


function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING) {
        Update = setInterval(function() {
            UpdateMarkers()
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
        marker = {};
        marker.time_start = time_start;
        marker.time_end = time_end;
        marker.dom = el;
        if (typeof(markers) === 'undefined') {
            markers = [];
        }
        markers.push(marker);
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
                onClickItem(pos);
            }
        });

    } // Document Complete
}; // Document Ready State Change

var current_marker;
var next_marker;

function onClickItem(pos){
    player.seekTo(pos);
    player.playVideo();
}

function UpdateMarkers() {
    var current_time = player.getCurrentTime();

    if(current_marker != undefined && next_marker !=undefined  && !(current_time >= current_marker.time_start && current_time <= current_marker.time_end)){
        console.log();
        onMarkerChange(next_marker);
    }

    for(var i = 0; i < markers.length - 1; i++){
        if (current_time >= markers[i].time_start && current_time <= markers[i].time_end) {
            next_marker = markers[i + 1];
            current_marker = markers[i];
            markers[i].dom.classList.add("youtube-marker-current");
        }else{
            markers[i].dom.classList.remove("youtube-marker-current");
        }
    }
    /*
    markers.forEach(function(marker, i) {
        if (current_time >= marker.time_start && current_time <= marker.time_end) {
            marker.dom.classList.add("youtube-marker-current");
        } else {
            marker.dom.classList.remove("youtube-marker-current");
        }
    });
    */
}

function onMarkerChange(marker){
    console.log(marker);
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