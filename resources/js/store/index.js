import Vuex from 'vuex';
import Vue from 'vue';

import danceFloor from './modules/danceFloor';

Vue.use(Vuex)

const modules = {
    danceFloor
}

export default new Vuex.Store({
    modules
})
