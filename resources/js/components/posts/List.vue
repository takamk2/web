<template>
    <div class="container">
        <div class="list-group">
            <a v-for="post in posts" class="list-group-item list-group-item-action"
               :href="'/posts/' + post.id"
            @click.prevent="$emit('on-select', post.id)">{{ post.title }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            posts: Array,
        }
    }
</script>

<style scoped>

</style>
