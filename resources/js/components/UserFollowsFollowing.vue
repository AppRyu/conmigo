<template>
    <div>
        <a :href="location + '/user/' + following.user_name " v-for="(following, index) in followings" :key="index">
            <div class="follows-content">
                <div class="u-d-flex">
                    <div class="u-mr-base">
                        <div class="c-icon-md">
                            <img v-if="following.profile_image" :src="'/storage/img/' + following.profile_image" alt="フォローしているユーザー">
                            <img v-else src="/img/default-icon.png" alt="フォローしているユーザー">
                        </div>
                    </div>
                    <div class="u-fb-fg-1">
                        <div class="u-xs-d-flex u-d-block u-fb-jc-btw">
                            <div>
                                <h3 class="u-fs-lg u-fw-bold">{{ following.name }}</h3>
                                <div class="u-tcd-gray"><span>@</span>{{ following.user_name }}</div>
                            </div>
                            <div>
                                <p class="u-tcd-gray u-ta-right">最終ログイン：{{ LastLoginTimeLag(following.last_login_at) }}</p>
                            </div>
                            <!-- TODO : ダイレクトメッセージ機能 -->
                            <!-- <div>
                                <button class="c-btn-blue">メッセージ</button>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
import LastLoginTimeLag from '../lib/LastLoginTimeLag';
export default {
    name: 'router-view',
    props: {
        followings: {
            type: Array,
        },
    },
    data() {
        return {
            location: location.origin
        }
    },
    methods: {
        LastLoginTimeLag(value) {
            return LastLoginTimeLag.getLastLoginTimeLag(value);
        }
    }
}
</script>