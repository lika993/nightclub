import VueRouter from 'vue-router';
import Home from './pages/Home.vue';

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        }

    ]
});

export default router;
