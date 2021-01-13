import Vue from 'vue';
import Router from 'vue-router';

import SettingAccount from './components/SettingAccount';
import SettingProfile from './components/SettingProfile';

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
    ],
});
