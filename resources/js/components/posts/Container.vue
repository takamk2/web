<template>
    <div class="container">
        <h1>Posts</h1>
        <button type="button" class="btn btn-primary">Add Post</button>
        <posts-list :posts="posts" v-on:on-select="onSelect" style="margin-top: 8px;"/>
        <post-detail :id="selectedPostId" style="margin-top: 8px;"/>
    </div>
</template>

<script>
    import axios from "axios";
    import PostsList from './List.vue'
    import PostDetail from './Detail.vue'

    export default {
        components: {
            PostsList,
            PostDetail,
        },
        data() {
            return {
                posts: [],
                selectedPostId: 0
            }
        },
        mounted() {
            axios.get('/api/posts')
                .then(response => {
                    console.log(response.data)
                    this.posts = response.data.posts
                })
        },
        methods: {
            onSelect(id) {
                this.selectedPostId = id
            },
        }
    }
</script>

<style scoped>

</style>
