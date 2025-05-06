<template>
  <Head title="Test 1" />

  <h1 class="text-3xl font-bold">test tailwindcss</h1>

  <button class="btn-primary">custom tailwind class</button>

  <hr class="my-4" />

  <h2 class="text-2xl font-bold">
    test flex display
  </h2>

  <nav>
    <ul class="flex">
      <li>
        <a href="/test/test1" class="text-blue-500 hover:underline">Test 1</a>
      </li>
      <li>
        <a href="/test/test2" class="text-blue-500 hover:underline">Test 2</a>
      </li>
      <li>
        <a href="/test/test3" class="text-blue-500 hover:underline">Test 3</a>
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
</script>
