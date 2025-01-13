<template>
    <div>
        <h1>List of Posts have Tag {{ tag.name }}</h1>
        <ul>
            <li v-for="post in posts" :id="post.id">
                <Link :href="`/post/${post.id}/${post.slug}`">{{ post.title }}</Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
const props = defineProps({
    posts: Array,
    tag: Object
})
defineOptions({
    layout: DefaultLayout
})

</script>

<style  scoped>

</style>
