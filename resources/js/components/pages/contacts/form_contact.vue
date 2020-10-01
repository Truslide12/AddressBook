<template>

    <div>
        <b-card bg-variant="light">
            <b-form-group
            label-cols-lg="3"
            label="Contact Info"
            label-size="lg"
            label-class="font-weight-bold pt-0"
            class="mb-0"
            >
            </b-form-group>
            <b-form-group
                label-cols-sm="3"
                label="First Name:"
                label-align-sm="right"
                label-for="nested-firstName"
            >
                <b-form-input id="nested-firstName"></b-form-input>
            </b-form-group>
            <b-form-group
                label-cols-sm="3"
                label="Last Name:"
                label-align-sm="right"
                label-for="nested-lastName"
            >
                <b-form-input id="nested-lastName"></b-form-input>
            </b-form-group>
            <b-form-group
                label-cols-sm="3"
                label="Email:"
                label-align-sm="right"
                label-for="nested-email"
            >
                <b-form-input id="nested-email"></b-form-input>
            </b-form-group>
            <b-form-group
                label-cols-sm="3"
                label="Phone:"
                label-align-sm="right"
                label-for="nested-phone"
            >
                <b-form-input id="nested-phone"></b-form-input>
            </b-form-group>
            <b-form-group
                label-cols-sm="3"
                label="Birthday:"
                label-align-sm="right"
                label-for="nested-birthday"
            ><b-calendar v-model="value" @birthday="onBirthday" locale="en-US"></b-calendar>
                <b-form-input id="nested-birthday"></b-form-input>
            </b-form-group>
        </b-card>
    </div>
</template>

<script>
export default {
       data() {
      return {
        value: '',
        birthday: null
      }
    },
    methods: {
      onBirthday(bday) {
        this.birthday = bday
      }
    }
}
</script>
