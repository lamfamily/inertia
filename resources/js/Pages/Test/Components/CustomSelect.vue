<template>
  <div class="relative w-48">
    <div class="flex items-center justify-between bg-white" @click="open = !open">
      <button class="w-full px-3 py-2 bg-white text-left" type="button">
        {{ selectedLabel || placeholder }}
      </button>
      <div class="p-2">
        <svg
          class="size-4 text-gray-400"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path d="M6 9l6 6 6-6" />
        </svg>
      </div>
    </div>

    <ul v-if="open" class="absolute left-0 right-0 mt-1 bg-white rounded shadow z-10">
      <!-- 添加请选择 -->
      <li>
        <button
          class="w-full px-3 py-2 text-left hover:bg-blue-100"
          type="button"
          @click="choose('')"
        >
          请选择
        </button>
      </li>

      <li
        v-for="opt in options"
        :key="opt.value"
        @click="choose(opt.value)"
        class="px-3 py-2 hover:bg-blue-100 cursor-pointer"
      >
        {{ opt.label }}
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
  import { ref, computed, watch } from 'vue';

  interface Option {
    label: string;
    value: string | number;
  }

  const props = defineProps<{
    modelValue: string | number;
    options: Option[];
    placeholder?: string;
  }>();

  const emit = defineEmits<{
    (e: 'update:modelValue', value: string | number): void;
  }>();

  const open = ref(false);

  function choose(val: string | number) {
    emit('update:modelValue', val);
    open.value = false;
  }

  const selectedLabel = computed(() => {
    const found = props.options.find(opt => opt.value === props.modelValue);
    return found ? found.label : '';
  });

  function onClickOutside(e: MouseEvent) {
    // @ts-ignore
    if (!e.target.closest('.relative')) open.value = false;
  }

  watch(open, val => {
    if (val) document.addEventListener('click', onClickOutside);
    else document.removeEventListener('click', onClickOutside);
  });
</script>
