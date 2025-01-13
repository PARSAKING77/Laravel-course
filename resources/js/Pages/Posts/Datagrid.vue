<template>
    <div class="container mx-auto p-10">
        <UiDatagrid :options="options" :data="data" />
    </div>
</template>

<script setup>
defineOptions({
    layout: AuthenticatedLayout
})

const props = defineProps({
    data: [Object, Array]
})

const options = reactive({
    title: "List of Posts",
    columns: {
        title: "Title",
        comments_no: "Comments",
        author: "Author"
    },
    actions: {
        edit: {
            title: "Edit",
            route: "posts.edit"
        }
    },
    routeKey: "posts"
})
</script>

<style scoped>

</style>
