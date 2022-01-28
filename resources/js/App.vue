<template>
    <div class="page page--main">
        <h1 class="title--main">Добро пожаловать на танцпол</h1>
        <div class="headline">
            <h3 v-if="guestCount" class="track-info">В клубе {{guestCount()}} человек(а)
            </h3>
            <button class="btn headline__btn" @click="generateUsers">Впустить в клуб еще 15 человек</button>
        </div>
        <div class="headline" v-if="!objectIsEmpty(currentTrack)">
            <h3 v-if="currentTrack['name']" class="track-info">Играет музыка:
                <span class="track-info__name">"{{currentTrack['name']}}"</span>,
                <span>{{currentTrack['artist']}}</span>,
                <span class="track-info__genre">{{currentTrack['genre']}}</span>.
                <span v-if="currentTrack['duration']">{{getTime(currentTrack['duration'])}}</span>
            </h3>
            <button class="btn headline__btn" @click="changeMusic">Сменить музыку</button>
        </div>
        <div class="area" v-if="!objectIsEmpty(currentTrack)">
            <danceFloor :settings="settings"
                        :toggleMovementsList="toggleMovementsList"
                        :currentTrack="currentTrack"
                        :danceList="danceList"
                        :canShow="canShow"></danceFloor>
            <bar class="bar"
                :settings="settings"
                :drinkingList="drinkingList"></bar>
        </div>
    </div>
</template>

<script>
import danceFloor from './components/dance-floor';
import bar from './components/bar';

export default{
    data(){
        return {
            errors: [],
            settings: {
                suppressScrollY: false,
                suppressScrollX: false,
                wheelPropagation: false
            }
        }
    },
    components: {
       danceFloor, bar
    },
    computed: {
        currentTrack() {
            return this.$store.getters['danceFloor/currentTrack'];
        },
        danceList() {
            return this.$store.getters['danceFloor/danceList'];
        },
        drinkingList() {
            return this.$store.getters['danceFloor/drinkingList'];
        }
    },
    methods: {
        canShow(index) {
            return (this.danceList[index] && this.danceList[index]['show_movements'] === true);
        },
        objectIsEmpty(obj) {
            for (let key in obj) {
                return false;
            }
            return true;
        },
        guestCount() {
            return this.danceList.length + this.drinkingList.length;
        },
        getDanceFloorInfo(currentTrackId) {
            this.$store.dispatch('danceFloor/getInfo', {
                currentTrackId
            })
        },
        generateUsers() {
            let currentTrackId = this.currentTrack.id;
            this.$http({
                url: 'generateUsers',
                method: 'GET'
            }).then((response) => {
                if (response.data.status === 'success') {
                    this.$store.dispatch('danceFloor/getInfo', {
                        currentTrackId
                    })
                }
            })
            .catch(e => {
                this.errors.push(e);
            })
        },
        changeMusic() {
            this.getDanceFloorInfo();
        },
        getTime(sec) {
            return new Date(sec * 1000).toISOString().substr(11, 8);
        },
        toggleMovementsList(event) {
            event.target.closest('.guest__movements').classList.toggle('guest__movements--opened');
        }
    },
    mounted() {
        this.$store.dispatch('danceFloor/getInfo', {});
    }
}
</script>
