import Vue from 'vue';
import Router from 'vue-router';

import SettingAccount from './components/SettingAccount';
import SettingProfile from './components/SettingProfile';
import UserFollowFollowing from './components/UserFollowsFollowing';
import UserFollowFollower from './components/UserFollowFollower';

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/setting',
            redirect: '/setting/profile',
        },
        {
            path: '/setting/profile',
            name: 'setting-profile',
            component: SettingProfile,
        },
        {
            path: '/setting/account',
            name: 'setting-account',
            component: SettingAccount,
        },
        {
            path: '/follows',
            redirect: '/follows/following',
        },
        {
            path: '/follows/following',
            name: 'follows-following',
            component: UserFollowFollowing,
        },
        {
            path: '/follows/follower',
            name: 'follows-follower',
            component: UserFollowFollower,
        },
    ],
});
