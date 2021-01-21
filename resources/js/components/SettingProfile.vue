<template>
    <section>
        <h2 class="page-tit u-sm-mb-xl u-mb-xl"><i class="fas fa-cog u-mr-sm u-mr-base"></i>プロフィール編集</h2>
        <div>
            <div class="u-d-flex flex-lg-row flex-column">
                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label class="u-mb-xs" for="name">お名前</label>
                        <input type="text" class="form-control" v-model="user.name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="user_name">ユーザー名</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.user_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="comment">プロフィールコメント</label>
                        <textarea class="form-control" v-model="user.comment" id="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="mysite"><i class="fas fa-globe fa-lg prof-content__icon u-mr-sm"></i>WEBサイト</label>
                        <input class="form-control" type="text" v-model="user.mysite" id="mysite" placeholder="sample@example.com">
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="twitter"><i class="fab fa-twitter fa-lg prof-content__icon u-mr-sm"></i>Twitterアカウント</label>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://twitter.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.twitter" id="twitter">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="instagram"><i class="fab fa-instagram fa-lg prof-content__icon u-mr-sm"></i>instagramアカウント</label>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://www.instagram.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.instagram" id="instagram">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="facebook"><i class="fab fa-facebook-f fa-lg prof-content__icon u-mr-sm"></i>facebookアカウント</label>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://www.facebook.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.facebook" id="facebook">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="form-group settings-prof-img">
                        <label class="u-mb-xs" for="profile_image">プロフィール画像</label>
                        <div class="settings-prof-img__box">
                            <input class="form-control settings-prof-img__input" type="file" id="profile_image" accept="image/*" @change="selectedFile" ref="preview">
                            <span class="settings-prof-img__edit-icon u-fw-bold"><i class="fas fa-pencil-alt u-mr-xs"></i>Edit</span>
                            <div class="settings-prof-img__user-icon" ref="image">
                                <img :src="upimage.fileUrl" alt="" v-if="upimage.fileUrl">
                                <img :src="userProfileImagePath" alt="プロフィール画像" v-else>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="settings-prof-btn--outline">
                <button @click.prevent="submit" class="settings-prof-btn">編集を更新する</button>
            </div>
        </div>
    </section>
</template>

<script>

import ImageUtil from '../lib/ImageUtil';

export default {
    props: {
        csrf: {
            type: String,
            required: true,
        },
        postToUserUpdate: {
            type: String,
            required: true,
        },
        userData: {
            type: Object,
            required: true,
        },
        userProfileImagePath: {
            type: String,
        }
    },
    data() {
        return {
            user: {
                name: this.userData.name,
                user_name: this.userData.user_name,
                comment: this.userData.comment,
                profile_image: this.userData.profile_image,
                mysite: this.userData.mysite,
                twitter: this.userData.twitter,
                instagram: this.userData.instagram,
                facebook: this.userData.facebook,
            },
            upimage: { fileUrl: '', blob: null } // 画像ファイル
        }
    },
    mounted() {
        let imageWidth = this.$refs.image.clientWidth + 'px';
        this.$refs.image.style.height = imageWidth;
        window.addEventListener('resize', this.resize);
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.resize);
    },
    methods: {
        resize() {
            let imageWidth = this.$refs.image.clientWidth + 'px';
            this.$refs.image.style.height = imageWidth;
        },
        async selectedFile(e) {
            const imageFile = e.target.files[0];
            if (!imageFile) {
                return ;
            }
            try {
                // 圧縮した画像を取得
                const compFile = await ImageUtil.getCompressImageFile(imageFile);
                // 画像情報の設定
                this.upimage.blob = compFile;
                this.upimage.fileUrl = await ImageUtil.getDataUrlFromFile(compFile);
            } catch (error) {
                console.log(error);
            }
        },
        async submit() {
            const formData = new FormData();
            const config = {
                headers: {
                    'content-type': 'multipart/form-data',
                    'X-HTTP-Method-Override': 'PUT',
                },
            };
            console.log('csrfトークンです；' + this.csrf);
            console.log('this.user.nameの値；' + this.user.name);
            console.log('this.user.user_nameの値：' + this.user.user_name);
            console.log('this.user.commentの値：' + this.user.comment);
            console.log('this.user.commentの型：' + typeof(this.user.comment));

            formData.append('name', this.user.name);
            formData.append('user_name', this.user.user_name);
            if(this.user.comment) formData.append('comment', this.user.comment);
            formData.append('profile_image', this.upimage.blob);
            formData.append('mysite', this.user.mysite !== null ? this.user.mysite : '');
            formData.append('twitter', this.user.twitter !== null ? this.user.twitter : '');
            formData.append('instagram', this.user.instagram !== null ? this.user.instagram : '');
            formData.append('facebook', this.user.facebook !== null ? this.user.facebook : '');
            await axios.post(this.postToUserUpdate, formData, config)
            .then(response => {
                console.log(response);
                location.reload();
                // TODO アラートを表示する機能
                
            })
            .catch(error => {
                console.log(error.response);
            });
        }
    }
}
</script>