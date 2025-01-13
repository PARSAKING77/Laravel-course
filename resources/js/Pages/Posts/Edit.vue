<template>
    <div class="p-10">
        <form @submit.prevent="form.put('/posts/'+post.id)">
            <ui-input label="Title" :error="form.errors.title" v-model="form.title" />
            <ui-input label="Slug" :error="form.errors.slug" v-model="form.slug" />
            <ui-textarea label="Descreption" :error="form.errors.description" v-model="form.description" />
            <ui-editor label="Note" :error="form.errors.content" v-model="form.content" />
            <button class="btn" type="submit">Send</button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    post: Object
})
const form = useForm({
    title: props.post.title,
    description: props.post.description,
    content: props.post.content,
    slug: props.post.slug
})


</script>

<style  scoped>

</style>
