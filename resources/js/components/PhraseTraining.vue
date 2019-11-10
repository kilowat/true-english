<template>
    <div class="component-container"  v-bind:class="{loading: working}">
        <div class="error-block" v-if="error">
            <div class="error-text">Произошла ошибка, попробуйте зайти позже.</div>
        </div>
        <div class="phrase-container" v-if="phrases.length > 0">
            <div class="word-row"><span class="s-link">{{ current_word }}</span></div>
            <div class="setting-row">
                <div class="lang-setting">
                    <div class="switch switch-blue">
                        <input type="radio" v-model="lang" value="en_ru" class="switch-input" name="view"  id="en-ru">
                        <label for="en-ru" class="switch-label switch-label-off">EN - RU</label>
                        <input type="radio"  v-model="lang" value="ru_en"  class="switch-input" name="view"  id="ru-en">
                        <label for="ru-en" class="switch-label switch-label-on">RU - EN</label>
                        <span class="switch-selection"></span>
                    </div>
                </div>
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
            <div class="en-ru center-container" v-if="phrases.length > 0 && lang == 'en_ru'">
                <div class="card-content">
                    <div class="question-text en-text" v-html="enText"></div>
                    <div class="ipa-text">{{ phrases[page_current].ipa_text}}</div>
                    <div class="answer-text" v-if="show_answer">
                        <div class="ru-text" v-bind:class="[strMatch.bestMatchIndex == index && strMatch.bestMatch.rating > 0 ? 'active-text' : '']" v-for="(ru_text, index) in phrases[page_current].ru_text">
                            {{ ru_text }}
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
                    <textarea v-model="answer_text" name="" class="answer-area" rows="3" placeholder="Напишите Ваш вариант перевода"></textarea>
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
                    <b>Управление:</b> &larr; назад, &rarr; вперед (ответ), &uarr; проиграть аудио, &darr; в начало.
                </div>
            </div>
            <div class="ru-en center-container" v-if="phrases.length > 0 && lang == 'ru_en'">
                <div class="card-content">
                    <div class="question-text">
                        <div class="ru-text"  v-for="(ru_text, index) in phrases[page_current].ru_text">
                            {{ ru_text }}
                        </div>
                    </div>
                    <div class="answer-text" v-if="show_answer">
                        <div class="en-text active-text" v-html="enText"></div>
                        <div class="ipa-text">{{ phrases[page_current].ipa_text}}</div>
                        <div class="audio-row" v-if="phrases[page_current].audio_url != ''">
                            <audio :src="phrases[page_current].audio_url"  controls="controls"></audio>
                        </div>
                    </div>
                </div>
                <div class="score-row">
                    <span class="value-score">Совпадение: {{ scorePrecent }} %</span>
                    <div class="len-score" :style="{ width: scorePrecent+'%' }"></div>
                </div>
                <div class="enter-solve">
                    <textarea v-model="answer_text" name="" class="answer-area" rows="3" placeholder="Переведите одной фразой"></textarea>
                </div>
                <div class="answer-button-row">
                    <button class="button answer-button" @click="showAnswer">Показать ответ</button>
                </div>
                <div class="nav-row">
                    <button class="button page-button" :disabled="!canGoPrev" @click="prevPage">Назад</button>
                    <button class="button page-button-back" @click="setPage(0)">В начало</button>
                    <button class="button page-button" :disabled="!canGoNext" @click="nextPage">Вперед</button>
                </div>
                <div class="nav-info-row">
                    Показано: {{ page_current * 1 + 1}} из {{ totalPage }}
                </div>
                <div class="text-tip">Обратите внимание на то что, процент совпадения - это всего лишь <b>подсказка</b>, не 100 % совпадение <b>не означает</b> что ваш перевод не верен.</div>

                <div class="text-tip hot-key-tip">
                    <b>Управление:</b> &larr; назад, &rarr; вперед (ответ), &uarr; проиграть аудио, &darr; в начало.
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
        name: "PhraseTraining",
        data(){
          return{
              lang: "ru_en", // en_ru || ru_en
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

                axios.get("/word-training/phrase/"+this.word)
                    .then((result)=>{
                        this.phrases = result.data.data

                        if(this.phrases.length > 0){
                            this.setPageByHash();
                            this.current_word = this.phrases[0].word;
                            if(localStorage.phrase_traning_mode)
                                this.mode = localStorage.phrase_traning_mode;

                            if(localStorage.phrase_lang)
                                this.lang = localStorage.phrase_lang;
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


                    if(this.lang == "en_ru"){
                        this.$nextTick(()=>{
                            this.playAudio();
                        })
                    }
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

                    if(this.lang == "en_ru"){
                        this.$nextTick(()=>{
                            this.playAudio();
                        })
                    }
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

                    if(this.lang == "en_ru"){
                        this.$nextTick(()=>{
                            this.playAudio();
                        })
                    }
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
                let s = this.answer_text.split(' ');
                let selected_text = document.querySelector('.active-text');

                if(selected_text)
                    _app.highlight(selected_text, s)
            },
            setHandlerKeyPressed(){
                $(document).keydown((event) => {
                    const code = event.which;
                    const KEY_SPACE = 32;
                    const ARROW_UP = 38;
                    const ARROW_DOWN = 40;
                    const ARROW_LEFT = 37;
                    const ARROW_RIGHT = 39;
                    const RIGHT_CONTROL = 17;
                    const RIGHT_SHIFT = 16;

                    let handled = false;


                    if(code == ARROW_RIGHT){
                        if(!this.show_answer){
                            this.showAnswer()
                        }else{
                            this.nextPage()
                        }
                    }

                    if(code == ARROW_LEFT){
                        this.prevPage()
                    }

                    if(code == ARROW_UP){
                        this.$nextTick(()=>{
                            this.playAudio();
                        });
                    }

                    if(code == ARROW_DOWN){
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
              //text = text.replace(/[a-zA-Z’'<//>]+/g, "<span class='s-link'>$&</span>");
              return text;
            },
            question(){
                let question;

                if(this.lang == "en_ru"){
                    question = this.phrases[this.page_current].ru_text;
                }else if(this.lang == "ru_en"){
                    question = [this.phrases[this.page_current].en_text];
                }
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
                let res = new difflib.SequenceMatcher(null, this.answer_text, this.question[this.strMatch.bestMatchIndex]).ratio()
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