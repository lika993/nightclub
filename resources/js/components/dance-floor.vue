<template>
        <div v-if="currentTrack" class="dance-floor">
            <vue-custom-scrollbar :settings="settings" class="area_background">
                <h3>Танцуют {{danceList.length}}:</h3>
                <div class="area__grid">
                    <div  class="area__grid-item guest" v-for="(guest, index) in danceList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
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
            </vue-custom-scrollbar>
        </div>
</template>

<script>
export default{
    props: ['settings', 'toggleMovementsList', 'currentTrack', 'danceList', 'canShow']
}
</script>
