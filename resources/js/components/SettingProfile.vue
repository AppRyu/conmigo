<template>
    <section>
        <h2 class="page-tit u-sm-mb-xl u-mb-xl"><i class="fas fa-cog u-mr-sm u-mr-base"></i>プロフィール編集</h2>
        <form method="post" :action="postToUserUpdate" enctype="multipart/form-data" @submit.prevent="submit">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="_method" value="put">
            <div class="u-d-flex">
                <div class="col-8">
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
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.mysite" id="mysite">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="twitter"><i class="fab fa-twitter fa-lg prof-content__icon u-mr-sm"></i>Twitterアカウント</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://twitter.com/</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.twitter" id="twitter">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="instagram"><i class="fab fa-instagram fa-lg prof-content__icon u-mr-sm"></i>instagramアカウント</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://www.instagram.com/</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.instagram" id="instagram">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="u-mb-xs" for="facebook"><i class="fab fa-facebook-f fa-lg prof-content__icon u-mr-sm"></i>facebookアカウント</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">https://www.facebook.com/</div>
                            </div>
                            <input class="form-control" type="text" v-model="user.facebook" id="facebook">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">編集を更新する</button>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group settings-prof-img">
                        <label class="u-mb-xs" for="profile_image">プロフィール画像</label>
                        <div class="settings-prof-img__box">
                            <input class="form-control settings-prof-img__input" type="file" id="profile_image" accept="image/*" @change="uploadFile" ref="preview">
                            <span class="settings-prof-img__edit-icon u-fw-bold"><i class="fas fa-pencil-alt u-mr-xs"></i>Edit</span>
                            <div class="settings-prof-img__user-icon" ref="image">
                                <img :src="url" alt="プロフィール画像" v-if="url">
                                <img :src="userProfileImagePath" alt="プロフィール画像" v-else>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</template>

<script>
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
            url: '',
        }
    },
    mounted() {
        let imageWidth = this.$refs.image.clientWidth + 'px';
        console.log(imageWidth);
        this.$refs.image.style.height = imageWidth;
    },
    watch: {

    },
    methods: {
        uploadFile(e) {
            const file = this.user.profile_image = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
            this.$refs.preview.value = "";
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
            formData.append('comment', this.user.comment);
            formData.append('profile_image',this.user.profile_image);
            formData.append('mysite', this.user.mysite);
            formData.append('twitter', this.user.twitter);
            formData.append('instagram', this.user.instagram);
            formData.append('facebook', this.user.facebook);
            console.log(formData);
            await axios.post(this.postToUserUpdate, formData, config)
            .then(response => {
                console.log('成功しました');
                console.log(response);
                location.reload();
                // アラートを表示する
                
            })
            .catch(err => {
                console.log('失敗しました');
                console.log(error.response);
            });
        }
    }
}
</script>