<template>
    <section>
        <h2 class="page-tit u-sm-mb-xl u-mb-xl"><i class="fas fa-cog u-mr-sm u-mr-base"></i>プロフィール編集</h2>
        <div>
            <div class="u-d-flex flex-lg-row flex-column">
                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label class="u-mb-xs" for="name">お名前</label>
                        <div v-if="errors.name.length">
                            <p class="text-danger" v-for="error in errors.name" :key="error.id">{{ error }}</p>
                        </div>
                        <input type="text" class="form-control" v-model="user.name" id="name" @change="checkForm" required>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="user_name">ユーザー名</label>
                        <div v-if="errors.user_name.length">
                            <p class="text-danger" v-for="error in errors.user_name" :key="error.id">{{ error }}</p>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.user_name" @change="checkForm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="comment">プロフィールコメント</label>
                        <div v-if="errors.comment.length">
                            <p class="text-danger" v-for="error in errors.comment" :key="error.id">{{ error }}</p>
                        </div>
                        <textarea class="form-control" v-model="user.comment" id="comment" maxlength="500" @change="checkForm"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="mysite"><i class="fas fa-globe fa-lg prof-content__icon u-mr-sm"></i>WEBサイト</label>
                        <input class="form-control" type="text" v-model="user.mysite" id="mysite" placeholder="sample@example.com">
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="twitter"><i class="fab fa-twitter fa-lg prof-content__icon u-mr-sm"></i>Twitterアカウント</label>
                        <div v-if="errors.twitter.length">
                            <p class="text-danger" v-for="error in errors.twitter" :key="error.id">{{ error }}</p>
                        </div>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://twitter.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.twitter" id="twitter" @change="checkForm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="instagram"><i class="fab fa-instagram fa-lg prof-content__icon u-mr-sm"></i>instagramアカウント</label>
                        <div v-if="errors.instagram.length">
                            <p class="text-danger" v-for="error in errors.instagram" :key="error.id">{{ error }}</p>
                        </div>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://www.instagram.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.instagram" id="instagram" @change="checkForm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="facebook"><i class="fab fa-facebook-f fa-lg prof-content__icon u-mr-sm"></i>facebookアカウント</label>
                        <div v-if="errors.facebook.length">
                            <p class="text-danger" v-for="error in errors.facebook" :key="error.id">{{ error }}</p>
                        </div>
                        <div class="input-group flex-sm-row flex-column">
                            <div class="input-group-prepend">
                                <div class="input-group-text input-group-text--sns">https://www.facebook.com/</div>
                            </div>
                            <input class="form-control form-control-sns" type="text" v-model="user.facebook" id="facebook" @change="checkForm">
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
                <button @click.prevent="submit" class="settings-prof-btn" :disabled="isDisabled">編集を更新する</button>
            </div>
        </div>
    </section>
</template>

<script>

import ImageUtil from '../lib/ImageUtil';

export default {
    props: {
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
            upimage: { fileUrl: '', blob: null }, // 画像ファイル
            errors: { // バリデーションエラーメッセージを格納
                name: [], user_name: [], comment: [], twitter: [], instagram: [], facebook: []
            },
        }
    },
    computed: {
        isDisabled() {
            // エラーメッセージが入っていた場合、「編集を更新する」ボタン => disabled
            return this.errors.name.length || this.errors.user_name.length || this.errors.comment.length || this.errors.twitter.length || this.errors.instagram.length || this.errors.facebook.length ? true : false;
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
        checkForm() {
            this.errors.name = [];
            if(!this.user.name) this.errors.name.push('入力必須項目です');
            if(15 <= this.user.name.length) this.errors.name.push('15文字以内で入力してください');

            this.errors.user_name = [];
            if(!this.user.user_name) this.errors.user_name.push('入力必須項目です');
            if(15 <= this.user.user_name.length) this.errors.user_name.push('15文字以内で入力してください');
            if(this.user.user_name.match(/[^A-Za-z0-9_]+/)) this.errors.user_name.push('半角英数字・アンダーバー(_)のみ使用可能です');

            if(this.user.comment && 500 <= this.user.comment.length) {
                this.errors.comment = [];
                this.errors.comment.push('500文字以内で入力してください');
            }
            
            if(this.user.twitter && 2 <= this.user.twitter.length) {
                this.errors.twitter = [];
                this.errors.twitter.push('255文字以内で入力してください');
            }

            if(this.user.instagram && 2 <= this.user.instagram.length) {
                this.errors.instagram = [];
                this.errors.instagram.push('255文字以内で入力してください');
            }

            if(this.user.facebook && 2 <= this.user.facebook.length) {
                this.errors.facebook = [];
                this.errors.facebook.push('255文字以内で入力してください');
            }
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
            formData.append('name', this.user.name);
            formData.append('user_name', this.user.user_name);
            if(this.user.comment) formData.append('comment', this.user.comment);
            if(this.upimage.blob) formData.append('profile_image', this.upimage.blob);
            formData.append('mysite', this.user.mysite ? this.user.mysite : '');
            formData.append('twitter', this.user.twitter ? this.user.twitter : '');
            formData.append('instagram', this.user.instagram ? this.user.instagram : '');
            formData.append('facebook', this.user.facebook ? this.user.facebook : '');
            await axios.post(this.postToUserUpdate, formData, config)
            .then(response => {
                //console.log(response);
                location.reload();
                // TODO アラートを表示する機能
                
            })
            .catch(error => {
                //console.log(error.response);
                // TODO アラートを表示する機能
            });
        }
    }
    
}
</script>