<template>
    <div class="phrase-container">
        <div class="en-ru center-container" v-if="phrases.length > 0">
            <div class="card-content">
                <div class="question-text en-text" v-html="enText"></div>
                <div class="ipa-text">{{ phrases[page_current].ipa_text}}</div>
                <div class="audio-row" v-if="phrases[page_current].audio_url != ''">
                    <audio :src="phrases[page_current].audio_url" controls="controls"></audio>
                </div>
                <div class="answer-text" v-if="show_answer">
                    <div class="ru-text" v-bind:class="[score.bestMatchIndex == index && score.bestMatch.rating > 0 ? 'active-text' : '']" v-for="(ru_text, index) in phrases[page_current].ru_text">
                        {{ ru_text }}
                    </div>
                </div>
            </div>
            <div class="score-row">
                <span class="value-score">Совпадение: {{ scorePrecent }} %</span>
                <div class="len-score" :style="{ width: scorePrecent+'%' }"></div>
            </div>
            <div class="enter-solve">
                <textarea v-model="answer_text" name="" class="answer-area" rows="4" placeholder="Напишите Ваш вариант перевода"></textarea>
            </div>
            <div class="answer-button-row">
                <button @click="showAnswer">Показать ответ</button>
            </div>
            <div class="nav-row">
                <button :disabled="!canGoPrev" @click="prevPage" >Назад</button>
                <button :disabled="!canGoNext" @click="nextPage">Вперед</button>
            </div>
            <div class="text-tip">Обратите внимание на то что, процент совпадения - это всего лишь <b>подсказка</b>, не 100 % совпадение <b>не означает</b> что ваш перевод не верен.</div>
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
              show_answer: false,
              answer_text: "",
              phrases:[],
              page_current: 0,
          }
        },
        methods: {
            fetchData(page){
                page = page || 0
                axios.get("/word-training/phrase/"+this.word)
                    .then((result)=>{
                        this.phrases = result.data.data
                        this.setPageByHash();
                    })
            },
            nextPage(){
                if(parseInt(this.page_current) < parseInt(this.totalPage) - 1){
                    this.reset();
                    let next_page = parseInt(this.page_current) + 1;
                    this.page_current = next_page;
                    this.setHashTag();
                    $(".answer-area").focus();
                }
            },
            prevPage(){
                if(this.page_current > 0){
                    this.reset();
                    let prev_page = parseInt(this.page_current) - 1;
                    this.page_current = prev_page;
                    this.setHashTag();
                    $(".answer-area").focus();
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
            },
        },
        created(){
            this.fetchData()
        },
        watch:{
            scorePrecent(value){
              if(value == 100)
                  this.showAnswer();
            },
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
            score(){
                if(this.phrases[this.page_current] == undefined)
                    return false;

                let score = stringSimilarity.findBestMatch(this.answer_text, this.phrases[this.page_current].ru_text);

                return score;
            },
            scorePrecent(){
                if(!this.score) return 0;

                let value = this.score.bestMatch.rating * 100;
                value = Math.floor(value);

                return value;
            },
        }
    }
</script>

<style scoped>


</style>