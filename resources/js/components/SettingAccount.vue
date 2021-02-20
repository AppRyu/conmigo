<template>
    <div>
        <h2 class="page-tit u-sm-mb-xl u-mb-lg"><i class="fas fa-cog u-mr-sm u-mr-base"></i>アカウント設定</h2>
        <section class="u-mb-base">
            <h3 class="u-fs-xl u-mb-base settings-account-subTit">メールアドレス変更</h3>
            <input class="form-control u-mb-sm" type="email" v-model="user.email" placeholder="sample@example.com">
            <p class="u-mb-sm u-tcd-red" v-if="error.email">{{ error.email }}</p>
            <div class="u-mb-base"><button class="settings-account-btn" @click="changeEmail">メールアドレスを変更</button></div>
        </section>
        <section>
            <h3 class="settings-account-subTit u-fs-xl u-tcd-red u-mb-base">アカウント削除</h3>
            <p class="u-mb-base">アカウントを削除します。本当に削除する場合は、下記のボタンをクリックしてください。</p>
            <div class="u-mb-base"><button class="settings-account-btn settings-account-btn--danger" @click="deleteAccount">アカウントを削除</button></div>
            <p v-if="message">{{ message }}</p>
        </section>
    </div>
</template>

<script>

import ValidateEmail from '../lib/ValidateEmail';

export default {
    name: 'router-view',
    props: {
        accountDeleteUrl: {
            type: String,
            required: true,
        },
        redirectLogin: {
            type: String,
            required: true,
        },
        redirectLogout: {
            type: String,
            required: true,
        },
        userData: {
            type: Object,
            required: true,
        },
        postToUserUpdate: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            message: '',
            user: {
                email: this.userData.email
            },
            error: {
                email: '',
                account: '',
            }
        };
    },
    methods: {
        redirectToLoginPage() {
            window.location.href = this.redirectLogin;
        },
        Logout() {
            axios.post(this.redirectLogout)
            .then(response => {
                this.message = 'ログアウトしました。';
            })
            .catch(err => {
                this.message = 'エラーが発生しました。しばらく経ってから再度お試しください。';
            });
        },
        async changeEmail() {
            // メールアドレスのバリデーションチェック
            this.error.email = ValidateEmail.validate(this.user.email);
            if (this.user.email === this.userData.email) {
                return this.error.email = 'メールアドレスが変更されていません';
            }
            if(!this.error.email) {
                const formData = new FormData();
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-HTTP-Method-Override': 'PUT',
                    },
                };
                formData.append('email', this.user.email);
                await axios.post(this.postToUserUpdate, formData, config)
                .then(response => {
                    location.reload();
                })
                .catch(error => {
                    this.error.email = 'エラーが発生しました。しばらく経ってから再度お試しください。'
                });
            }
        },
        async deleteAccount() {
            if(!confirm('本当にアカウントを削除しますか？')) {
                return;
            } else {
                await axios.delete(this.accountDeleteUrl)
                .then(response => {
                    this.Logout();
                    this.redirectToLoginPage();
                    this.message = '正常にアカウントは削除されました。まもなくログインページへ遷移します。';
                })
                .catch(err => {
                    this.message = 'エラーが発生しました。しばらく経ってから再度お試しください。'
                });
            }
        }
    }
}
</script>