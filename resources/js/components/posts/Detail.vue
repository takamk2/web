<template>
    <div v-if="post.id" class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ post.title }}</h2>
                <p class="card-text">{{ post.body }}</p>
                <div class="card-group">
                    <button class="btn">編集</button>
                    <button class="btn" @click="deletePost">削除</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: Number,
        },
        data() {
            return {
                post: {},
            }
        },
        mounted() {
            this.fetchDetail(this.id)
        },
        methods: {
            fetchDetail(id) {
                const that = this

                this.post = {}
                if (id) {
                    axios.get('/api/posts/' + id)
                        .then(response => {
                            console.log(response.data.post)
                            that.post = response.data.post
                        })
                }
            },
            deletePost() {
                if (!confirm('削除しますか？')) return

                const that = this
                axios.get('/api/posts/delete/' + this.id)
                    .then(response => {
                        console.log(response.data.post)
                        that.post = {}
                        that.$emit('on-change', 'delete')
                    })
            },
        },
        watch: {
            id() {
                console.log('id changed')
                this.fetchDetail(this.id)
            }
        }
    }
</script>

<style scoped>

</style>
