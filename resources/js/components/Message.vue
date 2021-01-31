<template>
    <div class="chat-container u-px-base u-pt-base">
        <div class="chat-content u-xs-fb-fd-row u-fb-fd-clm u-pb-base">
            <div class="u-mr-base u-xs-mb-no u-mb-sm">
                <div class="c-icon-lg chat-icon--border" v-if="matchingUser.profile_image"><img :src="'/storage/img/' + matchingUser.profile_image" alt="チャット相手のプロフィール画像"></div>
                <div class="c-icon-lg chat-icon--border" v-else><img src="/img/default-icon.png" alt="チャット相手のプロフィール画像"></div>
            </div>
            <div class="chat-content__box">
                <h3 class="u-mb-sm"><a class="c-link-blue u-fs-xl u-fw-bold" :href="matchingUserUrl">{{ matchingUser.name }}</a></h3>
                <div class="u-fs-sm">最終ログイン：{{ LastLoginTimeLag(matchingUser.last_login_at) }}</div>
            </div>
        </div>
        <div class="chat-banner u-py-base" @click="isMore()" v-if="hidingMessageNum">
            <p class="c-link-blue u-ta-center">過去のメッセージを表示（{{ hidingMessageNum }}件）</p>
        </div>
        <div class="chat-content u-py-base" v-for="(message, index) in listItems" :key="index">
            <div class="chat-content_img u-mr-base">
                <div class="c-icon-md chat-icon--border" v-if="authUser.id === message.user_id && authUser.profile_image"><img :src="'/storage/img/' + authUser.profile_image" alt="ユーザープロフィール画像"></div>
                <div class="c-icon-md chat-icon--border" v-else-if="matchingUser.id === message.user_id && matchingUser.profile_image"><img :src="'/storage/img/' + matchingUser.profile_image" alt="ユーザープロフィール画像"></div>
                <div class="c-icon-md chat-icon--border" v-else><img src="/img/default-icon.png" alt="プロフィール画像"></div>
            </div>
            <section class="chat-content__box">
                <div class="chat-content__row u-mb_sm">
                    <h4 class="u-fs-base u-fw-xbd" v-if="authUser.id === message.user_id">{{ authUser.user_name }}</h4>
                    <h4 class="u-fs-base" v-else>{{ matchingUser.user_name }}</h4>
                    <p class="chat-content__date" v-text="message.created_at"></p>
                </div>
                <p class="chat-content__msg" v-text="message.body"></p>
            </section>
        </div>
        <div class="chat-content u-py-base">
            <div class="u-mr-base">
                <div v-if="authUser.profile_image" class="c-icon-md chat-icon--border"><img :src="'/storage/img/' + authUser.profile_image" alt="ユーザープロフィール画像"></div>
                <div v-else class="c-icon-md chat-icon--border"><img src="/img/default-icon.png" alt="ユーザープロフィール画像"></div>
            </div>
            <section class="chat-content__form-sec">
                <h4 class="u-fs-base u-fw-xbd u-mb-sm">{{ authUser.user_name }}</h4>
                <div class="chat-form">
                    <textarea class="chat-form__textarea u-mb-base" placeholder="メッセージを入力する..." v-model="message"></textarea>
                    <div class="u-ta-center">
                        <button class="chat-form__btn" type="button" @click="send()" :disabled="isDisabled">送信</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import LastLoginTimeLag from '../lib/LastLoginTimeLag';
export default {
    props: {
        roomId: {
            required: true,
        },
        matchingUser: {
            type: Object,
            required: true,
        },
        matchingUserUrl: {
            type: String,
            required: true,
        },
        authUser: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            message: '',
            messages: [],
            count: 10,
        }
    },
    computed: {
        listItems() {
            const list = this.messages;
            return list.slice( - this.count, list.length);
        },
        hidingMessageNum() {
            let num = this.messages.length - this.count;
            if(num < 0) {
                num = 0;
            }
            return num;
        },
        isDisabled() {
            return this.message === '' ? true : false;
        }
    },
    mounted() {
        this.getMessages();
        Echo.channel('chatChannel')
        .listen('MessagePusher', (e) => {
            this.getMessages();
        });
    },
    methods: {
        isMore() {
            this.count += 10;
        },
        send() {
            const url = "/ajax/message";
            const params = { message: this.message, chat_room_id: this.roomId, user_id: this.authUser.id };
            axios.post(url, params)
            .then((response) => {
                // 成功したらメッセージをクリア
                this.message = '';
            })
        },
        getMessages() {
            const url = "/ajax/message/?room_id=" + this.roomId;
            axios.get(url)
            .then((response) => {
                this.messages = response.data;
            });
        },
        LastLoginTimeLag(value) {
            return LastLoginTimeLag.getLastLoginTimeLag(value);
        }
    }
}
</script>