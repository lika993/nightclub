<template>
    <div class="page page--main">
        <h1 class="title--main">Добро пожаловать на танцпол</h1>
        <h3 v-if="danceFloorInfo['currentTrack']" class="track-info">Играет музыка:
            <span class="track-info__name">"{{danceFloorInfo.currentTrack['name']}}"</span>,
            <span>{{danceFloorInfo.currentTrack['artist']}}</span>,
            <span class="track-info__genre">{{danceFloorInfo.currentTrack['genre']}}</span>.
            <span>{{getTime(danceFloorInfo.currentTrack['duration'])}}</span>
        </h3>
        <div class="area">
            <div class="dance-floor">
                <div class="area_background">
                    <h3>Танцуют</h3>
                    <div class="area__grid">
                        <div  class="area__grid-item guest" v-for="guest,index in danceFloorInfo.danceList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
                            <div class="area__grid-title">
                                {{guest['name']}}
                            </div>
                            <div class="guest__movements">
                                <button class="guest__movements-btn" @click="toggleMovementsList($event)">
                                    Показать движения
                                </button>
                                <div :id="index" class="guest__movements-list" :class="{'guest__movements-list--visible': canShow(index)}">
                                    <div v-for="movement in guest['movements']" class="guest__movements-item" v-html="movement"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bar">
                <div class="area_background">
                    <h3>Пьют водку</h3>
                    <div class="area__grid">
                        <div class="area__grid-item" v-for="guest in danceFloorInfo.drinkingList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
                            <div class="area__grid-title">
                                {{guest['name']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default{
    data(){
        return {
            danceFloorInfo: {},
            errors: []
        }
    },
    methods: {
        canShow(index) {
            return (this.danceFloorInfo.danceList[index] && this.danceFloorInfo.danceList[index]['show_movements'] === true)
        },
        getDanceFloorInfo() {
            this.$http.get(`getDanceFloorInfo`)
                .then(response => {
                    this.danceFloorInfo = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
        getTime(sec) {
            return new Date(sec * 1000).toISOString().substr(11, 8)
        },
        toggleMovementsList(event) {
            // if (this.danceFloorInfo.danceList[index]['show_movements']) {
            //     delete this.danceFloorInfo.danceList[index]['show_movements'];
            // } else {
            //     this.danceFloorInfo.danceList[index]['show_movements'] = true;
            // }
            event.target.closest('.guest__movements').classList.toggle('guest__movements--opened')
        }
    },
    mounted() {
        this.getDanceFloorInfo();
    }
}
</script>
