<template>
  <Head title="Custom Select" />
  <div class="flex flex-col min-h-screen items-center justify-center bg-gray-100">
    <div>
      <div class="py-2">你选择了：{{ fruit }}</div>

      <CustomSelect v-model="fruit" :options="fruitOptions" placeholder="选择水果" />
    </div>
  </div>
</template>

<script setup lang="ts">
  import { Head } from '@inertiajs/vue3';
  import { ref } from 'vue';
  import CustomSelect from '@/Pages/Test/Components/CustomSelect.vue';

  const fruit = ref<string | number>('');
  const fruitOptions = [
    { label: '苹果', value: 'apple' },
    { label: '香蕉', value: 'banana' },
    { label: '橙子', value: 'orange' },
  ];
</script>
