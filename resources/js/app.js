import './bootstrap';
import Vue from 'vue';
import router from './router';
import { Slide } from 'vue-burger-menu';
import CommunitySetTimeInput from './components/CommunitySetTimeInput.vue';
import CommunityRecruitBtn from './components/CommunityRecruitBtn.vue';
import CommunitySelectUser from './components/CommunitySelectUser.vue';
import CommunityLike from './components/CommunityLike.vue';

const app = new Vue({
    el: '#app',
    router,
    components: {
        Slide,
        CommunitySetTimeInput,
        CommunityRecruitBtn,
        CommunitySelectUser,
        CommunityLike,
    },
});
