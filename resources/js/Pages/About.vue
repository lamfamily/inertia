<template>
  <Head title="About" />
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <h1 class="text-2xl font-bold text-gray-900">
        {{ $t('about.title') }}
      </h1>
      <p class="mt-2 text-gray-600">
        {{ $t('about.description') }}
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { Head } from '@inertiajs/vue3';
  import MainLayout from '@/Layouts/MainLayout.vue';

  defineOptions({
    layout: MainLayout,
  });
</script>
