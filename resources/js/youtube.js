this.mmooc=this.mmooc||{};

//https://medium.com/@pointbmusic/youtube-api-checklist-c195e9abaff1
this.mmooc.youtube = function() {
    var hrefPrefix = "https://video.google.com/timedtext?v=";
    var transcriptIdPrefix = "videoTranscript";
    var transcriptArr = [];
    var initialized = false;

    function transcript(transcriptId, href)
    {
        var transcriptId = transcriptId;
        var videoId = transcriptId.split(transcriptIdPrefix)[1];

        //Array of captions in video
        var captionsLoaded = false;

        //Timeout for next caption
        var captionTimeout = null;

        var captions = null;

        //Keep track of which captions we are showing
        var currentCaptionIndex = 0;
        var nextCaptionIndex = 0;

        this.player = new YT.Player(videoId, {
            videoId: videoId,
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });

        function scrollTo(element, to, duration) {
            var start = element.scrollTop,
                change = to - start,
                currentTime = 0,
                increment = 20;

            var animateScroll = function(){
                currentTime += increment;
                var val = Math.easeInOutQuad(currentTime, start, change, duration);
                element.scrollTop = val;
                if(currentTime < duration) {
                    setTimeout(animateScroll, increment);
                }
            };

            animateScroll();

        }

        window.Math.easeInOutQuad = function (t, b, c, d) {
            t /= d/2;
            if (t < 1) return c/2*t*t + b;
            t--;
            return -c/2 * (t*(t-2) - 1) + b;
        };

        var findCaptionIndexFromTimestamp = function(timeStamp)
        {
            var start = 0;
            var duration = 0;
            for (var i = 0, il = captions.length; i < il; i++) {
                start = Number(getStartTimeFromCaption(i));
                duration = Number(getDurationFromCaption(i));

                //Return the first caption if the timeStamp is smaller than the first caption start time.
                if(timeStamp < start)
                {
                    break;
                }

                //Check if the timestamp is in the interval of this caption.
                if((timeStamp >= start) && (timeStamp < (start + duration)))
                {
                    break;
                }
            }
            return i;
        }


        var clearCurrentHighlighting = function()
        {
            var timeStampId = getTimeIdFromTimestampIndex(currentCaptionIndex);
            $("#"+timeStampId).removeClass('active');
            $("#"+timeStampId).parent().removeClass('active');
        }

        var highlightNextCaption = function ()
        {
            var timestampId = getTimeIdFromTimestampIndex(nextCaptionIndex);
            $("#"+timestampId).addClass("active");
            $("#"+timestampId).parent().addClass('active');
        }

        var calculateTimeout = function (currentTime)
        {
            var startTime = Number(getStartTimeFromCaption(currentCaptionIndex));
            var duration = Number(getDurationFromCaption(currentCaptionIndex));

            var timeoutValue = Math.abs(startTime - currentTime + duration);

            return timeoutValue;
        }

        this.onNext = "";

        this.setCaptionTimeout = function (timeoutValue)
        {
            if(timeoutValue < 0)
            {
                return;
            }

            clearTimeout(captionTimeout);

            var transcript = this;

            captionTimeout = setTimeout(function() {
                var stop = false;
                if(typeof transcript.onNext === "function" ){
                    var startTime = Number(getStartTimeFromCaption(nextCaptionIndex));
                    stop = transcript.onNext(startTime);
                }
                if(!stop){
                    transcript.highlightCaptionAndPrepareForNext();
                }else{
                    clearTimeout(captionTimeout);
                }

            }, timeoutValue*(1000 / this.player.getPlaybackRate()))
        }

        var getStartTimeFromCaption = function(i)
        {
            if(i >= captions.length)
            {
                return -1;
            }
            return captions[i]["start"];
        }
        var getDurationFromCaption = function(i)
        {
            if(i >= captions.length)
            {
                return -1;
            }

            return captions[i]["end"] - captions[i]["start"];
        }
        var getTimeIdFromTimestampIndex = function(i)
        {
            var strTimestamp = "" + i;
            return "t" + strTimestamp;
        }

        this.scrollToCurrent = function(){
            var currentNode = document.querySelector("#t"+currentCaptionIndex);

            if(currentNode == undefined) return false;

            var container = document.querySelector("#subtitles");
            var to = currentNode.parentNode;

            var topPos = to.offsetTop;
            var itemHeight = $(".s-item").height();
            var item = 1;
            var scrollPos = Math.abs(topPos - container.offsetTop - (itemHeight * item));

            if(scrollPos > (itemHeight * item)){
                scrollTo(container, scrollPos, 300);
            }
        }
        //////////////////
        //Public functions
        /////////////////

        //This function highlights the next caption in the list and
        //sets a timeout for the next one after that.
        //It must be public as it is called from a timer.
        this.highlightCaptionAndPrepareForNext = function ()
        {
            clearCurrentHighlighting();
            highlightNextCaption();
            currentCaptionIndex = nextCaptionIndex;
            nextCaptionIndex++;

            var currentTime = this.player.getCurrentTime();
            var timeoutValue = calculateTimeout(currentTime);

            if(nextCaptionIndex <= captions.length)
            {
                this.setCaptionTimeout(timeoutValue);
            }

        }

        //Called if the user has dragged the slider to somewhere in the video.
        this.highlightCaptionFromTimestamp = function(timeStamp)
        {
            clearCurrentHighlighting();
            nextCaptionIndex = findCaptionIndexFromTimestamp(timeStamp);
            currentCaptionIndex = nextCaptionIndex;

            var startTime = Number(getStartTimeFromCaption(currentCaptionIndex));

            var timeoutValue = -1;
            if(timeStamp < startTime)
            {
                timeoutValue = startTime - currentTime;
            }
            else
            {
                highlightNextCaption();
                timeoutValue = calculateTimeout(currentTime);
            }
            this.setCaptionTimeout(timeoutValue);
        }

        this.transcriptLoaded = function(arr) {
            captions = arr;
            var start = 0;
            var srt_output = "";

            for (var i = 0, il = captions.length; i < il; i++) {
                start =+ getStartTimeFromCaption(i);
                var timestampId = getTimeIdFromTimestampIndex(i);

                var captionText = '';
                captionText+= '<span class="time-line btnSeek youtube-marker" data-seek="' + start +'" id="'+ timestampId+'">'+captions[i]["line"]["time"]+'</span>';
                captionText+='<span class="s-en show-str">'+wrapWords(captions[i]["line"]["en"])+'</span><br class="s-en show-str">';

                if(captions[i]["line"]["tr"].length > 0)
                    captionText+='<span class="s-tr">'+captions[i]["line"]["tr"]+'</span><br class="s-tr">';

                if(captions[i]["line"]["ru"].length > 0)
                    captionText+='<span class="s-ru show-str">'+captions[i]["line"]["ru"]+'</span>';


                srt_output += "<span class='s-line s-item'>" + captionText + "</span> ";
            };

            $("#videoTranscript" + videoId).append(srt_output);
            captionsLoaded = true;
        }

        function wrapWords(str, tmpl) {
            return str.replace(/[a-zA-Z’'<//>]+/g, tmpl || "<span class='s-link'>$&</span>");
        }

        this.getTranscriptId = function()
        {
            return transcriptId;
        }
        this.getVideoId = function()
        {
            return videoId;
        }

        this.getTranscript = function()
        {
            var oTranscript = this;
            $.ajax({
                url: href,
                type: 'GET',
                data: {},
                success: function(response) {
                    var response = JSON.parse(response);
                    oTranscript.transcriptLoaded(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Error during GET");
                }
            });
        }

        this.playerPlaying = function()
        {
            if(!captionsLoaded)
            {
                return;
            }

            currentTime = this.player.getCurrentTime();
            this.highlightCaptionFromTimestamp(currentTime);
        }
        this.playerNotPlaying = function (transcript)
        {
            if(!captionsLoaded)
            {
                return;
            }
            clearTimeout(captionTimeout);
        }
    }

    function domInit(){
        var $video = $(".mmocVideoTranscript");

        if($video.length == 0) return false;

        var href = $video.data('route');
        var oTranscript = new transcript($video.attr("id"), href);
        oTranscript.getTranscript();
        window.oTranscript = oTranscript;
        transcriptArr.push(oTranscript);
        /*speed settings*/
        $("#video-speed").change(function(){
            oTranscript.player.setPlaybackRate(parseFloat($(this).val()));
        });
        /*text settings*/
        $(".config-subtitle input").change(function(){
            var class_str = $(this).data("class");

            if($(this).is(':checked')){
                $("."+class_str).addClass('show-str');
            }else{
                $("."+class_str).removeClass('show-str');
            }

            var one_checked = false;

            $(".config-subtitle input").each(function(){
                if($(this).is(':checked')){
                    one_checked = true;
                }
            })

            if(!one_checked){
                $("#subtitles").hide();
            }else{
                $("#subtitles").show();
            }
        });

        /*pause setting*/
        var pause = 0;

        $("#video-delay").change(function(){
            pause = parseInt($(this).val());
        });

        /*font-size*/
        $("#font-size-s").change(function(){
            $("#subtitles .s-line").css("font-size", $(this).val()+"px");
        });

        $("#play-btn").click(function(){
            oTranscript.player.playVideo();
        });

        $("#stop-btn").click(function(){
            oTranscript.player.pauseVideo();
        });

        $("#replay-btn").click(function(){
            oTranscript.player.seekTo(0);
            oTranscript.player.playVideo();
        });

        var isPhraseMode = false;

        $("#phrase-mode").change(function(){
           isPhraseMode = $(this).is(':checked');
        });

        oTranscript.onNext = function(startTime){
            //Настройка паузы на фразе
            var t;
            if (pause > 0){
                oTranscript.player.pauseVideo();
                t = setTimeout(function(){
                    oTranscript.player.playVideo();
                }, pause)
            }else if(t!=undefined){
                clearInterval(t);
            }
            if(pause < 0){
                oTranscript.player.pauseVideo();
                return true;
            }
            //Режим фраз
            var seek = $('#subtitles .s-line.active').next().find('.btnSeek').data('seek');

            if(seek > 0 && isPhraseMode){
                oTranscript.player.seekTo(seek);
                oTranscript.scrollToCurrent();
            }else {
                oTranscript.scrollToCurrent();
            }
        };
    }

    //Called when user clicks somewhere in the transcript.
    $(function() {
        var open_on_played = false;

        $(document).on('click', '#subtitles', function(e) {
            if($(e.target).hasClass('s-line')){
                var seekToTime = $(e.target).find('.btnSeek ').data('seek');
                var transcript = mmooc.youtube.getTranscriptFromTranscriptId($(e.target).parents('.mmocVideoTranscript').attr("id"));
                transcript.player.seekTo(seekToTime, true);
                transcript.player.playVideo();
            }

        });
        $(document).on('click', '.btnSeek', function() {
            var seekToTime = $(this).data('seek');
            var transcript = mmooc.youtube.getTranscriptFromTranscriptId($(this).parents('.mmocVideoTranscript').attr("id"));
            transcript.player.seekTo(seekToTime, true);
            transcript.player.playVideo();
        });
        //hover on word
        $(document).on('click', '.s-link', function() {
            var transcript = mmooc.youtube.getTranscriptFromTranscriptId($(this).parents('.mmocVideoTranscript').attr("id"));
            if(mmooc.youtube.getCurrentState() == 1){
                transcript.player.pauseVideo();
                open_on_played = true;
            }

            $.ajax({
                url: "/word/"+$(this).text()
            }).done(function(res){
                $.fancybox.open(res,{
                    afterClose:function(){
                        if(open_on_played){
                            transcript.player.playVideo();
                            open_on_played = false;
                        }
                    },
                });
            })
        });

        $("#settings-toggle").click(function(){
            var $toggleBlock = $(this).parent().next();
            $toggleBlock.toggle();
        });

    });

    //These functions must be global as YouTube API will call them.
    var previousOnYouTubePlayerAPIReady = window.onYouTubePlayerAPIReady;
    window.onYouTubePlayerAPIReady = function() {
        if(previousOnYouTubePlayerAPIReady)
        {
            previousOnYouTubePlayerAPIReady();
        }
        mmooc.youtube.APIReady();
    };

    // The API will call this function when the video player is ready.
    // It can be used to auto start the video f.ex.
    window.onPlayerReady = function(event) {
    }

    var current_state = -1;

    // The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    window.onPlayerStateChange = function(event) {
        current_state = event.data;
        var transcript = this.mmooc.youtube.getTranscriptFromVideoId(event.target.getIframe().id);
        if (event.data == YT.PlayerState.PLAYING) {
            transcript.playerPlaying();
        }
        else
        {
            transcript.playerNotPlaying();
        }
    }

    return {
        getTranscriptFromTranscriptId(transcriptId)
        {
            for (index = 0; index < transcriptArr.length; ++index) {
                if(transcriptArr[index].getTranscriptId() == transcriptId)
                {
                    return transcriptArr[index];
                }
            }
            return null;
        },
        getTranscriptFromVideoId(videoId)
        {
            for (index = 0; index < transcriptArr.length; ++index) {
                if(transcriptArr[index].getVideoId() == videoId)
                {
                    return transcriptArr[index];
                }
            }
            return null;
        },

        APIReady : function ()
        {
            if(!initialized)
            {
                domInit();

                initialized = true;
            }
        },
        init : function ()
        {
            this.APIReady();
        },
        getCurrentState: function(){
            return current_state;
        }
    }

}();



