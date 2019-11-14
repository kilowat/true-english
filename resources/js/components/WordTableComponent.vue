<template>
    <div class="table-component"
         v-bind:class="{loading: working}"
         id="table-words">
        <div class="hot-keys">
            <div>
                <div>Колонка индекс - это то сколько раз это слово повторилось в тексте</div>
                <a href="javascript:void(0)" v-on:click="isShowHotKey = !isShowHotKey" class="hot-key-link">Показать клавишы навигации</a>
            </div>
            <ul v-show="isShowHotKey">
                <li>Навигация по страницам: <b>&larr; &rarr;</b></li>
                <li>Навигация по строкам: <b>&uarr; &darr;</b></li>
                <li>Проиграть audio: <b>Пробел</b></li>
                <li>Открыть youglish: <b>Правый shift</b></li>
                <li>Закрыть youglish: <b>DEL</b></li>
                <li>Выбрать строку: <b>Клик мышкой по строке</b></li>
                <li>Навигация в окне youglish: <b>&larr; &rarr;</b></li>
            </ul>
        </div>
        <div v-if="pagination && tableData.length > 0" class="nav-table">
            <ul class="pagination">
                <li class="page-item" :class="{'disabled' : currentPage === 1}">
                    <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(currentPage - 1)">Назад</a>
                </li>
                <li v-for="page in pagesNumber" class="page-item"
                    :class="{'active': page == pagination.meta.current_page}">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
                </li>
                <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
                    <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(currentPage + 1)">Вперед</a>
                </li>
            </ul>
        </div>
        <div class="table">
            <div class='theader'>
                <div class='table_header'>№</div>
                <div class='table_header' v-bind:class="column"
                     v-for="(label, column) in columns"
                     :key="column"
                     @click="sortByColumn(column)">
                      <div class="h-wrapper">
                          {{ label }}
                          <span v-if="sortFields[column]" class="sort-arrow">
                            <i v-if="order === 'asc' && sortedColumn == column " class="material-icons dp48">expand_less</i>
                            <i v-else class="material-icons dp48">expand_more</i>
                        </span>
                      </div>
                </div>
                <div class='table_header'>Тренинг</div>
                <div class='table_header'>Ссылки</div>
            </div>
            <div class='table_row' v-if="tableData.length === 0">
                <div class='table_small'>
                    <div class="table-cell lead text-center" :colspan="columns.length + 1">Ничего не найдено</div>
                </div>
            </div>
            <div class='table_row' v-bind:class="{ 'selected' : selectedRow == key1}" v-bind:id="'row-'+key1"  @click="selectRow(key1)" v-for="(data, key1) in tableData" :key="data.id"  v-else>
                <div class='table_small'>
                    <div class='table_cell'>№:</div>
                    <div class='table_cell'>{{ serialNumber(key1) }}</div>
                </div>
                <div class='table_small' v-bind:class="key" v-for="(value, key) in data" v-if="columns[key] !== undefined">
                    <div class='table_cell'>{{ columns[key] }}:</div>
                    <div class='table_cell' v-if="key === 'audio'">
                        <span v-if="value!== null"><i class="material-icons dp48">volume_up</i></span>
                        <audio v-on:load="audioLoad" v-on:play="selectRow(key1)" v-if="value!== null">
                            <source :src="value.url" :type="value.mime" /></audio>
                        <span v-else><i class="material-icons dp48">volume_off</i></span>
                    </div>
                    <div v-else class='table_cell value_cell'>{{ value }}</div>
                </div>
                <div class='table_small'>
                    <div class='table_cell'>Тренинг:</div>
                    <div class='table_cell training-cell'>
                        <div><a href="javascript:void(0)" @click="openYouglishBox(tableData[key1].name)"><i class="icon ic-youglish"></i></a></div>
                        <div v-if="tableData[key1].phraseTraining > 0">
                            <a @click="saveUrl" v-bind:target="_blank" v-bind:href="'/word-training/'+tableData[key1].name">Фразы: {{ tableData[key1].phraseTraining }}</a>
                        </div>
                        <div v-if="tableData[key1].listenTraining > 0">
                            <a @click="saveUrl" v-bind:target="_blank" v-bind:href="'/word-training-sentence/'+tableData[key1].name">Слух: {{ tableData[key1].listenTraining }}</a>
                        </div>
                    </div>
                </div>
                <div class='table_small'>
                    <div class='table_cell'>Ссылки:</div>
                    <div class='table_cell link-cell'>
                        <a v-bind:href="tableData[key1].contextReversoLink" target="_blank" title="reverso"><i class="icon ic-reverso"></i></a>
                        <a v-bind:href="tableData[key1].meriamlLink" target="_blank"><i class="icon ic-meriam"></i></a>
                        <a v-bind:href="tableData[key1].wordHuntLink" target="_blank"><i class="icon ic-word-hunt"></i></a>
                        <a v-bind:href="tableData[key1].yandexLink" target="_blank"><i class="icon ic-yandex"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="pagination && tableData.length > 0" class="nav-table">
            <ul class="pagination">
                <li class="page-item" :class="{'disabled' : currentPage === 1}">
                    <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(currentPage - 1)">Назад</a>
                </li>
                <li v-for="page in pagesNumber" class="page-item"
                    :class="{'active': page == pagination.meta.current_page}">
                    <a href="javascript:void(0)" @click.prevent="changePage(page)" class="page-link">{{ page }}</a>
                </li>
                <li class="page-item" :class="{'disabled': currentPage === pagination.meta.last_page }">
                    <a class="page-link" href="javascript:void(0)" @click.prevent="changePage(currentPage + 1)">Вперед</a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    export default {
        props: {
            sortOrder:{type:String, required:false},
            sortField: {type:String, required:false},
            cardId: { type: String, required: true },
        },
        mounted() {
            this.audioLoad();
            this.setHandlerKeyPressed();
        },
        data() {
            return {
                dataBase: false,
                selectedRow: 0,
                isShowHotKey: false,
                autoNext: true,
                columns:{
                    "freq" : "Индекс",
                    "name" : "Слово",
                    "transcription" : "Тран-ция",
                    "translate" : "Перевод",
                    "audio" : "Аудио"
                },
                working: true,
                tableData: [],
                fetchUrl: "",
                url: '/api/words-table/id/'+ this.cardId,
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: 4,
                currentPage: 1,
                perPage: 25,
                sortFields:{"name":true, "freq": true},
                sortedColumn: "name",
                order: 'asc',
            }
        },
        watch: {
            fetchUrl: {
                handler: function(fetchUrl) {
                    this.url+= fetchUrl
                },
                immediate: true
            },
            selectedRow(value){
                if(this.dataBase){
                    this.dataBase.table_history.update({
                        card_id: this.cardId,
                        page: this.currentPage,
                        row: value,
                        sort: this.sortedColumn,
                        order: this.order,
                    }).then(function (item) {
                        // item added or updated
                    });
                }
            }
        },
        created() {
            if(this.sortField){
                this.sortedColumn = this.sortField;
            }
            if(this.sortOrder){
                this.order = this.sortOrder;
            }
            /*
            window.db.delete('true_english').then(function (ev) {

            }, function (err) {

            })
            */

            let indexDbCheck = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;

            if ( indexDbCheck ) {
                db.open({
                    server: 'true_english',
                    version: 1,
                    schema: {
                        table_history: {
                            key: {keyPath: 'card_id', autoIncrement: false},
                            card_id:{},
                            page: {},
                            row: {},
                            sort:{},
                            order:{},
                        }
                    }
                }).then(d => {
                    this.dataBase = d;
                    d.table_history.query()
                        .filter('card_id', this.cardId)
                        .execute()
                        .then((results)=> {
                            if(results[0]){
                                this.currentPage = results[0].page ? results[0].page : 1;
                                this.selectedRow = results[0].row ? results[0].row : 0;
                                this.sortedColumn = results[0].sort ? results[0].sort : this.sortedColumn;
                                this.order = results[0].order ? results[0].order : this.order;
                            }
                            this.fetchData()
                        })
                }).catch(d => {
                    this.fetchData()
                });
            }else{
                this.fetchData()
            }

        },
        computed: {
            /**
             * Get the pages number array for displaying in the pagination.
             * */
            pagesNumber() {
                if (!this.pagination.meta.to) {
                    return []
                }
                let from = this.pagination.meta.current_page - this.offset
                if (from < 1) {
                    from = 1
                }
                let to = from + (this.offset * 2)
                if (to >= this.pagination.meta.last_page) {
                    to = this.pagination.meta.last_page
                }
                let pagesArray = []
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page)
                }
                return pagesArray
            },
            /**
             * Get the total data displayed in the current page.
             * */
            totalData() {
                return (this.pagination.meta.to - this.pagination.meta.from) + 1
            }
        },
        methods: {
            fetchData() {
                let dataFetchUrl = `${this.url}?page=${this.currentPage}&column=${this.sortedColumn}&order=${this.order}&per_page=${this.perPage}`
                this.working = true;
                axios.get(dataFetchUrl)
                    .then(({ data }) => {
                        this.pagination = data
                        this.tableData = data.data
                        this.working = false;
                        if(this.dataBase) {
                            this.dataBase.table_history.update({
                                card_id: this.cardId,
                                page: this.currentPage,
                                row: this.selectedRow,
                                sort: this.sortedColumn,
                                order: this.order,
                            }).then(function (item) {
                                // item added or updated
                            });
                        }
                        this.$nextTick(() => {
                            this.audioLoad();
                        });
                    }).catch(error => {this.tableData = [];this.working = false;})
            },
            /**
             * Get the serial number.
             * @param key
             * */
            serialNumber(key) {
                return (this.currentPage - 1) * this.perPage + 1 + key
            },
            /**
             * Change the page.
             * @param pageNumber
             */
            changePage(pageNumber) {
                if(pageNumber < 1)  return false;

                if(this.pagination.meta.last_page < pageNumber ) return false;

                this.currentPage = pageNumber
                this.fetchData()
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#table-words").offset().top - 150
                }, 500);

                this.selectedRow = 0;

            },
            /**
             * Sort the data by column.
             * */
            sortByColumn(column) {
                if (column === this.sortedColumn) {
                    this.order = (this.order === 'asc') ? 'desc' : 'asc'
                } else {
                    this.sortedColumn = column
                    this.order = 'asc'
                }

                this.fetchData()
            },
            openYouglishBox(word){
                this.openYouglishClicked = true;
                window.openYouglishBox(word);
            },
            audioLoad(){
                $("audio").each(function(key, value){
                    value.load();
                });
            },
            selectRow(id){
                window.document.activeElement.blur();
                this.selectedRow = id;
                this.playAudioSelected()
            },
            playAudioSelected(){
                let player = window.document.querySelector('#row-' + this.selectedRow + " audio");
                if(player != undefined){
                    player.play();
                }
            },
            isOpenedYougish(){
                return window.$('#widget-youglish').length > 0;
            },
            saveUrl(){
              localStorage.go_back = location.href;
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

                    if(code === KEY_SPACE && !this.isOpenedYougish()){

                        if ($('video').is(":focus")) {
                            $('video').focusout();
                        }

                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_DOWN && this.tableData.length > this.selectedRow + 1 && !this.isOpenedYougish()){
                        this.selectedRow+=1
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#row-" + this.selectedRow).offset().top - 200
                        }, 50);
                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_UP && this.selectedRow > 0 && !this.isOpenedYougish()){
                        this.selectedRow-=1
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#row-" + this.selectedRow).offset().top - 200
                        }, 50);
                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_RIGHT && !this.isOpenedYougish()){
                        this.selectedRow-=1
                        this.changePage(this.currentPage + 1)
                        handled = true;
                    }

                    if(code == ARROW_LEFT && !this.isOpenedYougish()){
                        this.selectedRow-=1
                        this.changePage(this.currentPage - 1)
                        handled = true;
                    }

                    if(code == RIGHT_SHIFT && !this.isOpenedYougish()){
                        let word = $("#row-" + this.selectedRow + " .name .value_cell").text();
                        this.openYouglishBox(word);
                        handled = true;
                    }

                    if(code == ARROW_RIGHT && this.isOpenedYougish()){
                        if (window.curTrack < window.totalTracks && window._widget_youglish != undefined){
                            window._widget_youglish.next();
                        }
                    }

                    if(code == ARROW_LEFT && this.isOpenedYougish()){
                        if (window.curTrack > 0 && window._widget_youglish != undefined){
                            window._widget_youglish.previous();
                        }
                    }

                    if(code == RIGHT_CONTROL && this.isOpenedYougish()){
                        window._widget_youglish.close();
                        window.$.fancybox.close();
                        handled = true;
                    }

                    if(handled){
                        event.preventDefault();
                    }
                });
            }
        },
        filters: {
            columnHead(value) {
                return value.split('_').join(' ').toUpperCase()
            }
        },
        name: 'WordTableComponent'
    }
</script>

<style scoped>
    .nav-table{
        text-align: center;
    }
    .hot-key-link{
        display:inline-block;
        border-bottom: 1px dashed;
        line-height: 1;
    }
    .hot-keys{
        max-width: 1400px;
        width: 100%;
        text-align: right;
        margin-top: 8px;
    }
    @media (max-width: 650px) { .hot-keys{display:none} }
    .hot-keys ul{
        text-align:left;
        margin:auto;
        display:inline-block;
        text-align: right;
        margin: auto;
        display: inline-block;
        background-color: beige;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .hot-keys ul li{
        text-align:left;
    }
    .sort-arrow {
        cursor: pointer;
        position: relative;
        top: 6px;
    }
    .table-component .link-cell {
        width: 70px;
    }

    .h-wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }
    .table_row.selected .table_small{
        background-color: #e8e5a3;
    }
</style>