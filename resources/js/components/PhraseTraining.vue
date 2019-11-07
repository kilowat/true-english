<template>
    <div class="phrase-container">
        <div class="en-ru center-container">
            <div class="card-content">
                <div class="question-text en-text">{{ phrase.en_text}}</div>
                <div class="ipa-text">{{ phrase.ipa_text}}</div>
                <transition name="fade">
                    <div class="answer-text" v-if="show_answer">
                        <div class="ru-text" v-for="ru_text in phrase.ru_text">
                            {{ ru_text }}
                        </div>
                    </div>
                </transition>
            </div>
            <div class="enter-solve">
                <textarea v-model="answer_text" name="" id="" rows="4" placeholder="Напишите Ваш вариант перевода"></textarea>
            </div>
            <div class="answer-button-row">
                <button @click="show_answer = true">Показать ответ</button>
            </div>
            <div class="nav-row">
                <button :disabled="!canGoPrev" @click="prevPage" >Назад</button>
                <button :disabled="!canGoNext" @click="nextPage">Вперед</button>
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
              show_answer: false,
              answer_text: "",
              phrase:{
                  word:"",
                  file_name: "",
                  en_text: "",
                  ru_text: [],
                  ipa_text: "",
              },
              page_total: 0,
              page_current: 0,
          }
        },
        methods: {
            fetchData(page){
                page = page || 0
                axios.get("/word-training/phrase/"+this.word+"/"+page)
                    .then((result)=>{
                        this.reset();
                        let res = result.data;
                        this.phrase = res;
                        this.page_total = res.pagen.total;
                        this.page_current = res.pagen.current;
                    })
            },
            nextPage(){
                if(this.page_current < this.page_total){
                    let next_page = parseInt(this.page_current) + 1;
                    this.fetchData(next_page);
                }
            },
            prevPage(){
                if(this.page_current > 0){
                    let next_page = parseInt(this.page_current) - 1;
                    this.fetchData(next_page);
                }
            },
            reset(){
                this.show_answer = false
                this.answer_text = "";
            }
        },
        created(){
            this.fetchData()
        },
        computed:{
            canGoNext(){
                return this.page_current < this.page_total
            },
            canGoPrev(){
                return this.page_current > 0
            }

        }
    }
</script>

<style scoped>

</style>