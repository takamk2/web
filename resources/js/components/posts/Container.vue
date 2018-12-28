<template>
    <div class="container">
        <h1>Posts</h1>
        <post-edit v-on:on-change="onChange"/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Add Post</button>
        <posts-list :posts="posts" v-on:on-select="onSelect" style="margin-top: 8px;"/>
        <post-detail :id="selectedPostId"  v-on:on-change="onChange" style="margin-top: 8px;"/>
    </div>
</template>

<script>
    import axios from "axios";
    import PostsList from './List.vue'
    import PostDetail from './Detail.vue'
    import PostEdit from './Edit.vue'

    export default {
        components: {
            PostsList,
            PostDetail,
            PostEdit,
        },
        data() {
            return {
                posts: [],
                selectedPostId: 0
            }
        },
        mounted() {
            this.fetchPosts()
        },
        methods: {
            onSelect(id) {
                this.selectedPostId = id
            },
            onChange(type) {
                console.log(type)
                this.fetchPosts()
            },
            fetchPosts() {
                const that = this
                axios.get('/api/posts')
                    .then(response => {
                        console.log(response.data)
                        that.posts = response.data.posts
                    })
            },
        }
    }
</script>

<style scoped>

</style>
