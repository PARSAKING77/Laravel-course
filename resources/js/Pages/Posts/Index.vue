<template>
  <div v-if="flash.success" class="alert-success">
    {{ flash.success }}
  </div>
  <div class="grid grid-cols-1 gap-10">
    <div v-for="post in posts" :key="post.id">
      <Link :href="`/post/${post.id}/${post.slug}`" class="block mb-4">
        <h1 class="font-bold">{{ post.title }}</h1>
        <p>{{ post.description }}</p>
      </Link>
      <Link v-if="page?.props?.auth?.user" class="btn" :href="`/posts/edit/${post.id}`">
  Edit
</Link>

    </div>
  </div>
  
  <h1>Hello World</h1>
</template>
