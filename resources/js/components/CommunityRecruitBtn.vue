<template>
    <div class="u-ta-center u-mb-lg">
        <button class="comm-det-rct__btn" :class="buttonColor" :disabled="isApplied" @click="clickApply">
            {{ buttonText }}
        </button>
    </div>
</template>

<script>
export default {
    props: {
        initialIsAppliedBy: {
            type: Boolean,
            default: false,
        },
        authorized: {
            type: Boolean,
            default: false,
        },
        endpoint: {
            type: String,
        },
    },
    data() {
        return {
            isApplied: this.initialIsAppliedBy,
        };
    },
    computed: {
        buttonColor() {
            return this.isApplied ? "comm-det-rct__btn_disabled" : "comm-det-rct__btn_active";
        },
        buttonText() {
            return this.isApplied ? "応募済み" : "応募する";
        },
    },
    methods: {
        clickApply() {
            if (!this.authorized) {
                alert("ログイン中のみ応募できます");
                return;
            }
            this.apply();
        },
        async apply() {
            await axios
                .post(this.endpoint)
                .then((response) => {
                    this.isApplied = true;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
};
</script>
