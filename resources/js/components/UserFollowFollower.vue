<template>
    <div>
        <a :href="location + '/user/' + follower.user_name " v-for="(follower, index) in followers" :key="index">
            <div class="follows-content">
                <div class="u-d-flex">
                    <div class="u-mr-base">
                        <div class="c-icon-md">
                            <img v-if="follower.profile_image" :src="'/storage/img/' + follower.profile_image" alt="フォローしているユーザー">
                            <img v-else src="/img/default-icon.png" alt="フォローしているユーザー">
                        </div>
                    </div>
                    <div class="u-fb-fg-1">
                        <div class="u-xs-d-flex u-d-block u-fb-jc-btw">
                            <div>
                                <h3 class="u-fs-lg u-fw-bold">{{ follower.name }}</h3>
                                <div class="u-tcd-gray"><span>@</span>{{ follower.user_name }}</div>
                            </div>
                            <div class="u-tcd-gray u-ta-right">最終ログイン：{{ LastLoginTimeLag(follower.last_login_at) }}</div>
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
        followers: {
            type: Array
        }
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