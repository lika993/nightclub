<template>
    <div class="page page--main">
        <h1 class="title--main">Добро пожаловать на танцпол</h1>
        <div class="headline"  v-if="danceFloorInfo">
            <h3 v-if="danceFloorInfo['currentTrack']" class="track-info">На танцполе {{danceFloorInfo.danceList.length + danceFloorInfo.drinkingList.length}} человек(а)
            </h3>
            <button class="btn headline__btn" @click="generateUsers">Впустить в клуб еще 15 человек</button>
        </div>
        <div class="headline" v-if="danceFloorInfo['currentTrack']">
            <h3 v-if="danceFloorInfo['currentTrack']" class="track-info">Играет музыка:
                <span class="track-info__name">"{{danceFloorInfo.currentTrack['name']}}"</span>,
                <span>{{danceFloorInfo.currentTrack['artist']}}</span>,
                <span class="track-info__genre">{{danceFloorInfo.currentTrack['genre']}}</span>.
                <span>{{getTime(danceFloorInfo.currentTrack['duration'])}}</span>
            </h3>
            <button class="btn headline__btn" @click="changeMusic">Сменить музыку</button>
        </div>
        <div class="area" v-if="danceFloorInfo['currentTrack']">
            <vue-custom-scrollbar :settings="settings" class="dance-floor">
                <div class="area_background">
                    <h3>Танцуют {{danceFloorInfo.danceList.length}}:</h3>
                    <div class="area__grid">
                        <div  class="area__grid-item guest" v-for="guest,index in danceFloorInfo.danceList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
                            <div class="area__grid-title">
                                {{guest['name']}}
                            </div>
                            <div class="guest__movements">
                                <button class="btn guest__movements-btn" @click="toggleMovementsList($event)">
                                    <span class="guest__movements-btn-value--show">
                                        Показать движения
                                    </span>
                                    <span class="guest__movements-btn-value--hide">
                                        Скрыть движения
                                    </span>
                                </button>
                                <div :id="index" class="guest__movements-list" :class="{'guest__movements-list--visible': canShow(index)}">
                                    <div v-for="movement in guest['movements']" class="guest__movements-item" v-html="movement"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </vue-custom-scrollbar>
            <vue-custom-scrollbar v-if="danceFloorInfo['drinkingList']" :settings="settings"  class="bar">
                <div class="area_background">
                    <h3>Пьют водку {{danceFloorInfo.drinkingList.length}}:</h3>
                    <div class="area__grid">
                        <div class="area__grid-item" v-for="guest in danceFloorInfo.drinkingList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
                            <div class="area__grid-title">
                                {{guest['name']}}
                            </div>
                        </div>
                    </div>
                </div>
            </vue-custom-scrollbar>
        </div>
    </div>
</template>

<script>
import vueCustomScrollbar from 'vue-custom-scrollbar'
import "vue-custom-scrollbar/dist/vueScrollbar.css"

export default{
    data(){
        return {
            danceFloorInfo: {},
            errors: [],
            settings: {
                suppressScrollY: false,
                suppressScrollX: false,
                wheelPropagation: false
            }
        }
    },
    components: {
        vueCustomScrollbar
    },
    methods: {
        canShow(index) {
            return (this.danceFloorInfo.danceList[index] && this.danceFloorInfo.danceList[index]['show_movements'] === true)
        },
        getDanceFloorInfo(currentTrackId) {
            let currentTrackParam = currentTrackId ? '?trackId=' + currentTrackId : '';
            this.$http({
                url: `getDanceFloorInfo${currentTrackParam}`,
                method: 'GET'})
                .then(response => {
                    this.danceFloorInfo = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
        generateUsers() {
            let currentTrackId = this.danceFloorInfo.currentTrack.id
            this.$http({
                url: 'generateUsers?trackId=' + currentTrackId,
                method: 'GET'
            })
            .then(response => {
                if (response.data.status === 'success') {
                    this.getDanceFloorInfo(currentTrackId);
                }
            })
            .catch(e => {
                this.errors.push(e)
            })
        },
        changeMusic() {
            this.getDanceFloorInfo();
        },
        getTime(sec) {
            return new Date(sec * 1000).toISOString().substr(11, 8)
        },
        toggleMovementsList(event) {
            event.target.closest('.guest__movements').classList.toggle('guest__movements--opened');
        }
    },
    mounted() {
        this.getDanceFloorInfo();
    }
}
</script>
