<template>
    <div class="container">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Date</span>
            </div>
            <input type="date" v-model="input.assay_date" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Weight</span>
            </div>
            <input type="number" v-model="input.weight" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">BodyFat</span>
            </div>
            <input type="number" v-model="input.body_fat" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">BMI</span>
            </div>
            <input type="number" v-model="input.bmi" class="form-control">
        </div>
        <button class="btn btn-primary" style="margin-top: 4px;" @click="save">Add</button>

        <table class="table" style="margin-top: 16px;">
            <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>BodyFat</th>
                <th>BMI</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(health, index) in healths">
                <td>{{ formatDate(health.assay_date, 'YYYY/MM/DD (dddd)') }}</td>
                <td>
                    {{ health.weight }}
                    <span v-if="healths[index + 1]"
                          class="weight-diff"
                          :class="{ negative: weightDiff(index, index + 1) > 0}" style="margin-left: 4px;">{{ weightDiff(index, index + 1) }}</span>
                </td>
                <td>{{ health.body_fat }}</td>
                <td>{{ health.bmi }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from "axios";
    import moment from "moment";

    export default {
        components: {},
        data() {
            return {
                healths: [],
                input: {
                    user_id: 1,
                }
            }
        },
        mounted() {
            this.fetchHealths()
        },
        methods: {
            formatDate(date, format) {
                if (!date) return ''

                return moment(date).format(format)
            },
            weightDiff(index1, index2) {
                const weight1 = this.healths[index1].weight
                const weight2 = this.healths[index2].weight

                return Math.round((weight1 - weight2) * 10) / 10
            },
            save() {
                const that = this

                console.log(this.input)
                axios.post('/api/healths/create', {
                    input: this.input
                }).then(response => {
                    console.log(response)
                    this.fetchHealths()
                }).catch(error => {
                    console.log(error)
                })
            },
            fetchHealths() {
                const that = this
                axios.get('/api/healths')
                    .then(response => {
                        that.healths = response.data.healths
                    })
            },
        }
    }
</script>

<style lang="scss" scoped>
    .weight-diff {
        color: blue;
        &.negative {
            color: red;
        }
    }
</style>
