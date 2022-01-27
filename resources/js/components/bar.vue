<template>
    <div v-if="drinkingList" class="bar">
        <vue-custom-scrollbar :settings="settings" class="area_background">
            <h3>Пьют водку {{drinkingList.length}}:</h3>
            <div class="area__grid">
                <div class="area__grid-item" v-for="guest in drinkingList" :style="{ backgroundImage: `url('${guest.currentDanceImage}')` }">
                    <div class="area__grid-title">
                        {{guest['name']}}
                    </div>
                </div>
            </div>
        </vue-custom-scrollbar>
    </div>
</template>

<script>
export default{
    props: ['settings', 'drinkingList']
}
</script>
