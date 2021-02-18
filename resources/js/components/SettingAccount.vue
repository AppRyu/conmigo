<template>
    <div>
        <h2 class="page-tit u-sm-mb-xl u-mb-lg"><i class="fas fa-cog u-mr-sm u-mr-base"></i>アカウント設定</h2>
        <section class="u-mb-base">
            <h3 class="u-fs-xl u-mb-base settings-account-subTit">メールアドレス変更</h3>
            <input class="form-control u-mb-base" type="text" v-model="user.email">
            <div class="u-mb-base"><button class="settings-account-btn">メールアドレスを変更</button></div>
        </section>
        <section>
            <h3 class="u-fs-xl u-mb-base settings-account-subTit settings-account-subTit--danger">アカウント削除</h3>
            <p class="u-mb-base">アカウントを削除します。本当に削除する場合は、下記のボタンをクリックしてください。</p>
            <div class="u-mb-base"><button class="settings-account-btn settings-account-btn--danger" @click="deleteAccount">アカウントを削除</button></div>
            <p v-if="message">{{ message }}</p>
        </section>
    </div>
</template>

<script>
export default {
    name: 'router-view',
    props: {
        accountDeleteUrl: {
            type: String,
        },
        redirectLogin: {
            type: String,
        },
        redirectLogout: {
            type: String,
        },
        userData: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            message: '',
            user: {
                email: this.userData.email
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
        async deleteAccount() {
            if(!confirm('本当にアカウントを削除しますか？')) {
                return false;
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