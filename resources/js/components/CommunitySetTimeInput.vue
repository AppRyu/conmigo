<template>
    <div form-group col-md-6>
        <vue-ctk-date-time-picker
            :id="data.id"
            :label="data.placeholder"
            :name="data.name"
            v-model="value"
            format="YYYY-MM-DD hh:mm a"
            formatted="YYYY-MM-DD hh:mm a"
            locale="en"
            color="#536dfe"
            input-size="lg"
            no-label
        ></vue-ctk-date-time-picker>
    </div>
</template>

<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
export default {
    components: {
        VueCtkDateTimePicker
    },
    props: {
        data: {
            id: {
                type: String
            },
            name: {
                type: String
            },
            placeholder: {
                type: String
            }
        }
    },
    data() {
        return {
            value: ""
        };
    }
};
</script>
