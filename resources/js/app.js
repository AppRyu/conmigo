import "./bootstrap";
import Vue from "vue";
import CommunitySetTimeInput from "./components/CommunitySetTimeInput.vue";
import CommunityRecruitBtn from "./components/CommunityRecruitBtn.vue";
import CommunityAdminTabs from "./components/CommunityAdminTabs.vue";

const app = new Vue({
    el: "#app",
    components: {
        CommunitySetTimeInput,
        CommunityRecruitBtn,
        CommunityAdminTabs
    }
});
