<template>
    <div class="table-component"
         v-bind:class="{loading: working}"
         id="table-words">
        <div class="action-block">
            <div class="search-row">
                <input @keyup.enter="search" type="text" class="text-input" placeholder="Поиск.." v-model="like">
                <button type="button" @click="search" class="search-btn btn">Искать</button>
            </div>
            <div class="hot-keys">
                <div>
                    <a href="javascript:void(0)" v-on:click="isShowHotKey = !isShowHotKey" class="hot-key-link">Показать клавишы навигации</a>
                </div>
                <ul v-show="isShowHotKey">
                    <li>Навигация по страницам: <b>&larr; &rarr;</b></li>
                    <li>Навигация по строкам: <b>&uarr; &darr;</b></li>
                    <li>Проиграть audio: <b>Пробел</b></li>
                    <li>Выбрать строку: <b>Клик мышкой по строке</b></li>
                </ul>
            </div>
        </div>
        <div v-if="pagination && tableData.length > 0" class="nav-table">
            <div class="select-page">
                <label for="page-number-top">Перейти к странице:</label>
                <input type="number" class="select-page-input text-input" id="page-number-top" v-model="inputPage" @change.prevent="changePage(inputPage)">
                из {{ pagination.meta.total }}
            </div>
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
                            <source :src="value" :type="'audio/mpeg'" /></audio>
                        <span v-else><i class="material-icons dp48">volume_off</i></span>
                    </div>
                    <div v-if="key=='word'" class='table_cell value_cell'>
                        <div class="word">{{ value}}</div>
                    </div>
                    <div v-if="key=='en_text'" class='table_cell value_cell'>
                        <div class="en-text">{{ tableData[key1].en_text}}</div>
                        <div class="ipa-text">{{ tableData[key1].ipa_text}}</div>
                        <div class="ru-text">{{ tableData[key1].ru_text[0]}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="pagination && tableData.length > 0" class="nav-table">
            <div class="select-page">
                <label for="page-number-bottom">Перейти к странице:</label>
                <input type="number" class="select-page-input text-input" id="page-number-bottom" v-model="inputPage" @change.prevent="changePage(inputPage)">
                из {{ pagination.meta.total }}
            </div>
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
            url: { type: String, required: true },
        },
        mounted() {
            this.audioLoad();
            this.setHandlerKeyPressed();
        },
        data() {
            return {
                inputPage: 1,
                id: 1,
                dataBase: false,
                selectedRow: 0,
                isShowHotKey: false,
                autoNext: true,
                columns:{
                    "word" : "Слово",
                    "en_text" : "Текст",
                    "audio" : "Аудио"
                },
                working: true,
                tableData: [],
                fetchUrl: "",
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: 4,
                currentPage: 1,
                perPage: 25,
                sortFields:{"word":true},
                sortedColumn: "word",
                order: 'asc',
                like: "",
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
                    this.dataBase.table_phrase_history.update({
                        id: this.id,
                        page: this.currentPage,
                        row: value,
                        sort: this.sortedColumn,
                        order: this.order,
                    }).then(function (item) {
                        // item added or updated
                    });
                }
            },
            currentPage(value)
            {
                this.inputPage = value;
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
                        table_phrase_history: {
                            key: {keyPath: 'id', autoIncrement: false},
                            id:{},
                            page: {},
                            row: {},
                            sort:{},
                            order:{},
                        }
                    }
                }).then(d => {
                    this.dataBase = d;
                    try {
                        d.table_phrase_history.query()
                            .filter('id', this.id)
                            .execute()
                            .then((results) => {
                                if (results[0]) {
                                    this.currentPage = results[0].page ? results[0].page : 1;
                                    this.selectedRow = results[0].row ? results[0].row : 0;
                                    this.sortedColumn = results[0].sort ? results[0].sort : this.sortedColumn;
                                    this.order = results[0].order ? results[0].order : this.order;
                                }
                                this.fetchData()
                            })
                    }catch(e){
                        window.db.delete('true_english').then(function (ev) {

                        }, function (err) {

                        })
                    }
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
                let dataFetchUrl = `${this.url}?page=${this.currentPage}&column=${this.sortedColumn}&order=${this.order}&per_page=${this.perPage}&like=${this.like}`
                this.working = true;
                axios.get(dataFetchUrl)
                    .then(({ data }) => {
                        this.pagination = data
                        this.tableData = data.data
                        this.working = false;
                        if(this.dataBase) {
                            this.dataBase.table_phrase_history.update({
                                id: this.id,
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
                    }).catch(error => {this.tableData = [];this.working = false; console.log(error)})
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
            search() {
                this.currentPage = 1;
                this.fetchData()
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

                    if(code === KEY_SPACE){

                        if ($('video').is(":focus")) {
                            $('video').focusout();
                        }

                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_DOWN && this.tableData.length > this.selectedRow + 1){
                        this.selectedRow+=1
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#row-" + this.selectedRow).offset().top - 200
                        }, 50);
                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_UP && this.selectedRow > 0){
                        this.selectedRow-=1
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#row-" + this.selectedRow).offset().top - 200
                        }, 50);
                        this.playAudioSelected()
                        handled = true;
                    }

                    if(code == ARROW_RIGHT){
                        this.selectedRow-=1
                        this.changePage(this.currentPage + 1)
                        handled = true;
                    }

                    if(code == ARROW_LEFT){
                        this.selectedRow-=1
                        this.changePage(this.currentPage - 1)
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
        name: 'PhraseTable'
    }
</script>

<style scoped>
    .en-text, .ipa-text, .ru-text{
        margin-top: 2px;
        margin-bottom: 2px;
        font-size: 16px;
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
    .select-page-input{
        width: 80px;
    }
    .text-input{
        height:36px;
        margin-right:4px;
    }
    .search-row{
        margin-top: 20px;
        display: flex;
        width:300px;
    }
    .action-block{
        display: flex;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }
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
        width: calc(100% - 400px);
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