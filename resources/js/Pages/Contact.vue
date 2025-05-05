<template>
  <MainLayout>
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <h1 class="text-2xl font-bold text-gray-900">
          {{ $t('contact.title') }}
        </h1>
        <p class="mt-2 text-gray-600">
          {{ $t('contact.description') }}
        </p>
      </div>
    </div>
  </MainLayout>
</template>

<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
</script>
