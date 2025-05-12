<template>
  <Head title="顶部下滑" />
  <div
    class="fixed top-0 overflow-hidden transition-all duration-500 ease-in-out w-full"
    :class="isVisible ? 'max-h-40 opacity-100' : 'max-h-0 opacity-0'"
  >
    <div class="bg-blue-100 p-4 text-center">這是下滑顯示的內容，3秒後自動收起</div>
  </div>


  <Mid>
    <button class="bg-black text-white px-4 py-2 rounded mb-4 cursor-pointer" @click="showBox">
      點我顯示內容
    </button>
  </Mid>
</template>

<script setup lang="ts">
  import { ref } from 'vue';
  import Mid from '@/Pages/Test/Components/Mid.vue';
  import { Head } from '@inertiajs/vue3';

  const isVisible = ref(false);
  let hideTimer: ReturnType<typeof setTimeout> | null = null;

  function showBox() {
    if (hideTimer) clearTimeout(hideTimer);
    isVisible.value = true;
    hideTimer = setTimeout(() => {
      isVisible.value = false;
      hideTimer = null;
    }, 3000);
  }
</script>
