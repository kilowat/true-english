<template>
    <div class="verb-ing-training">
        <div class="en-text question tr-row">{{ currentWord.word }}</div>
        <div class="ipa-text tr-row">{{ currentWord.ipa }}</div>
        <div class="ru-text tr-row">{{ currentWord.ru }}</div>
        <div class="show-answer tr-row">
            <div class="answer-row" v-if="show">
                {{ currentWord.answer }}
            </div>
        </div>
        <div class="answer">
            <input type="text" @keyup.enter="showAnswer" v-model="input"  class="input-text" placeholder="Напиши слово с ing формой" value="">

        </div>
        <div class="btn-row">
            <button @click="showAnswer" class="btn">Ответ/Ещё</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "IngVerbTraining",
        data(){
          return {
              seen : [],
              show: false,
              input: "",
              currentWord: {
                  word: "",
                  ru: "",
                  ipa: "",
                  answer: "",
              },
              working: false,
              words: [

              ]
          }
        },
        created(){
            this.fetch();
        },
        methods: {
            fetch(){
                this.working = true;
                let dataFetchUrl = "grammar/ing-form-training/list";
                axios.get(dataFetchUrl)
                    .then((response)=>{
                        this.show = false;
                        this.working = false;
                        this.words = response.data.data
                        this.changeWord();
                    })
            },
            changeWord(){
                this.currentWord = this.words[window._.random(this.words.length-1)]
                this.seen.push(this.currentWord)
                this.input = "";
                if(this.seen.length == this.words.length){
                    this.seen = [];
                    this.fetch();
                }
            },
            showAnswer(){
                if (this.show) {
                    this.show = false;
                    this.changeWord()
                }else{
                    this.show = true;
                    this.$nextTick(() => {
                        let selected_text = document.querySelector('.answer-row');
                        if(selected_text)
                            _app.highlight(selected_text, [this.input])
                    });
                }
            }
        }

    }
</script>

<style scoped>
    .verb-ing-training{
        text-align: center;
        margin-top: 14px;
        margin-bottom: 14px;
        font-size: 16px;
    }
    .answer{
        width: 280px;
        display:inline-block;
        margin-bottom: 10px;
        margin-top: 10px;
    }
    .tr-row{
        min-height: 24px;
    }
    .en-text{
        color:black;
    }
    .ru-text{
        color:green;
    }
    .ipa-text{
        color:red;
    }
    .answer-row{
        color: black;
    }
</style>