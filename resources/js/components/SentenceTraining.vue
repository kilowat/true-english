<template>
    <div class="component-container"  v-bind:class="{loading: working}">
        <div class="error-block" v-if="error">
            <div class="error-text">Произошла ошибка, попробуйте зайти позже.</div>
        </div>
        <div class="phrase-container" v-if="phrases.length > 0">
            <div class="word-row"><span class="s-link">{{ current_word }}</span></div>
            <div class="setting-row">
                <div class="training-setting">
                    <div class="switch switch-blue">
                        <input type="radio" v-model="mode" value="training" class="switch-input" name="mode"  id="training">
                        <label for="training" class="switch-label switch-label-off">Тренировка</label>
                        <input type="radio"  v-model="mode" value="view"  class="switch-input" name="mode"  id="view">
                        <label for="view" class="switch-label switch-label-on">Просмотр</label>
                        <span class="switch-selection"></span>
                    </div>
                </div>
            </div>
            <div class="en-ru center-container" v-if="phrases.length > 0">
                <div class="card-content">
                    <div class="answer-text" v-if="show_answer">
                        <div class="en-text" v-html="enText"></div>
                        <div class="ipa-text">{{ phrases[page_current].ipa_text}}</div>
                        <div class="ru-text" v-if="phrases[page_current].ru_text !=''">
                            {{ phrases[page_current].ru_text }}
                        </div>
                        <div v-else class="no-translate">Перевода пока еще нет</div>
                        <div class="yandex-link" v-if="phrases[page_current].ru_text !=''">
                            <a href="http://translate.yandex.ru" title="Yandex">«Переведено сервисом «Яндекс.Переводчик» </a>
                        </div>
                    </div>
                    <div class="audio-row" v-if="phrases[page_current].audio_url != ''">
                        <audio :src="phrases[page_current].audio_url"  controls="controls"></audio>
                    </div>
                </div>
                <div class="score-row">
                    <span class="value-score">Совпадение: {{ scorePrecent }} %</span>
                    <div class="len-score" :style="{ width: scorePrecent+'%' }"></div>
                </div>
                <div class="enter-solve">
                    <textarea v-model="answer_text" name="" class="answer-area" rows="3" placeholder="Введите на английском языке что вы услышали"></textarea>
                </div>
                <div class="answer-button-row">
                    <button @click="showAnswer" class="button answer-button">Показать ответ</button>
                </div>
                <div class="nav-row">
                    <button class="button page-button" :disabled="!canGoPrev" @click="prevPage">Назад</button>
                    <button class="button page-button-back" @click="setPage(0)">В начало</button>
                    <button class="button page-button" :disabled="!canGoNext" @click="nextPage">Вперед</button>
                </div>
                <div class="nav-info-row">
                    Показано: {{ page_current * 1 + 1 }} из {{ totalPage }}
                </div>
                <div class="text-tip">Обратите внимание на то что, процент совпадения - это всего лишь <b>подсказка</b>, не 100 % совпадение <b>не означает</b> что ваш перевод не верен.</div>
                <div class="text-tip hot-key-tip">
                    <b>Управление:</b> Ctr + &larr; назад, Ctr + &rarr; вперед (ответ), Ctr + &uarr; проиграть аудио, Ctr + &darr; в начало.
                    <br><br><b>Если кнопка Ctr + &uarr; не проигрывает аудио, нужно кликнут в любом месте сайта.</b>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            word: { type: String, required: true },
        },
        name: "SentenceTraining",
        data(){
            return{
                mode: "training", // training || view
                show_answer: false,
                answer_text: "",
                phrases:[],
                page_current: 0,
                current_word: "",
                error: false,
                working: false,
            }
        },
        mounted(){
            this.setHandlerKeyPressed();
        },
        methods: {
            fetchData(page){
                this.working = true;
                page = page || 0

                axios.get("/word-training/sentence/"+this.word)
                    .then((result)=>{
                        this.phrases = result.data.data

                        if(this.phrases.length > 0){
                            this.setPageByHash();
                            this.current_word = this.phrases[0].word;
                            if(localStorage.phrase_traning_mode)
                                this.mode = localStorage.phrase_traning_mode;

                        }
                        if(this.mode == "view" && this.phrases.length > 0){
                            this.$nextTick(()=>{
                                this.showAnswer()
                            })
                        }
                        this.error = false;
                    })
                    .catch((error)=>{
                        this.error = true;
                    })
                    .finally(()=>{
                        this.working = false;
                    });
            },
            nextPage(){
                if(parseInt(this.page_current) < parseInt(this.totalPage) - 1){
                    this.reset();
                    let next_page = parseInt(this.page_current) + 1;
                    this.page_current = next_page;
                    this.setHashTag();

                    this.$nextTick(()=>{
                        this.playAudio();
                    })

                    if(this.mode == "view"){
                        this.showAnswer()
                    }
                }
            },
            prevPage(){
                if(this.page_current > 0){
                    this.reset();
                    let prev_page = parseInt(this.page_current) - 1;
                    this.page_current = prev_page;
                    this.setHashTag();

                    this.$nextTick(()=>{
                        this.playAudio();
                    })

                }
                if(this.mode == "view"){
                    this.showAnswer()
                }
            },
            setPage(page){
                if(this.page_current > page &&  page >= 0){
                    this.reset();
                    this.page_current = page
                    this.setHashTag();

                    this.$nextTick(()=>{
                        this.playAudio();
                    })

                }
                if(this.mode == "view"){
                    this.showAnswer()
                }
            },
            setHashTag(){
                window.location.hash = 'page_' + this.page_current;
            },
            reset(){
                this.show_answer = false
                this.answer_text = "";
            },
            setPageByHash(){
                if(window.location.hash) {
                    let hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
                    let hash_arr = hash.split("_");

                    if(hash_arr.length > 1 && hash_arr[0] == "page" && parseInt(hash_arr[1]) < this.totalPage){
                        this.page_current = hash_arr[1];
                    }
                }
            },
            showAnswer(){
                this.show_answer = true;
                this.$nextTick(()=>{
                    this.playAudio();
                    this.hintText();
                })
            },
            playAudio(){
                let p = document.querySelector(".audio-row audio")
                if(p != undefined){
                    p.play();
                }
            },
            hintText(){
                let s = this.answer_text.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"");
                s = s.split(' ');
                let selected_text = document.querySelector('.active-text');

                if(selected_text)
                    _app.highlight(selected_text, s)
            },
            setHandlerKeyPressed(){
                $(window).keydown((event) => {
                    const code = event.which;
                    const KEY_SPACE = 32;
                    const ARROW_UP = 38;
                    const ARROW_DOWN = 40;
                    const ARROW_LEFT = 37;
                    const ARROW_RIGHT = 39;
                    const RIGHT_CONTROL = 17;
                    const RIGHT_SHIFT = 16;

                    let handled = false;


                    if(code == ARROW_RIGHT && event.ctrlKey){
                        handled = true;

                        if(!this.show_answer){
                            this.showAnswer()
                        }else{
                            this.nextPage()
                        }
                    }

                    if(code == ARROW_LEFT && event.ctrlKey){
                        handled = true;
                        this.prevPage()
                    }

                    if(code == ARROW_UP && event.ctrlKey){
                        handled = true;
                        this.$nextTick(()=>{
                            this.playAudio();
                        });
                    }

                    if(code == ARROW_DOWN && event.ctrlKey){
                        handled = true;
                        this.setPage(0);
                    }

                    if(handled){
                        event.preventDefault();
                    }
                });

            }
        },
        created(){
            this.fetchData()
        },
        watch:{
            scorePrecent(value){
                if(value == 100)
                    this.showAnswer();
            },
            mode(value){
                if(value == "view"){
                    this.showAnswer()
                }

                localStorage.phrase_traning_mode = value;
            },
            lang(value){
                localStorage.phrase_lang = value;
            }
        },
        computed:{
            canGoNext(){
                return parseInt(this.page_current) < parseInt(this.totalPage) - 1
            },
            canGoPrev(){
                return this.page_current > 0
            },
            totalPage(){
                return this.phrases.length;
            },
            enText(){
                let text = this.phrases[this.page_current].en_text;
                text = text.replace(/[a-zA-Z’'<//>]+/g, "<span class='s-link'>$&</span>");
                return text;
            },
            question(){
                let question = [this.phrases[this.page_current].en_text];

                return question;
            },
            strMatch(){
                if(this.phrases[this.page_current] == undefined)
                    return false;

                return stringSimilarity.findBestMatch(this.answer_text, this.question);

            },
            score(){
                if(this.phrases[this.page_current] == undefined)
                    return false;
                let res = new difflib.SequenceMatcher(null, this.answer_text, this.question[0]).ratio()
                return res;
            },
            scorePrecent(){
                if(!this.score) return 0;

                let value = this.score * 100;
                value = Math.floor(value);

                return value;
            },
        }
    }
</script>

<style scoped>


</style>