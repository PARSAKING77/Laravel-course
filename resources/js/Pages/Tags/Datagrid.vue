<template>
  <div class="container mx-auto p-10">
    <UiDatagrid :options="options" :data="data" />
  </div>
</template>

<script setup>
defineOptions({
  layout: AuthenticatedLayout,
});
const props = defineProps({
  data: [Object, Array],
});

const options = reactive({
  title: "Tags",
  columns: {
    "name": "Tilte",
  },
  actions: {
    edit: {
      title: "Edit",
      route: "tags.edit",
    },
  },
  routeKey: "tags",
});
</script>

<style scoped></style>
