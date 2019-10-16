<template>
    <div class="phonetic-table">
        <div class="vowels-block">
            <div class="single-vowels">
               <div class="row-h">Одиночные гласные</div>
               <div class="tbl">
                   <div class="tbl-row">
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=PIu5WDIco0I&autoplay=1&t=10s`">
                           <span class="sound">iː</span>
                           <span class="word-example">gr<span class="accent-tip">ee</span>n</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=Ok_HG-0lNCA&autoplay=1&t=10s`">
                           <span class="sound">ɪ</span>
                           <span class="word-example">p<span class="accent-tip">i</span>nk</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=moLTR-dLQQY&autoplay=1&t=10s`">
                           <span class="sound">ʊ</span>
                           <span class="word-example">w<span class="accent-tip">oo</span>d</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=lkM6CKBM2ns&autoplay=1&t=10s`">
                           <span class="sound">uː</span>
                           <span class="word-example">bl<span class="accent-tip">ue</span></span>
                       </div>
                   </div>
                   <div class="tbl-row">
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=OLG3cCLcNiI&autoplay=1&t=10s`">
                           <span class="sound">ɛ</span>
                           <span class="word-example">r<span class="accent-tip">e</span>d</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=m1mDSUSwNls&autoplay=1&t=10s`">
                           <span class="sound">ə</span>
                           <span class="word-example">silv<span class="accent-tip">er</span></span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=6ppOrwjvslc&autoplay=1&t=10s`">
                           <span class="sound">ɜː</span>
                           <span class="word-example">p<span class="accent-tip">ur</span>ple</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=pr_KAu-_Hmo&autoplay=1&t=10s`">
                           <span class="sound">ɔː</span>
                           <span class="word-example">f<span class="accent-tip">aw</span>n</span>
                       </div>
                   </div>
                   <div class="tbl-row">
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=mynucZiy-Ug&autoplay=1&t=10s`">
                           <span class="sound">æ</span>
                           <span class="word-example">bl<span class="accent-tip">a</span>ck</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=X1utTZqC3AI&autoplay=1&t=10s`">
                           <span class="sound">ʌ</span>
                           <span class="word-example">r<span class="accent-tip">u</span>st</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=R5CY1UniS68&autoplay=1&t=10s`">
                           <span class="sound">ɑː</span>
                           <span class="word-example">kh<span class="accent-tip">a</span>ki</span>
                       </div>
                       <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=sALAE6iqLWk&autoplay=1&`">
                           <span class="sound">ɒ</span>
                           <span class="word-example"><span class="accent-tip">o</span>range</span>
                       </div>
                   </div>
               </div>
            </div>
            <div class="diphtongs">
                <div class="row-h">Дифтонги</div>
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=X0bkG5ZfzH4&autoplay=1&t=10s`">
                            <span class="sound">ɪr</span>
                            <span class="word-example">cl<span class="accent-tip">ear</span></span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=0RXzfRcjk-s&autoplay=1&t=10s`">
                            <span class="sound">eɪ</span>
                            <span class="word-example">gr<span class="accent-tip">ey</span></span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=x6E2L2vLH78&autoplay=1&t=10s`">
                            <span class="sound">ar</span>
                            <span class="word-example">c<span class="accent-tip">ar</span></span>
                        </div>
                        <div class="tbl-cell empty-cell"></div>
                    </div>
                    <div class="tbl-row">
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=F3tmoFM2ecw&autoplay=1&t=10s`">
                            <span class="sound">ʊr</span>
                            <span class="word-example">pu<span class="accent-tip">re</span> white</span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=ZfjPBN22mK8&autoplay=1&t=10s`">
                            <span class="sound">ɔɪ</span>
                            <span class="word-example">turqu<span class="accent-tip">oi</span>se</span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=4kPJLHiiGdU&autoplay=1&t=10s`">
                            <span class="sound">oʊ</span>
                            <span class="word-example">yell<span class="accent-tip">ow</span></span>
                        </div>
                        <div class="tbl-cell empty-cell"></div>
                    </div>
                    <div class="tbl-row">
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=PdV7RymsiMY&autoplay=1&t=10s`">
                            <span class="sound">ɪə</span>
                            <span class="word-example">f<span class="accent-tip">air</span></span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=8uD-GuuSgyk&autoplay=1&t=10s`">
                            <span class="sound">ɑɪ</span>
                            <span class="word-example">sk<span class="accent-tip">y</span> blue</span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=-V690OA75bA&autoplay=1&t=10s`">
                             <span class="sound">ɑʊ</span>
                            <span class="word-example">br<span class="accent-tip">ow</span>n</span>
                        </div>
                        <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=ZbDrxmP4_S4&autoplay=1&t=10s`">
                            <span class="sound">ɔr</span>
                            <span class="word-example">sp<span class="accent-tip">or</span>t</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="сonsonants-block">
            <div class="сonsonants">
                <div class="row-h">Согласные</div>
                <div class="сonsonants-wrapper">
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=V_n_rUKQSew&autoplay=1&t=10s`">
                                <span class="sound">p</span>
                                <span class="word-example"><span class="accent-tip">P</span>oland</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=LbCOXRz7Uf8&autoplay=1&t=10s`">
                                <span class="sound">b</span>
                                <span class="word-example"><span class="accent-tip">B</span>urma</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=mLlotV_0dRI&autoplay=1&t=10s`">
                                <span class="sound">t</span>
                                <span class="word-example"><span class="accent-tip">Th</span>ailand</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=N73xPe0x79g&autoplay=1&t=10s`">
                                <span class="sound">d</span>
                                <span class="word-example"><span class="accent-tip">D</span>enmark</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=05f62-73nrY&autoplay=1&t=10s`">
                                <span class="sound">f</span>
                                <span class="word-example"><span class="accent-tip">F</span>rance</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=U5Oro6v0klg&autoplay=1&t=10s`">
                                <span class="sound">v</span>
                                <span class="word-example"><span class="accent-tip">V</span>ientnam</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=qC0l6GQZtM4&autoplay=1&t=10s`">
                                <span class="sound">θ</span>
                                <span class="word-example">Sou<span class="accent-tip">th</span> Africa</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=EZb_EWVCUoE&autoplay=1&t=10s`">
                                <span class="sound">ð</span>
                                <span class="word-example"><span class="accent-tip">Th</span>e Philipines</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=tkiN8BsBEfA&autoplay=1&t=10s`">
                                <span class="sound">m</span>
                                <span class="word-example"><span class="accent-tip">M</span>exico</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=1eyr7O4TFmI&autoplay=1&t=10s`">
                                <span class="sound">n</span>
                                <span class="word-example"><span class="accent-tip">N</span>orway</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=5xVq8T88oJw&autoplay=1&t=10s`">
                                <span class="sound">ŋ</span>
                                <span class="word-example">Ho<span class="accent-tip">ng</span> Ko<span class="accent-tip">ng</span></span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=dV6At0g4n78&autoplay=1&t=10s`">
                                <span class="sound">h</span>
                                <span class="word-example"><span class="accent-tip">H</span>ungary</span>
                            </div>
                        </div>
                    </div>
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=WoyI_omRpcw&autoplay=1&t=10s`">
                                <span class="sound">tʃ</span>
                                <span class="word-example"><span class="accent-tip">Ch</span>ina</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=zJJ3hhHtjtI&autoplay=1&t=10s`">
                                <span class="sound">dʒ</span>
                                <span class="word-example"><span class="accent-tip">G</span>ermany</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=zxrveu6yu6E&autoplay=1&t=10s`">
                                <span class="sound">k</span>
                                <span class="word-example"><span class="accent-tip">K</span>orea</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=vP5XKYvxe0Q&autoplay=1&t=10s`">
                                <span class="sound">g</span>
                                <span class="word-example"><span class="accent-tip">G</span>reenland</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=6hWPXaPXrnQ&autoplay=1&t=10s`">
                                <span class="sound">s</span>
                                <span class="word-example"><span class="accent-tip">S</span>ingapore</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=ky7Jh9Bbjts&autoplay=1&t=10s`">
                                <span class="sound">z</span>
                                <span class="word-example"><span class="accent-tip">Z</span>ambia</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=wINb4HFguck&autoplay=1&t=10s`">
                                <span class="sound">ʃ</span>
                                <span class="word-example">Ru<span class="accent-tip">ss</span>ia</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=k8ImSmVOSVA&autoplay=1&t=10s`">
                                <span class="sound">ʒ</span>
                                <span class="word-example">Malay<span class="accent-tip">s</span>ia</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=ZTgYjGXFAkw&autoplay=1&t=10s`">
                                <span class="sound">l</span>
                                <span class="word-example"><span class="accent-tip">L</span>aos</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=q5a2-KuHkBU&autoplay=1&t=10s`">
                                <span class="sound">r</span>
                                <span class="word-example"><span class="accent-tip">R</span>omania</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=nMB5mX_PGHQ&autoplay=1&t=10s`">
                                <span class="sound">w</span>
                                <span class="word-example"><span class="accent-tip">W</span>alls</span>
                            </div>
                            <div class="tbl-cell show-youtube" v-bind:href="`https://www.youtube.com/watch?v=1G8SCotE2yg&autoplay=1&t=10s`">
                                <span class="sound">j</span>
                                <span class="word-example"><span class="accent-tip">Y</span>ugoslavia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            $('.show-youtube').fancybox({
            });
        }
    }
</script>

<style scoped>
    .phonetic-table{

    }
    .row-h{
        text-align: center;
        margin-top: 4px;
        margin-bottom: 4px;
        font-weight: 700;
    }
    .tbl{
        display: table;
        border: 1px solid #a5d1fd;
    }
    .tbl-row{
        display: table-row;
    }
    .tbl-cell{
        display: table-cell;
        padding: 6px;
        font-size: 16px;
        text-align:center;
        border: 1px solid #000;
        cursor: pointer;
    }
    .tbl-cell:hover, .single-vowels .tbl-cell:hover,.diphtongs .tbl-cell:hover, .сonsonants .tbl-cell:hover{
        background-color: #ec407a;
    }
    .diphtongs .tbl-cell.empty-cell{
        background-color: #ccc;
        cursor: default;
    }
    .tbl-cell:hover .accent-tip{
        color: #fff;
    }
    .tbl-cell:hover .sound{
        color: #fff;
    }
    .sound{
        font-size: 22px;
    }
    .word-example{
       display: block;
    }
    .vowels-block{
        display:flex;
    }
    .single-vowels{
        margin-right: 4px;
    }
    .single-vowels .row-h{

    }
    .single-vowels .tbl-cell{
        background-color: #fde2fb;
    }
    .diphtongs .tbl-cell{
        background-color: #c0ffea;
    }
    .accent-tip{
        font-weight: 700;
        color: #e61212;
    }
    .сonsonants{
        margin-top: 4px;
        display: inline-block;
    }
    .сonsonants-wrapper{
        display: flex;
    }
    .сonsonants .tbl-cell{
        background-color: #e8e8e8;
    }
    @media (max-width: 500px) {
        .vowels-block{
            display:block;
        }
        .single-vowels .tbl{
            margin:0;
            margin:auto;
        }
        .diphtongs .tbl{
            margin:0;
            margin:auto;
        }
    }
    @media (max-width: 720px) {
        .vowels-block[data-v-b9b472ba] {
            justify-content: center;
        }
        .tbl{
            width: 100%;
        }
        .сonsonants{
            display:block;
            width: 100%;
            text-align: center;
        }
        .сonsonants-wrapper{
            display: block;
        }
    }
</style>