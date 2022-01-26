import axios from 'axios'

export default {
    namespaced: true,
    state: {
        currentTrack: {},
        danceList: [],
        drinkingList: []
    },
    mutations: {
        setCurrentTrack(state, payload) {
            state.currentTrack = payload;
        },
        setDanceList(state, payload) {
            state.danceList = payload;
        },
        setDrinkingList(state, payload) {
            state.drinkingList = payload;
        }
    },
    actions: {
        getInfo({ commit }, payload) {
            let currentTrackParam = payload.currentTrackId ? '?trackId=' + payload.currentTrackId : '';
            return new Promise((resolve, reject) => {
                axios({
                    url: `getDanceFloorInfo${currentTrackParam}`,
                    method: 'GET'
                })
                .then(response => {
                    if (response.data.status === 'success') {
                        commit('setCurrentTrack', response.data.currentTrack || {});
                        commit('setDanceList', response.data.danceList || []);
                        commit('setDrinkingList', response.data.drinkingList || []);
                    }
                })
                .catch(err => {
                    reject(err);
                })
            })
        }
    },
    getters: {
        currentTrack: state => state.currentTrack,
        danceList: state => state.danceList,
        drinkingList: state => state.drinkingList
    }
}
