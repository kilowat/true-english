<template>
    <div class="rule-example-1">
        <div class="rule-row">
            <span>
                <select name="" v-model="selected_subject">
                    <option disabled value="">Выберите субьект</option>
                    <option v-for="item in subjects" v-bind:value="item.key">{{ item.value }}</option>
                </select>
            </span>
            <span>
                <select name="" v-model="selected_verbs">
                    <option disabled value="">Выберите глагол</option>
                    <option v-for="item in verbs" v-bind:value="item.key">{{ item.value }}</option>
                </select>
            </span>
            <span>
                <select name="" v-model="selected_object">
                    <option disabled value="">Выберите объект</option>
                    <option v-for="item in object_words" v-bind:value="item.key">{{ item.value }}</option>
                </select>
            </span>
        </div>
        <div class="rule-result">
            {{sub_text}} {{ verb_text }} {{ obj_text }}.
        </div>
    </div>
</template>

<script>
    export default {
        name: "GrammarLevel_1",
        data(){
            return{
                selected_subject : "",
                selected_verbs: "",
                selected_object: "",

                subjects:[
                    {
                        "use_s" : false,
                        "key" : "I",
                        "value" : "Я"
                    }
                ],
                verbs:[
                    {
                        "key" : "love",
                        "value" : "люблю"
                    },
                    {
                        "key" : "go",
                        "value" : "иду"
                    }
                ],
                object_words:[
                    {
                        "key" : "move",
                        "value" : "кино"
                    }
                ]
            }
        },
        computed:{
            sub_text(){
                return this.selected_subject
            },
            verb_text(){
                return this.selected_verbs
            },
            obj_text(){
                return this.selected_object
            }
        },
        methods:{
            setSubject(key){

            },
            findByKey(key, arr){
                for (item in arr){
                    if (arr[item].key == key){
                        return arr[item];
                    }
                }
            }
        }
    }
</script>

<style scoped>

</style>