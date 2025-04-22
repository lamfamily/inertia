<script setup lang="ts">
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: MainLayout,
});

interface Props {
    title: string;
}

const props = defineProps<Props>();
</script>

<template>

    <Head title="Home" />
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-2xl font-bold">{{ props.title }}</h1>
            <p class="mt-4">Welcome to your Inertia.js application with Vue 3 and TypeScript!</p>
        </div>
    </div>
</template>
