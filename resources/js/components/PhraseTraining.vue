<template>
    <div class="phrase-container">
        <div class="en-ru">
            <div class="question-text">{{ phrase.en_text}}</div>
            <div class="ipa-text">{{ phrase.ipa_text}}</div>
            <div class="answer-text">
                <div class="ru-text" v-for="ru_text in phrase.ru_text">
                    {{ ru_text }}
                </div>
            </div>
        </div>
        <div class="ru-en"></div>
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
              phrase:{
                  word:"",
                  file_name: "",
                  en_text: "",
                  ru_text: [],
                  ipa_text: "",
              }
          }
        },
        methods: {
            fetchData(page){
                page = page || 0
                axios.get("/word-training/phrase/"+this.word+"/"+page)
                    .then((result)=>{
                        let res = result.data;
                        this.phrase = res;
                    })
            }
        },
        created(){
            this.fetchData()
        }
    }
</script>

<style scoped>

</style>