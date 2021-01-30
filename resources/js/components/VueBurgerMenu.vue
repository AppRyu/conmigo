<template>
    <slide class="burger-slide u-sm-d-none u-d-block" right no-overlay width="200" @openMenu="handleOpenMenu" @closeMenu="handleCloseMenu">
        <a :href="profileUrl">
            <span :class="txtState"><i class="fas fa-user u-mr-sm"></i>プロフィール</span>
        </a>
        <a :href="communityPlanUrl">
            <span :class="txtState"><i class="fas fa-school u-mr-sm"></i>コミュニティ管理</span>
        </a>
        <a :href="chatRoomUrl">
            <span :class="txtState"><i class="fas fa-comments u-mr-base"></i>チャットルーム</span>
        </a>
        <a :href="messageUrl">
            <span :class="txtState"><i class="fas fa-envelope u-mr-sm"></i>メッセージ</span>
        </a>
        <a :href="communityLikesUrl">
            <span :class="txtState"><i class="fas fa-star u-mr-sm"></i>お気に入り</span>
        </a>
        <a :href="settingUrl">
            <span :class="txtState"><i class="fas fa-cog u-mr-sm"></i>設定</span>
        </a>
        <a onclick="event.preventDefault(); document.getElementById('logout-form--sp').submit();">
            <span :class="txtState"><i class="fas fa-sign-out-alt u-tcd-red u-mr-sm"></i>ログアウト</span>
        </a>
        <form id="logout-form--sp" :action="logoutUrl" method="POST" style="display: none;">
            <input type="hidden" name="_token" :value="csrf">
        </form>
    </slide>
</template>

<script>
import { Slide } from 'vue-burger-menu';
export default {
    components: {
        Slide,
    },
    props: {
        csrf: {
            type: String,
            required: true,
        },
        profileUrl: {
            type: String,
            required: true,
        },
        communityPlanUrl: {
            type: String,
            required: true,
        },
        chatRoomUrl: {
            type: String,
            required: true,
        },
        messageUrl: {
            type: String,
            required: true,
        },
        communityLikesUrl: {
            type: String,
            required: true,
        },
        settingUrl: {
            type: String,
            required: true,
        },
        logoutUrl: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            txtState: 'burger-slide__txt',
        }
    },
    methods: {
        handleOpenMenu() {
            this.txtState = 'burger-slide__txt--active'; // opacity: 1;
        },
        handleCloseMenu() {
            this.txtState = 'burger-slide__txt'; // opacity: 0;
        }
    },
}
</script>