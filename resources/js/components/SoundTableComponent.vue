<template>
    <div class="phonetic-table">
        <div class="vowels-block">
            <div class="single-vowels">
               <div class="row-h">Одиночные гласные</div>
               <div class="tbl">
                   <div class="tbl-row">
                       <div class="tbl-cell">
                           <span class="sound" @click="play">iː</span>
                           <audio src="/storage/custom/sound_ee_as_bee.wav"></audio>
                           <span class="word-example">gr<span class="accent-tip">ee</span>n</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɪ</span>
                           <audio src="/storage/custom/sound_i_as_it.wav"></audio>
                           <span class="word-example">p<span class="accent-tip">i</span>nk</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ʊ</span>
                           <audio src="/storage/custom/sound_as_in_put.wav"></audio>
                           <span class="word-example">w<span class="accent-tip">oo</span>d</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">uː</span>
                           <audio src="/storage/custom/sound_u_as_in_blue.wav"></audio>
                           <span class="word-example">bl<span class="accent-tip">ue</span></span>
                       </div>
                   </div>
                   <div class="tbl-row">
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɛ</span>
                           <audio src="/storage/custom/sound_as_in_bed.wav"></audio>
                           <span class="word-example">r<span class="accent-tip">e</span>d</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ə</span>
                           <audio src="/storage/custom/sound_schwa_as_in_ago.wav"></audio>
                           <span class="word-example">silv<span class="accent-tip">er</span></span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɜː</span>
                           <audio src="/storage/custom/sound_r_as_in_first.wav"></audio>
                           <span class="word-example">p<span class="accent-tip">ur</span>ple</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɔː</span>
                           <audio src="/storage/custom/sound_o_as_in_on.wav"></audio>
                           <span class="word-example">f<span class="accent-tip">aw</span>n</span>
                       </div>
                   </div>
                   <div class="tbl-row">
                       <div class="tbl-cell" >
                           <span class="sound" @click="play">æ</span>
                           <audio src="/storage/custom/sound_as_in_cat.wav"></audio>
                           <span class="word-example">bl<span class="accent-tip">a</span>ck</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ʌ</span>
                           <audio src="/storage/custom/sound_as_in_us.wav"></audio>
                           <span class="word-example">r<span class="accent-tip">u</span>st</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɑː</span>
                           <audio src="/storage/custom/sound_as_in_got.wav"></audio>
                           <span class="word-example">kh<span class="accent-tip">a</span>ki</span>
                       </div>
                       <div class="tbl-cell">
                           <span class="sound" @click="play">ɒ</span>
                           <audio src="/storage/custom/sound_as_in_orange.wav"></audio>
                           <span class="word-example"><span class="accent-tip">o</span>range</span>
                       </div>
                   </div>
               </div>
            </div>
            <div class="diphtongs">
                <div class="row-h">Дифтонги</div>
                <div class="tbl">
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɪr</span>
                            <audio src="/storage/custom/sound_r_as_in_hero.wav"></audio>
                            <span class="word-example">cl<span class="accent-tip">ear</span></span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">eɪ</span>
                            <audio src="/storage/custom/sound_e_as_in_make.wav"></audio>
                            <span class="word-example">gr<span class="accent-tip">ey</span></span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ar</span>
                            <audio src="/storage/custom/sound_r_as_in_car.wav"></audio>
                            <span class="word-example">c<span class="accent-tip">ar</span></span>
                        </div>
                        <div class="tbl-cell empty-cell"></div>
                    </div>
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ʊr</span>
                            <audio src="/storage/custom/sound_as_in_sure.wav"></audio>
                            <span class="word-example">pu<span class="accent-tip">re</span> white</span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɔɪ</span>
                            <audio src="/storage/custom/sound_as_in_boy.wav"></audio>
                            <span class="word-example">turqu<span class="accent-tip">oi</span>se</span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">oʊ</span>
                            <audio src="/storage/custom/sound_o_as_in_go.wav"></audio>
                            <span class="word-example">yell<span class="accent-tip">ow</span></span>
                        </div>
                        <div class="tbl-cell empty-cell"></div>
                    </div>
                    <div class="tbl-row">
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɪə</span>
                            <audio src="/storage/custom/sound_ar_as_in_fire.wav"></audio>
                            <span class="word-example">f<span class="accent-tip">air</span></span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɑɪ</span>
                            <audio src="/storage/custom/sound_a_as_in_like.wav"></audio>
                            <span class="word-example">sk<span class="accent-tip">y</span> blue</span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɑʊ</span>
                            <audio src="/storage/custom/sound_a_as_in_cloud.wav"></audio>
                            <span class="word-example">br<span class="accent-tip">ow</span>n</span>
                        </div>
                        <div class="tbl-cell">
                            <span class="sound" @click="play">ɔr</span>
                            <audio src="/storage/custom/sound_r_as_in_sport.wav"></audio>
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
                            <div class="tbl-cell" >
                                <span class="sound" @click="play">p</span>
                                <audio src="/storage/custom/sound_p_as_in_pie.wav"></audio>
                                <span class="word-example"><span class="accent-tip">P</span>oland</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">b</span>
                                <audio src="/storage/custom/sound_b_as_in_boy.wav"></audio>
                                <span class="word-example"><span class="accent-tip">B</span>urma</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">t</span>
                                <audio src="/storage/custom/sound_t_as_in_toy.wav"></audio>
                                <span class="word-example"><span class="accent-tip">Th</span>ailand</span>
                            </div>
                            <div class="tbl-cell" @click="play">
                                <span class="sound">d</span>
                                <audio src="/storage/custom/sound_d_as_in_dog.wav"></audio>
                                <span class="word-example"><span class="accent-tip">D</span>enmark</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell" >
                                <span class="sound" @click="play">f</span>
                                <audio src="/storage/custom/sound_f_as_in_fun.wav"></audio>
                                <span class="word-example"><span class="accent-tip">F</span>rance</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">v</span>
                                <audio src="/storage/custom/sound_v_as_in_very.wav"></audio>
                                <span class="word-example"><span class="accent-tip">V</span>ientnam</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">θ</span>
                                <audio src="/storage/custom/sound_as_in_think.wav"></audio>
                                <span class="word-example">Sou<span class="accent-tip">th</span> Africa</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">ð</span>
                                <audio src="/storage/custom/sound_as_in_this.wav"></audio>
                                <span class="word-example"><span class="accent-tip">Th</span>e Philipines</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <span class="sound" @click="play">m</span>
                                <audio src="/storage/custom/sound_m_as_in_map.wav"></audio>
                                <span class="word-example"><span class="accent-tip">M</span>exico</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">n</span>
                                <audio src="/storage/custom/sound_n_as_in_nice.wav"></audio>
                                <span class="word-example"><span class="accent-tip">N</span>orway</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">ŋ</span>
                                <audio src="/storage/custom/sound_ng_as_in_thing.wav"></audio>
                                <span class="word-example">Ho<span class="accent-tip">ng</span> Ko<span class="accent-tip">ng</span></span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">h</span>
                                <audio src="/storage/custom/sound_h_as_in_home.wav"></audio>
                                <span class="word-example"><span class="accent-tip">H</span>ungary</span>
                            </div>
                        </div>
                    </div>
                    <div class="tbl">
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <span class="sound" @click="play">tʃ</span>
                                <audio src="/storage/custom/sound_t_as_in_chair.wav"></audio>
                                <span class="word-example"><span class="accent-tip">Ch</span>ina</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">dʒ</span>
                                <audio src="/storage/custom/sound_d_as_in_job.wav"></audio>
                                <span class="word-example"><span class="accent-tip">G</span>ermany</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">k</span>
                                <audio src="/storage/custom/sound_k_as_in_key.wav"></audio>
                                <span class="word-example"><span class="accent-tip">K</span>orea</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">g</span>
                                <audio src="/storage/custom/sound_g_as_in_gift.wav"></audio>
                                <span class="word-example"><span class="accent-tip">G</span>reenland</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <span class="sound" @click="play">s</span>
                                <audio src="/storage/custom/sound_s_as_in_sun.wav"></audio>
                                <span class="word-example"><span class="accent-tip">S</span>ingapore</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">z</span>
                                <audio src="/storage/custom/sound_z_as_in_zoo.wav"></audio>
                                <span class="word-example"><span class="accent-tip">Z</span>ambia</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">ʃ</span>
                                <audio src="/storage/custom/sound_as_in_show.wav"></audio>
                                <span class="word-example">Ru<span class="accent-tip">ss</span>ia</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">ʒ</span>
                                <audio src="/storage/custom/sound_as_in_vision.wav"></audio>
                                <span class="word-example">Malay<span class="accent-tip">s</span>ia</span>
                            </div>
                        </div>
                        <div class="tbl-row">
                            <div class="tbl-cell">
                                <span class="sound">l</span>
                                <span class="sound" @click="play"></span>
                                <audio src="/storage/custom/sound_l_as_in_let.wav"></audio>
                                <span class="word-example"><span class="accent-tip">L</span>aos</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">r</span>
                                <audio src="/storage/custom/sound_r_as_in_run.wav"></audio>
                                <span class="word-example"><span class="accent-tip">R</span>omania</span>
                            </div>
                            <div class="tbl-cell">
                                <span class="sound" @click="play">w</span>
                                <audio src="/storage/custom/sound_w_as_in_way.wav"></audio>
                                <span class="word-example"><span class="accent-tip">W</span>alls</span>
                            </div>
                            <div class="tbl-cell" @click="play">
                                <span class="sound">j</span>
                                <audio src="/storage/custom/sound_j_as_in_yes.wav"></audio>
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

        },
        methods:{
            play(event){
                event.target.nextElementSibling.play();
            }
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
        position:relative;
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
    .sound:before{
        position: absolute;
        height: 100%;
        width: 100%;
        z-index: 1;
        content: '';
        display: block;
        left:0;
        top:0;
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