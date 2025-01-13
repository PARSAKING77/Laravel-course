<template>
    <div class="grid grid-cols-1 gap-4">
        <h1 class="font-bold">{{ post.title }}</h1>
        <div class="flex flex-row justify-between w-full">
            <small>{{ views }} View</small>
            <div class="flex flex-row gap-2 w-xs ">
                <button @click="vote('like')">
                👍 {{ like }}
                </button>
                <button @click="vote('dislike')">
                👎  {{ dislike }}
                </button>
            </div>
        </div>
        <p>{{ post.content }}</p>
        <ul>
            <li v-for="tag in post.tags" :key="tag.id">
                <Link :href="`/tags/${tag.id}`">{{ tag.name }}</Link>
            </li>
        </ul>
        <ui-comment-list :comments="post.comments" />
        <form-comment :post="post" />
        <Link href="/posts">Back</Link>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';


const props = defineProps({
  id: String,
  slug: String,
  post: Object,
  views: Number
});
defineOptions({
    layout: DefaultLayout
})

const like = ref(0);
const dislike = ref(0)
const likeStatus = ref(false)
const dislikeStatus = ref(false)

async function vote(action) {
    axios.post(`/post/${props.id}/vote`, {action}).then((response) => {
        like.value = response.data.likes;
        dislike.value = response.data.dislikes;
        fetchVoteData();
    })
}

async function fetchVoteData() {
    axios.get(`/post/${props.id}/vote`).then((response) => {
        likeStatus.value = response.data.like
        dislikeStatus.value = response.data.dislike
        like.value = response.data.likes;
        dislike.value = response.data.dislikes
    })
}
fetchVoteData()
</script>

<style scoped>
h1 {
  @apply text-3xl font-extrabold text-gray-900 tracking-tight leading-tight;
}

small {
  @apply text-sm text-gray-500;
}

.flex-row {
  @apply items-center gap-4;
}

button {
  @apply flex items-center gap-1 text-sm font-semibold px-3 py-1.5 rounded-md bg-gray-100 hover:bg-gray-200 text-gray-800 shadow-sm transition-all duration-200 ease-in-out;
}

button:hover {
  @apply scale-105;
}

button:focus {
  @apply outline-none ring-2 ring-offset-2 ring-gray-400;
}

/* Style of Content */
p {
  @apply text-lg leading-relaxed text-gray-800 mt-4;
}

/* Style of Tag */
ul {
  @apply flex flex-wrap gap-3 mt-5;
}

li {
  @apply text-sm bg-blue-50 text-blue-700 rounded-full px-4 py-1.5 shadow transition-all duration-200 ease-in-out;
}

li:hover {
  @apply bg-blue-100 scale-105;
}

a {
  @apply text-blue-600 font-medium hover:underline transition-colors duration-200;
}

/* Style of Comment */
ui-comment-list {
  @apply mt-8 border-t border-gray-200 pt-6;
}

form-comment {
  @apply mt-6 p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200;
}

/* Back Link */
a[href="/posts"] {
  @apply text-sm text-gray-600 hover:text-gray-800 mt-6 inline-block transition-colors duration-200 ease-in-out;
}

/* Style of responsive Status */
@media (min-width: 768px) {
  h1 {
    @apply text-4xl;
  }

  button {
    @apply text-base px-4 py-2;
  }

  p {
    @apply text-xl;
  }
}
</style>
