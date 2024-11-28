import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            message: 'Hello depuis Vue.js !'
        };
    },
});

app.mount('#app');