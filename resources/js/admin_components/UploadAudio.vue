<template>
    <div class="container">

        <div class="large-6 medium-6 small-6 filezone">
            <input type="file" id="files" ref="files" multiple v-on:change="handleFiles()"/>
            <p>
                Перетащиет сюда файлы <br>или кликнете для поиска
            </p>
        </div>

        <div class="progress">
            <div class="progress-bar" role="progressbar" v-bind:style="{width: procent+'%'}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ procent }}%</div>
        </div>

        <a class="btn btn-primary submit-button" v-on:click="submitFiles()" v-show="files.length > 0">Отправить</a>

        <div v-for="(file, key) in files" class="file-listing">
            {{ file.name }}
            <div class="success-container" v-if="file.id > 0">
                Загружен
            </div>
            <div class="remove-container" v-else>
                <a class="remove" v-on:click="removeFile(key)">Удалить</a>
            </div>
        </div>
        <a class="btn btn-primary submit-button" v-on:click="submitFiles()" v-show="files.length > 0">Отправить</a>
    </div>

</template>


<script>
    export default {
        data() {
            return {
                post_url: 'admin/words/audio/upload-file',
                files: [],
                stepTime: 1000,
                currentIndex: 0,
                procent: 0,
                worked: false,
            }
        },

        methods: {
            handleFiles() {
                let uploadedFiles = this.$refs.files.files;

                for(var i = 0; i < uploadedFiles.length; i++) {
                    this.files.push(uploadedFiles[i]);
                }
            },
            removeFile( key ){
                this.files.splice( key, 1 );
            },
            send(i){
                let formData = new FormData();

                formData.append('file', this.files[i]);

                let conf = {
                    method: 'post',
                    url: '/' + this.post_url,
                    data: formData,
                    headers:{
                        'Content-Type': 'multipart/form-data'
                    }
                }

                axios(conf).then(function(data) {
                    this.currentIndex = i + 1;
                    this.procent = Math.round(( this.currentIndex * 100 ) / this.files.length);

                    this.files[i].id = data['data']['id'];
                    this.files.splice(i, 1, this.files[i]);
                    if(i >= this.files.length - 1){
                        this.worked = false;
                    }
                    console.log('success');
                }.bind(this)).catch(function(data) {
                    if(i >= this.files.length - 1){
                        this.worked = false;
                    }
                    console.log('error');
                });
            },

            submitFiles() {
                if(this.worked)
                    return false;

                this.worked = true;

                let time = 0;
                for (let i = 0; i < this.files.length; i++){
                    setTimeout(()=>{
                        this.send(i);
                    },time);
                    time+=this.stepTime;
                }
            }
        }
    }
</script>

<style scoped>
    input[type="file"]{
        opacity: 0;
        width: 100%;
        height: 200px;
        position: absolute;
        cursor: pointer;
    }
    .filezone {
        outline: 2px dashed grey;
        outline-offset: -10px;
        background: #ccc;
        color: dimgray;
        padding: 10px 10px;
        min-height: 200px;
        position: relative;
        cursor: pointer;
    }
    .filezone:hover {
        background: #c0c0c0;
    }

    .filezone p {
        font-size: 1.2em;
        text-align: center;
        padding: 50px 50px 50px 50px;
    }
    div.file-listing img{
        max-width: 90%;
    }

    div.file-listing{
        margin: auto;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    div.file-listing img{
        height: 100px;
    }
    div.success-container{
        text-align: center;
        color: green;
    }

    div.remove-container{
        text-align: center;
    }

    div.remove-container a{
        color: red;
        cursor: pointer;
    }

    a.submit-button{
        display: block;
        margin: auto;
        text-align: center;
        width: 200px;
        margin-top: 20px;
    }
</style>