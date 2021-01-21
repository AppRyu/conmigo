<template>
    <a class="community-like" @click.prevent="clickLike">
        <span :class="starColor">
            <vue-star ref="icon" class="community-like__vue-star" animate="animated rubberBand">
                <i slot="icon" class="fas fa-star"></i>
            </vue-star>
        </span>
        <span class="community-like__txt">お気に入り</span>
    </a>
</template>

<script>
import VueStar from 'vue-star';
export default {
    components: {
        VueStar,
    },
    props: {
        initialIsLikedBy: {
            type: Boolean,
            default: false,
        },
        authorized: {
            type: Boolean,
            default: false,
        },
        endpoint: {
            type: String,
        }
    },
    data() {
        return {
            isLikedBy: this.initialIsLikedBy,
        }
    },
    mounted() {
        this.isLikedBy ? this.$refs.icon.$data.active = true : this.$refs.icon.$data.active = false;
    },
    computed: {
        starColor() {
            return this.isLikedBy ? 'community-like__star--active' : 'community-like__star';
        },
        
    },
    methods: {
        clickLike() {
            if(!this.authorized) {
                alert('いいね機能はログイン中のみしようできます');
                return 
            }
            this.isLikedBy ? this.unlike() : this.like();
        },
        like() {
            axios.put(this.endpoint)
            .then((response) => {
                this.isLikedBy = true;
                this.$refs.icon.$data.active = true;
            })
            .catch(function (error) {
                alert('申し訳ありませんしばらく経ってから再度お試しください。');
                //console.log(error);
            });
        },
        unlike() {
            axios.delete(this.endpoint)
            .then((response) => {
                this.isLikedBy = false;
                this.$refs.icon.$data.active = false;
            }).catch(function (error) {
                alert('申し訳ありませんしばらく経ってから再度お試しください。');
                //console.log(error);
            });
        }
    }
}
</script>