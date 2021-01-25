<template>
<a @click.prevent="clickLike">
    <span :class="starColor">
            <i slot="icon" class="fas fa-star"></i>
    </span>
    <span class="u-tcd-gray">お気に入り</span>
</a>
</template>

<script>
export default {
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
    computed: {
        starColor() {
            return this.isLikedBy ? 'community-like__star--active' : 'community-like__star';
        },
        
    },
    methods: {
        clickLike() {
            if(!this.authorized) {
                alert('いいね機能はログイン中のみ使用できます');
                return 
            }
            this.isLikedBy ? this.unlike() : this.like();
        },
        like() {
            axios.put(this.endpoint)
            .then((response) => {
                this.isLikedBy = true;
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
            }).catch(function (error) {
                alert('申し訳ありませんしばらく経ってから再度お試しください。');
                //console.log(error);
            });
        }
    }
}
</script>