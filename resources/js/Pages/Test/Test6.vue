<template>
  <Head title="Simple Select" />
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div>
      <div class="py-2">你选择了：{{ fruit }}</div>

      <div>
        <select v-model="fruit" class="block w-48 px-3 py-2 shadow rounded bg-white text-gray-900">
          <option value="apple">苹果</option>
          <option value="banana">香蕉</option>
          <option value="orange">橙子</option>
          <option value="grape">葡萄</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import { Head } from '@inertiajs/vue3';
  const fruit = ref('apple');
</script>
