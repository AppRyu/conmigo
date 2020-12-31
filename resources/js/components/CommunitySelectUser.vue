<template>
    <div>
        <ul class="select-user-list">
            <li class="select-user-list__name" v-for="(user, index) in users" :key="index">
                <label class="select-user-list__label" :for="index">
                    <input class="select-user-list__input" 
                            type="checkbox" 
                            name="users[]" 
                            ref="selectUserCheckbox"
                            v-model="user.checked" 
                            :id="index" 
                            :value="user.id" 
                            @change="changeDisabled">
                    <img v-if="user.profile_image" class="applied-user-tb__img" :src="'/storage/img/' + user.profile_image" alt="応募したユーザーのプロフィール画像">
                    <img v-else class="applied-user-tb__img" src="/img/default-icon.png" alt="応募したユーザーのプロフィール画像">
                    {{ user.user_name }}
                </label>
            </li>
        </ul>
        <div class="text-center">
            <button type="submit" class="select-user__btn" :class="btnColor" :disabled="enableSendForm">確定する</button>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        appliedUsers: {
            type: Array,
        },
        maxUsersNumber: {
            type: Number,
            default: 1
        }
    },
    data() {
        return {
            users: this.appliedUsers,
        };
    },
    computed: {
        checkedboxesNum() {
            return this.users.filter((user) => user.checked).length;
        },
        btnColor() {
            if(this.checkedboxesNum === 0 || this.checkedboxesNum > this.maxUsersNumber) {
                return "select-user__btn_disabled"
            }
        },
        enableSendForm() {
            return this.checkedboxesNum === 0 || this.checkedboxesNum > this.maxUsersNumber ? true : false;
        }
    },
    methods: {
        changeDisabled() {
            const AllCheckboxes = this.$refs.selectUserCheckbox;
            
            for(let i = 0; i < AllCheckboxes.length; i++) {
                if(AllCheckboxes[i].checked == true) {
                    AllCheckboxes[i].disabled = false;
                } else { 
                    if(this.checkedboxesNum < this.maxUsersNumber) {
                        AllCheckboxes[i].disabled = false;
                    }
                    if(this.checkedboxesNum == this.maxUsersNumber) {
                        AllCheckboxes[i].disabled = true;
                    }
                }
            }
        },
    }
};
</script>