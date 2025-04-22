<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: MainLayout,
});
</script>

<template>

    <Head title="About" />
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold">About Page</h1>
            <p class="mt-4">This is an about page built with Inertia.js, Vue 3 and TypeScript.</p>
        </div>
    </div>
</template>
