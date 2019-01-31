<template>
    <div class="container">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Name</span>
            </div>
            <input type="text" v-model="input.name" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Address</span>
            </div>
            <input type="text" v-model="input.address" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Duration</span>
            </div>
            <input type="number" v-model="input.duration" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-/prepend">
                <span class="input-group-text">IsRainOk</span>
            </div>
            <input type="checkbox" v-model="input.is_rain_ok" class="form-control"/>
        </div>
        <button class="btn btn-primary" style="margin-top: 4px;" @click="save">Add</button>

        <table class="table" style="margin-top: 16px;">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>IsRainOk</th>
                <th>Duration</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(location, index) in locations">
                <td>{{ location.name }}</td>
                <td>{{ location.address }}</td>
                <td>{{ location.is_rain_ok }}</td>
                <td>{{ location.duration }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        components: {},
        data() {
            return {
                input: {},
                locations: [],
            }
        },
        mounted() {
            this.fetchLocations()
        },
        methods: {
            save() {
                const that = this
                console.log(this.input)
                axios.post('/api/locations/create', {
                    input: this.input
                }).then(response => {
                    console.log(response)
                    that.fetchLocations()
                }).catch(error => {
                    console.log(error)
                })
            },
            fetchLocations() {
                const that = this
                axios.get('/api/locations')
                    .then(response => {
                        that.locations = response.data.locations
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
