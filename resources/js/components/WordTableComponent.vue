<template>
    <div class="table-component" v-bind:class="{loading: working}">
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
                <div class='table_header'>Видео</div>
                <div class='table_header'>Ссылки</div>
            </div>
            <div class='table_row' v-if="tableData.length === 0">
                <div class='table_small'>
                    <div class="table-cell lead text-center" :colspan="columns.length + 1">Ничего не найдено</div>
                </div>
            </div>
            <div class='table_row' v-for="(data, key1) in tableData" :key="data.id"  v-else>
                <div class='table_small'>
                    <div class='table_cell'>№</div>
                    <div class='table_cell'>{{ serialNumber(key1) }}</div>
                </div>
                <div class='table_small' v-bind:class="key" v-for="(value, key) in data" v-if="columns[key] !== undefined">
                    <div class='table_cell'>{{ columns[key] }}</div>
                    <div class='table_cell' v-if="key === 'audio'">
                        <audio v-on:load="audioLoad" controls v-if="value!== null"><source :src="value.url" :type="value.mime" /></audio>
                        <span v-else>Фаил не найден</span>
                    </div>
                    <div v-else class='table_cell value_cell'>{{ value }}</div>
                </div>
                <div class='table_small'>
                    <div class='table_cell'>Видео</div>
                    <div class='table_cell'>
                        <a href="javascript:void(0)" @click="openYouglishBox(tableData[key1].name)"><i class="icon ic-youglish"></i></a>
                    </div>
                </div>
                <div class='table_small'>
                    <div class='table_cell'>Ссылки</div>
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
        },
        data() {
            return {
                columns:{
                    "freq" : "Частота",
                    "name" : "Слово",
                    "transcription" : "Тран-ция",
                    "translate" : "Перевод",
                    "audio" : "Аудио"
                },
                working: true,
                tableData: [],
                fetchUrl: "",
                url: '/api/words-table/id/'+this.cardId,
                pagination: {
                    meta: { to: 1, from: 1 }
                },
                offset: 4,
                currentPage: 1,
                perPage: 50,
                sortFields:{"name":true, "freq": true},
                sortedColumn: "name",
                order: 'asc'
            }
        },
        watch: {
            fetchUrl: {
                handler: function(fetchUrl) {
                    this.url+= fetchUrl
                },
                immediate: true
            }
        },
        created() {
            if(this.sortField){
                this.sortedColumn = this.sortField;
            }
            if(this.sortOrder){
                this.order = this.sortOrder;
            }
            return this.fetchData()
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
                window.scrollTo(0, 0);
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
                let widget = `<div class="youglish-box"><div id="widget-youglish"></div></div>`;
                let self = this;
                $.fancybox.open(widget, {
                    beforeShow(){
                        self.runYouglish(word)
                    },
                    beforeClose(){
                        window.youglish_tag.remove();
                    }
                });
            },
            runYouglish(word){
                // 2. This code loads the widget API code asynchronously.
                window.youglish_tag = document.createElement('script');

                window.youglish_tag.src = "https://youglish.com/public/emb/widget.js";
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(window.youglish_tag, firstScriptTag);

                window.widget;
                window.onYouglishAPIReady = function(){
                    window.widget = new YG.Widget("widget-youglish", {
                        width: 480,
                        components:8 + 16 + 64, //search box & caption
                        events: {
                            'onSearchDone': onSearchDone,
                            'onVideoChange': onVideoChange,
                            'onCaptionConsumed': onCaptionConsumed
                        }
                    });
                    // 4. process the query
                    window.widget.search(word,"US");
                }

                var autoChangeTimer;

                var views = 0, curTrack = 0, totalTracks = 0;

                // 5. The API will call this method when the search is done
                window.onSearchDone = function(event){
                    if (event.totalResult === 0){
                        alert("Видео по этому слову не найдено");
                        window.$.fancybox.close();
                    }
                    else {
                        totalTracks = event.totalResult;
                    }
                }

                // 6. The API will call this method when switching to a new video.
                window.onVideoChange = function(event){
                    curTrack = event.trackNumber;
                    views = 0;
                    if(autoChangeTimer){
                        clearTimeout(autoChangeTimer);
                    }
                }

                // 7. The API will call this method when a caption is consumed.
                window.onCaptionConsumed = function(event){
                    if (curTrack < totalTracks){
                        autoChangeTimer = setTimeout(function(){
                            widget.next();
                        }, 2000)
                    }

                }
            },
            audioLoad: function(){
                $("audio").each(function(key, value){
                    value.load();
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
    .sort-arrow {
        cursor: pointer;
        position: relative;
        top: 6px;
    }
    .table-component .link-cell {
        width: 70px;
    }
    .table_small.audio {
        width: 70px;
    }
    .table-component audio {
        width: 100px;
    }
    .h-wrapper {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .article-detail .table_small.freq {
        display: none;
    }
    .article-detail .table_header.freq {
        display: none;
    }

</style>