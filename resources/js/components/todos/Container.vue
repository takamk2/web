<template>
    <div class="container">
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Title</span>
            </div>
            <input type="text" v-model="input.title" class="form-control">
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Description</span>
            </div>
            <textarea v-model="input.description" class="form-control"></textarea>
        </div>
        <div class="input-group" style="margin-top: 4px;">
            <div class="input-group-prepend">
                <span class="input-group-text">Priority</span>
            </div>
            <input type="number" v-model="input.priority" class="form-control">
        </div>
        <button class="btn btn-primary" style="margin-top: 4px;" @click="save">Add</button>

        <table class="table" style="margin-top: 16px;">
            <thead class="thead-dark">
            <tr>
                <th>Done</th>
                <th>Priority</th>
                <th>Title</th>
                <th>Description</th>
                <th>CreatedAt</th>
                <th>CompletedAt</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(todo, index) in todos">
                <td><label @click="complete(todo.id)"><input type="checkbox" :checked="todo.completed_at"></label></td>
                <td>{{ todo.priority }}</td>
                <td>{{ todo.title }}</td>
                <td>{{ todo.description }}</td>
                <td>{{ todo.created_at }}</td>
                <td>{{ todo.completed_at }}</td>
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
                todos: [],
                input: {
                    user_id: 1,
                }
            }
        },
        mounted() {
            this.fetchTodos()
        },
        methods: {
            formatDate(date, format) {
                if (!date) return ''

                return moment(date).format(format)
            },
            save() {
                const that = this
                axios.post('/api/todos/create', {
                    input: this.input
                }).then(response => {
                    console.log(response)
                    that.fetchTodos()
                }).catch(error => {
                    console.log(error)
                })
            },
            complete(id) {
                const that = this
                axios.get('/api/todos/' + id + '/complete')
                    .then(response => {
                        console.log(response)
                        that.fetchTodos()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            fetchTodos() {
                const that = this
                axios.get('/api/todos')
                    .then(response => {
                        that.todos = response.data.todos
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
