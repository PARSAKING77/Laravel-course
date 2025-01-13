<template>
  <footer>
    <div class="meta">
      <h1>Website</h1>
      <p>
        Under the golden glow of the setting sun,
        the gentle hum of the cicadas became the melody of the evening.
      </p>
    </div>
    <nav>
      <ul>
        <li>
          <Link href="/">Home</Link>
        </li>
        <li>
          <Link href="/posts">Posts</Link>
        </li>
      </ul>
    </nav>
  </footer>
</template>
<style scoped>
footer {
  @apply bg-gradient-to-br from-indigo-700 to-indigo-900 text-white flex flex-col md:flex-row md:justify-between gap-12 p-16 rounded-tr-[100px] shadow-lg mt-12;
}
footer h1 {
  @apply text-3xl font-semibold;
}
footer .meta {
  @apply w-full md:w-1/3 text-gray-200;
}
footer nav {
  @apply w-full md:w-2/3;
}
footer nav ul {
  @apply flex flex-col md:flex-row gap-6 mt-6;
}
footer nav li {
  @apply text-gray-300 hover:text-teal-300 transition-all duration-300 ease-in-out;
}
footer nav li a {
  @apply font-medium text-lg;
}
</style>
