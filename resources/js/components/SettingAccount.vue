<template>
    <section>
        <h2 class="page-tit u-mb-xl"><i class="fas fa-cog u-mr-sm u-mr-base"></i>アカウント設定</h2>
        <div>
            <h3 class="u-fs-xl u-mb-base settings-account-subTit settings-account-subTit--danger">アカウント削除</h3>
            <p class="u-mb-base">アカウントを削除します。本当に削除する場合は、下記のボタンをクリックしてください。</p>
            <div><button class="settings-account-btn" @click="deleteAccount">アカウントを削除</button></div>
            <p v-if="message">{{ message }}</p>
        </div>
    </section>
</template>

<script>
export default {
    name: 'router-view',
    props: {
        userId: {
            type: String,
        },
        redirectLogin: {
            type: String,
        },
        redirectLogout: {
            type: String,
        }
    },
    data() {
        return {
            message: '',
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
        async deleteAccount(userId) {
            await axios.delete('/user/' + this.userId)
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
</script>