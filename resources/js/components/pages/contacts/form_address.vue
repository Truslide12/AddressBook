<template>
<div>
    <b-card bg-variant="light">
        <b-form-group
        label-cols-lg="3"
        label="Input Address"
        label-size="lg"
        label-class="font-weight-bold pt-0"
        class="mb-0"
        >
        </b-form-group>

        <b-form-group
        label-cols-sm="3"
        label="Type:"
        label-align-sm="right" class="mb-0"
        >
        <b-form-radio-group
            class="pt-2"
            :options="['Home', 'Work', 'Other']"
            ></b-form-radio-group>
        </b-form-group>

        <b-form-group
            label-cols-sm="3"
            label="House Number:"
            label-align-sm="right"
            label-for="nested-number"
        >
            <b-form-input id="nested-number"></b-form-input>
        </b-form-group>

        <b-form-group
            label-cols-sm="3"
            label="Street:"
            label-align-sm="right"
            label-for="nested-street"
        >
            <b-form-input id="nested-street"></b-form-input>
        </b-form-group>

        <b-form-group
            label-cols-sm="3"
            label="City:"
            label-align-sm="right"
            label-for="nested-city"
        >
            <b-form-input id="nested-city"></b-form-input>
        </b-form-group>

        <b-form-group
            label-cols-sm="3"
            label="State:"
            label-align-sm="right"
            label-for="nested-state"
        >
            <b-form-input id="nested-state"></b-form-input>
        </b-form-group>

        <b-form-group
            label-cols-sm="3"
            label="Zip:"
            label-align-sm="right"
            label-for="nested-zip"
        >
            <b-form-input id="nested-zip"></b-form-input>
        </b-form-group>

    </b-card>
  </div>
</template>
