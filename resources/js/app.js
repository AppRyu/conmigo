import './bootstrap';
import Vue from 'vue';
import router from './router';
import CommunitySetTimeInput from './components/CommunitySetTimeInput.vue';
import CommunityRecruitBtn from './components/CommunityRecruitBtn.vue';
import CommunitySelectUser from './components/CommunitySelectUser.vue';

const app = new Vue({
    el: '#app',
    router,
    components: {
        CommunitySetTimeInput,
        CommunityRecruitBtn,
        CommunitySelectUser,
    },
});
